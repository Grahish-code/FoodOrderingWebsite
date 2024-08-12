<!DOCTYPE html>
<html lang="en">
<?php 
ob_start();
include('../config/constant.php');
include('login-check.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
 
    <title>Food Order Wbeiste - Home Page</title>
</head>

<body>
    <!-- Menue Section Starts -->
    <div class="Menu">
        <div class="wrapper">

            <ul>
                <li>
                    <a href="../index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                        <path d="M9.06165 4.82633L3.23911 9.92134C2.7398 10.3583 3.07458 11.1343 3.76238 11.1343C4.18259 11.1343 4.52324 11.4489 4.52324 11.8371V15.0806C4.52324 17.871 4.52324 19.2662 5.46176 20.1331C6.40029 21 7.91082 21 10.9319 21H13.0681C16.0892 21 17.5997 21 18.5382 20.1331C19.4768 19.2662 19.4768 17.871 19.4768 15.0806V11.8371C19.4768 11.4489 19.8174 11.1343 20.2376 11.1343C20.9254 11.1343 21.2602 10.3583 20.7609 9.92134L14.9383 4.82633C13.5469 3.60878 12.8512 3 12 3C11.1488 3 10.4531 3.60878 9.06165 4.82633Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 16H12.009" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
                <li>
                    <a href="manage-admin.php">Admin</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                        <path d="M20 22V17C20 15.1144 20 14.1716 19.4142 13.5858C18.8284 13 17.8856 13 16 13L12 22L8 13C6.11438 13 5.17157 13 4.58579 13.5858C4 14.1716 4 15.1144 4 17V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 15L11.5 19L12 20.5L12.5 19L12 15ZM12 15L11 13H13L12 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.5 6.5V5.5C15.5 3.567 13.933 2 12 2C10.067 2 8.5 3.567 8.5 5.5V6.5C8.5 8.433 10.067 10 12 10C13.933 10 15.5 8.433 15.5 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
                <li>
                    <a href="manage-categories.php">Categories</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                        <path d="M2 10H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 17H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 3H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19.6 18.6L22 21M20.8 14.4C20.8 11.4176 18.3824 9 15.4 9C12.4176 9 10 11.4176 10 14.4C10 17.3824 12.4176 19.8 15.4 19.8C18.3824 19.8 20.8 17.3824 20.8 14.4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>
                <li>
                    <a href="manage-food.php">Food</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                        <path d="M6.5 17.3306C7.78183 18.9563 9.76903 20 12 20C13.9587 20 15.7295 19.1955 17 17.8989M8.5 6.93647C9.52961 6.34088 10.725 6 12 6C13.9587 6 15.7295 6.80446 17 8.10101" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M16 13C16 15.2091 14.2091 17 12 17C9.79085 17 8 15.2091 8 13C8 10.7909 9.79085 9 12 9C14.2091 9 16 10.7909 16 13Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M6 7C6 8.38067 5.10457 9 4 9C2.89543 9 2 8.38067 2 7C2 5.61928 2.89543 4 4 4C5.10457 4 6 5.61928 6 7Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M19.5 13V4H20C21.1046 4 22 4.89543 22 6V13H19.5ZM19.5 13V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 9V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>

                <li>
                    <a href="manage-order.php">Order</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff6b81" fill="none">
                        <path d="M3 11C3 7.25027 3 5.3754 3.95491 4.06107C4.26331 3.6366 4.6366 3.26331 5.06107 2.95491C6.3754 2 8.25027 2 12 2C15.7497 2 17.6246 2 18.9389 2.95491C19.3634 3.26331 19.7367 3.6366 20.0451 4.06107C21 5.3754 21 7.25027 21 11V13C21 16.7497 21 18.6246 20.0451 19.9389C19.7367 20.3634 19.3634 20.7367 18.9389 21.0451C17.6246 22 15.7497 22 12 22C8.25027 22 6.3754 22 5.06107 21.0451C4.6366 20.7367 4.26331 20.3634 3.95491 19.9389C3 18.6246 3 16.7497 3 13V11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 9.5L7 9.5M10 14.5H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </li>

                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Menue Section End -->