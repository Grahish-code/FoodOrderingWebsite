<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
   <style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-image: url(./images/backg.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    color: #333;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    position: relative;
    right: 200px;
    background-image: linear-gradient(to right, rgba(240, 240, 240, 0.8), rgba(250, 250, 250, 0.5), rgba(255, 255, 255, 0.3));
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1, h2, h3 {
    margin-bottom: 20px;
}

.cart-summary {
    margin-bottom: 30px;
    padding: 15px;
    border-radius: 5px;
    background: linear-gradient(to bottom, #f5f5f0 0%, #ebe9e0 100%);
    border-left: 5px solid #ff6b81;
}

.cart-summary ul {
    list-style: none;
}

.cart-summary li {
    padding: 8px 0;
    border-bottom: 1px solid #ddd;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 14px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease-in-out;
        background: linear-gradient(to bottom, #f5f5f0 0%, #ebe9e0 100%);
}

textarea {
    resize: vertical;
}

.btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #45a049;
}

@media (max-width: 600px) {
    .container {
        padding: 15px;
    }

    .btn {
        width: 100%;
    }
}

   </style>

</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        
        <div class="cart-summary">
            <h2>Your Cart</h2>
            <ul id="cart-items">
                <li>Pizza - $12.99 x 2</li>
                <li>Burger - $8.99 x 1</li>
                <li>Salad - $5.99 x 1</li>
            </ul>
            <h3>Total Amount: $40.96</h3>
        </div>

        <form id="checkout-form">
            <h2>Billing Information</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>

            <button type="submit" class="btn">Proceed to Payment</button>
        </form>
    </div>

    <script src="script.js"></script> <!-- Link to JavaScript file -->
</body>
</html>
