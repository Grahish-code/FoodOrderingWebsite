<?php
include('./config/constant.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering - Login & Sign Up</title>
    <style>
    * {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #ff6b6b, #ffa500);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    width: 400px;
    z-index: 1;
}

.form-container {
    display: flex;
    flex-direction: column;
}

.form-toggle {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.toggle-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
    font-size: 18px;
    color: #333;
    transition: color 0.3s;
}

.toggle-button.active {
    font-weight: bold;
    color: #ff6b6b;
}

.form-wrapper {
    display: flex;
    width: 200%;
    transition: transform 0.5s ease-in-out;
}

.form-wrapper.slide {
    transform: translateX(-50%);
}

.form {
    width: 50%;
    padding: 0 20px;
    opacity: 0;  /* Start hidden */
    transition: opacity 0.5s ease-in-out;  /* Smooth transition for opacity */
}

.form.active {
    opacity: 1;  /* Show active form */
}

input,
button {
    opacity: 0;
    animation: fadeIn 0.5s ease-in-out forwards;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #ff6b6b;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #e53935;
}

p {
    text-align: center;
    color: #333;
}

span {
    color: #ff6b6b;
    cursor: pointer;
    transition: color 0.3s;
}

span:hover {
    color: #e53935;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateX(20px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
   
        <div class="form-container">
            <div class="form-toggle">
                <button id="loginBtn" class="toggle-button active">Login</button>
                <button id="signupBtn" class="toggle-button">Sign Up</button>
            </div>

            <?php 
           ob_start();
                if(isset($_SESSION['sign']))
                {
                    echo $_SESSION['sign'];
                    unset($_SESSION['sign']);
                }
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
            <div class="form-wrapper">
                <form id="loginForm" class="form active" method="post">
                    <h2>Login</h2>
                    <input type="text" name="username" placeholder="username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                    <p>Don't have an account? <span id="switchToSignup">Sign Up</span></p>
                </form>

                <form id="signupForm" class="form" method="post">
                    <h2>Sign Up</h2>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="Cpassword" placeholder="Confirm Password" required>
                    <button type="submit"  name="sign_up">Sign Up</button>
                    <p>Already have an account? <span id="switchToLogin">Login</span></p>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
 

    <script>
document.getElementById('loginBtn').addEventListener('click', function() {
    // Show login form and hide sign-up form
    document.getElementById('loginForm').classList.add('active');
    document.getElementById('signupForm').classList.remove('active');
    this.classList.add('active');
    document.getElementById('signupBtn').classList.remove('active');
    document.querySelector('.form-wrapper').classList.remove('slide');
});

document.getElementById('signupBtn').addEventListener('click', function() {
    // Show sign-up form and hide login form
    document.getElementById('signupForm').classList.add('active');
    document.getElementById('loginForm').classList.remove('active');
    this.classList.add('active');
    document.getElementById('loginBtn').classList.remove('active');
    document.querySelector('.form-wrapper').classList.add('slide');
});

document.getElementById('switchToSignup').addEventListener('click', function() {
    document.getElementById('signupBtn').click();
});

document.getElementById('switchToLogin').addEventListener('click', function() {
    document.getElementById('loginBtn').click();
});
    </script>
</body>
</html>


<?php


// Assuming you have established a database connection in $conn

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Prepare a SQL statement to fetch the hashed password
    $sql = "SELECT user_id, password FROM tbl_user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username); // Bind the username parameter
        mysqli_stmt_execute($stmt); // Execute the statement
        mysqli_stmt_bind_result($stmt,$user_id, $hashedPassword); // Bind the result to a variable
        mysqli_stmt_fetch($stmt); // Fetch the result

        // Check if the user exists and verify the password
        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            // User is available and login is successful
            $_SESSION['login-user'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['users'] = $username; // Store the username in session
            $_SESSION['user_id'] = $user_id; // Store the user_id in session
            
            // Redirect to Home Page/Dashboard
            header("Location: " . SITEURL . 'index.php');
            exit; // Always exit after a header redirect
        } else {
            // User not available or password did not match
            $_SESSION['login-user'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // Redirect to login/signup page
            header("Location: " . SITEURL . 'login_signup.php');
            exit; // Always exit after a header redirect
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle SQL preparation error
        $_SESSION['login-user'] = "<div class='error text-center'>Database error: " . mysqli_error($conn) . "</div>";
        header("Location: " . SITEURL . 'login_signup.php');
        exit;
    }
}


?>




<?php


if (isset($_POST['sign_up'])) {
    // Get the data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Use password_hash

    // Prepare SQL Query to save the data into Database
    $stmt = $conn->prepare("INSERT INTO tbl_user (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Execute Query and Save Data in Database
    if ($stmt->execute()) {
        // Redirect Page
        header("Location: " . SITEURL . 'index.php');
        exit; // Exit after redirect
    } else {
        $_SESSION['sign'] = "Unable to sign up. Please try again.";
        // Redirect Page
        header("Location: " . SITEURL . 'login_signup.php');
        exit; // Exit after redirect
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection if needed
$conn->close();
?>

