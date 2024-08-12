<?php include('./partials/menu.php') ?>

<?php
function generateUniqueProductCode($length = 10) {
    // Generate a random string of the specified length
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // You can include letters if you want
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>

<style>
    .main-content {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        /* Light background color */
    }

    .form-group.file-input {
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-group.file-input .photo-frame {
        width: 150px;
        height: 150px;
        border: 2px solid #ccc;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .form-group.file-input .photo-frame img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .form-group.file-input label {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-group.file-input input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .form-group.file-input input[type="file"]:hover+label {
        background-color: #45a049;
    }

    .wrapper-1 {
        background-color: #fff;
        /* White wrapper background */
        border-radius: 10px;
        /* Increased border radius */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
        /* Darker heading color */
    }

    .food-form {
        width: 100%;
    }

    .food-table {
        width: 100%;
        border-collapse: collapse;
    }

    .food-table th,
    .food-table td {
        padding: 15px;
        /* Increased padding for better spacing */
        border: 1px solid #ddd;
        border-radius: 5px;
        /* Consistent border radius */
    }

    .food-table th {
        text-align: left;
        font-weight: bold;
        background-color: #eee;
        /* Light table header background */
    }

    .food-form input[type="text"],
    .food-form textarea,
    .food-form select {
        width: 100%;
        /* Ensures full width for inputs and textarea */
        padding: 10px;
        /* Increased padding for cleaner look */
        border: 1px solid #ccc;
        border-radius: 5px;
        /* Consistent border radius */
        box-sizing: border-box;
        /* Ensures padding doesn't affect width */
    }

    .food-form textarea {
        height: 100px;
        /* Adjust textarea height as needed */
    }

    .food-form input[type="number"] {
        width: 80px;
        /* Adjusted width for number input */
    }

    .food-form input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .radio-group {
        display: flex;
        /* Arranges radio buttons horizontally */
        margin-top: 5px;
    }

    .radio-group input[type="radio"] {
        margin-right: 10px;
        /* Spacing between radio buttons */
    }

    .btn {
        padding: 10px 20px;
        /* Increased padding for buttons */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        /* Smooth transition for hover effects */
        background-color: #fff6bf;
        /* White button background */
        color: #333;
        /* Darker text color */
    }

    .btn:hover {
        background-color: #ff6b81;
        /* Pink hover color (your primary color) */
        color: white;
        /* White text on hover */
    }

    /* Optional animation for form submission (replace with your preferred animation) */
    .food-form input[type="submit"]:hover {
        animation: button-pulse 0.5s infinite ease-in-out;
    }
</style>


<div class="main-content">
    <div class="wrapper-1">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_Seesion['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data" class="food-form">
            <table class="food-table">
                <tr>
                    <th>Title:</th>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" required>
                    </td>
                </tr>

                <tr>
                    <th>Description:</th>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food" required></textarea>
                    </td>
                </tr>

                <tr>
                    <th>Price:</th>
                    <td>
                        <input type="number" name="price" step="0.01" min="0.00" placeholder="0.00" required>
                    </td>
                </tr>

                <tr>
                    <th>Select Image:</th>
                    <td>
                        <div class="form-group file-input">
                            <div class="photo-frame">
                                <img id="uploaded-image" src="#" alt="Uploaded Image" width="150" height="150" style="display: none;">
                            </div>
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image" onchange="previewImage(this)">
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Category:</th>
                    <td>
                        <select name="category" required>
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Featured:</th>
                    <td>
                        <div class="radio-group">
                            <input type="radio" name="featured" id="featured-yes" value="Yes" required>
                            <label for="featured-yes">Yes</label>
                            <input type="radio" name="featured" id="featured-no" value="No">
                            <label for="featured-no">No</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Active:</th>
                    <td>
                        <div class="radio-group">
                            <input type="radio" name="active" id="active-yes" value="Yes" required>
                            <label for="active-yes">Yes</label>
                            <input type="radio" name="active" id="active-no" value="No">
                            <label for="active-no">No</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) { // if (input.files && input.files): This checks if the input element (the file input field) has a files property, and if the first file in the files array exists. This ensures that a file has actually been selected.
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('uploaded-image').src = e.target.result;
                        document.getElementById('uploaded-image').style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>



        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $product_code = generateUniqueProductCode();

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "no";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'no';
            }

            //2.Upload Image if selected
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        //Failed to Upload the image
                        //REdirect to Add Food Page with Error Message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        //STop the process
                        die();
                    }
                }
            } else {
                $image_name = ""; //SEtting DEfault Value as blank
            }

            //3. Insert Into Database

            // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
            $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active',
                    product_code='$product_code';
                ";
            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //4. Redirect with MEssage to Manage Food page
            if ($res2 == true) {
                //Data inserted Successfullly
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //FAiled to Insert Data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>




    </div>
</div>

<?php include('partials/footer.php'); ?>