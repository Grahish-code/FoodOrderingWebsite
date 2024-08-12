<?php include("config/constant.php") ?>

<style>
    .notify {

    background-color: #ff6b81; /* Background color */
    color: #fff; /* Text color */
     border-radius: 10%; /*Make it circular */

padding: 4px;
    font-size: 15px; /* Font size */
    font-weight: bold; /* Bold text */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Optional: shadow for depth */
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background: #131314;">
    <!-- Navbar Section Starts Here -->

    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo3.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li class="icon-text">
                        <a href="index.php">Home</a>


                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                            <path d="M9.06165 4.82633L3.23911 9.92134C2.7398 10.3583 3.07458 11.1343 3.76238 11.1343C4.18259 11.1343 4.52324 11.4489 4.52324 11.8371V15.0806C4.52324 17.871 4.52324 19.2662 5.46176 20.1331C6.40029 21 7.91082 21 10.9319 21H13.0681C16.0892 21 17.5997 21 18.5382 20.1331C19.4768 19.2662 19.4768 17.871 19.4768 15.0806V11.8371C19.4768 11.4489 19.8174 11.1343 20.2376 11.1343C20.9254 11.1343 21.2602 10.3583 20.7609 9.92134L14.9383 4.82633C13.5469 3.60878 12.8512 3 12 3C11.1488 3 10.4531 3.60878 9.06165 4.82633Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 16H12.009" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>


                    </li>
                    <li class="icon-text">
                        <a href="categories.php">Categories</a>


                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                            <path d="M2 10H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 17H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 3H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19.6 18.6L22 21M20.8 14.4C20.8 11.4176 18.3824 9 15.4 9C12.4176 9 10 11.4176 10 14.4C10 17.3824 12.4176 19.8 15.4 19.8C18.3824 19.8 20.8 17.3824 20.8 14.4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>




                    </li>
                    <li class="icon-text">
                        <a href="foods.php">Foods</a>


                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                            <path d="M6.5 17.3306C7.78183 18.9563 9.76903 20 12 20C13.9587 20 15.7295 19.1955 17 17.8989M8.5 6.93647C9.52961 6.34088 10.725 6 12 6C13.9587 6 15.7295 6.80446 17 8.10101" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M16 13C16 15.2091 14.2091 17 12 17C9.79085 17 8 15.2091 8 13C8 10.7909 9.79085 9 12 9C14.2091 9 16 10.7909 16 13Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M6 7C6 8.38067 5.10457 9 4 9C2.89543 9 2 8.38067 2 7C2 5.61928 2.89543 4 4 4C5.10457 4 6 5.61928 6 7Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M19.5 13V4H20C21.1046 4 22 4.89543 22 6V13H19.5ZM19.5 13V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 9V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>



                    </li>

                    <?php
                    if (isset($_SESSION['login-user'])) {
                    ?>
                        <li class="icon-text">
                            <a href="cart.php">My Cart</a>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                                <path d="M8 16H15.2632C19.7508 16 20.4333 13.1808 21.261 9.06908C21.4998 7.88311 21.6192 7.29013 21.3321 6.89507C21.045 6.5 20.4947 6.5 19.3941 6.5H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8 16L5.37873 3.51493C5.15615 2.62459 4.35618 2 3.43845 2H2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M8.88 16H8.46857C7.10522 16 6 17.1513 6 18.5714C6 18.8081 6.1842 19 6.41143 19H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="10.5" cy="20.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="17.5" cy="20.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <span class="notify" id="cart-item"></span>
                        </li>
                    <?php
                    }
                    ?>



                    <li class="icon-text">
                        <a href="./admin/manage-admin.php">Admin</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                            <path d="M18 6C17.9531 4.44655 17.7797 3.51998 17.1377 2.87868C16.2581 2 14.8423 2 12.0108 2H8.0065C5.17501 2 3.75926 2 2.87963 2.87868C2 3.75736 2 5.17157 2 8V16C2 18.8284 2 20.2426 2.87963 21.1213C3.75926 22 5.17501 22 8.0065 22H12.0108C14.8423 22 16.2581 22 17.1377 21.1213C17.7797 20.48 17.9531 19.5535 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M20.2419 11.7419L21.419 10.5648C21.6894 10.2944 21.8246 10.1592 21.8969 10.0134C22.0344 9.73584 22.0344 9.41003 21.8969 9.13252C21.8246 8.98666 21.6894 8.85145 21.419 8.58104C21.1485 8.31062 21.0133 8.17542 20.8675 8.10314C20.59 7.96562 20.2642 7.96562 19.9866 8.10314C19.8408 8.17542 19.7056 8.31062 19.4352 8.58104L18.2581 9.7581M20.2419 11.7419L14.9757 17.0081L12 18L12.9919 15.0243L18.2581 9.7581M20.2419 11.7419L18.2581 9.7581" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5 19H6L7.25 16.5L8.5 19H9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 6H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 10H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </li>

                    <?php
                    if (isset($_SESSION['login-user'])) {
                    ?>
                        <li class="icon-text">
                            <a href="logout.php">LogOut</a>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                                <path d="M18 6C17.9531 4.44655 17.7797 3.51998 17.1377 2.87868C16.2581 2 14.8423 2 12.0108 2H8.0065C5.17501 2 3.75926 2 2.87963 2.87868C2 3.75736 2 5.17157 2 8V16C2 18.8284 2 20.2426 2.87963 21.1213C3.75926 22 5.17501 22 8.0065 22H12.0108C14.8423 22 16.2581 22 17.1377 21.1213C17.7797 20.48 17.9531 19.5535 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.2419 11.7419L21.419 10.5648C21.6894 10.2944 21.8246 10.1592 21.8969 10.0134C22.0344 9.73584 22.0344 9.41003 21.8969 9.13252C21.8246 8.98666 21.6894 8.85145 21.419 8.58104C21.1485 8.31062 21.0133 8.17542 20.8675 8.10314C20.59 7.96562 20.2642 7.96562 19.9866 8.10314C19.8408 8.17542 19.7056 8.31062 19.4352 8.58104L18.2581 9.7581M20.2419 11.7419L14.9757 17.0081L12 18L12.9919 15.0243L18.2581 9.7581M20.2419 11.7419L18.2581 9.7581" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5 19H6L7.25 16.5L8.5 19H9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 6H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 10H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </li>

                    <?php
                    } else {
                    ?>
                        <li class="icon-text">
                            <a href="login_signup.php">Login</a>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                                <path d="M18 6C17.9531 4.44655 17.7797 3.51998 17.1377 2.87868C16.2581 2 14.8423 2 12.0108 2H8.0065C5.17501 2 3.75926 2 2.87963 2.87868C2 3.75736 2 5.17157 2 8V16C2 18.8284 2 20.2426 2.87963 21.1213C3.75926 22 5.17501 22 8.0065 22H12.0108C14.8423 22 16.2581 22 17.1377 21.1213C17.7797 20.48 17.9531 19.5535 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.2419 11.7419L21.419 10.5648C21.6894 10.2944 21.8246 10.1592 21.8969 10.0134C22.0344 9.73584 22.0344 9.41003 21.8969 9.13252C21.8246 8.98666 21.6894 8.85145 21.419 8.58104C21.1485 8.31062 21.0133 8.17542 20.8675 8.10314C20.59 7.96562 20.2642 7.96562 19.9866 8.10314C19.8408 8.17542 19.7056 8.31062 19.4352 8.58104L18.2581 9.7581M20.2419 11.7419L14.9757 17.0081L12 18L12.9919 15.0243L18.2581 9.7581M20.2419 11.7419L18.2581 9.7581" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5 19H6L7.25 16.5L8.5 19H9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 6H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 10H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </li>
                    <?php
                    }
                    ?>



                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->