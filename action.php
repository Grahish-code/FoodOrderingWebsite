<?php
include("config/constant.php");
// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die('User ID is not set in the session. Please log in.');
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $ptitle = $_POST['ptitle'];
    $pPrice = $_POST['pPrice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    // Prepare the SQL statement to check for existing product code
    $stmt = $conn->prepare("SELECT product_code FROM cart WHERE product_code=? AND user_id=?");
    $stmt->bind_param("si", $pcode, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        $res = $stmt->get_result();
        $r = $res->fetch_assoc();
        // Check if $r is not null and contains the product_code
        if ($r && isset($r['product_code'])) {
            $code = $r['product_code'];
        } else {
            $code = null; 
        }

        // If the product code is not found, insert the new item
        if (!$code) {
            $query = $conn->prepare("INSERT INTO cart(food_name, price, image_name, qty, total_price, product_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param("sssissi", $ptitle, $pPrice, $pimage, $pqty, $pPrice, $pcode, $user_id);
            if ($query->execute()) {
                echo '<strong>Item Added to your cart!</strong>';
            } else {
                echo 'Error adding item to cart: ' . $query->error;
            }
        } else {
            echo '<strong>Item Already Added to your cart!</strong>';
        }
    } else {
        echo 'Error executing statement: ' . $stmt->error;
    }
}

if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    // Prepare the SQL statement to count items in the cart for the logged-in user
    $stmt = $conn->prepare("SELECT COUNT(*) FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']); // Bind the user_id parameter

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->bind_result($itemCount); // Bind the result to a variable
        $stmt->fetch(); // Fetch the result

        echo $itemCount; // Output the number of items in the cart
    } else {
        echo 'Error executing statement: ' . $stmt->error; // Handle execution error
    }
    // Close the statement
    $stmt->close();
}


if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    $stmt = $conn-> prepare("DELETE FROM cart where id =?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert']=['block'];
    $_SESSION['message']='Item remove from the cart';
    header('location:cart.php');

}
?>