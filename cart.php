<?php include("partials-front/menue.php") ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<style>
    .cart-information {
        font-family: Arial, sans-serif;
        background-image: url('images/backg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #1c1c1c;
        margin: 0;
        padding: 20px;
    }

    .cart-container {
        position: relative;
        right: 200px;
        background-image: linear-gradient(to right, rgba(240, 240, 240, 0.8), rgba(250, 250, 250, 0.5), rgba(255, 255, 255, 0.3));
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 600px;
        margin: auto;
        transition: all 0.3s ease;
    }

    h1 {
        text-align: center;
        color: #000;
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .food-img-detail {
        display: flex;
        justify-content: space-around;
    }

    .food-img-detail img {
        border-radius: 20px;
        margin-right: 15px;
    }

    .item-details h2 {
        margin: 0;
        font-size: 20px;
        color: #333;
    }

    .item-details p {
        margin: 5px 0 0;
        font-size: 16px;
        color: #555;
    }

    .item-price {
        font-size: 20px;
        color: #000;
        font-weight: 700;
        align-self: center;
    }


    .quantity-container {
        display: flex;
        margin-top: 10px;
        align-items: center;
        background-color: #f8f9fa;
        /* Light background for the container */
        border-radius: 5px;
        /* Rounded corners */
        padding: 2px;
        /* Padding around the container */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
    }

    .quantity-container button {
        background-color: #28a745;
        /* Green background for the buttons */
        color: #fff;
        /* White text color */
        border: none;
        /* No border */
        border-radius: 5px;
        /* Rounded corners */
        padding: 6px 10px;
        /* Increased padding for a better touch target */
        cursor: pointer;
        /* Pointer cursor on hover */
        transition: background-color 0.3s ease;
        /* Smooth transition for hover effect */
        font-size: 12px;
        /* Larger font size for better readability */
    }

    .quantity-container button:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    .quantity-container input {
        width: 30px;
        /* Fixed width */
        text-align: center;
        /* Center the text */
        margin: 0 5px;
        /* Margin between input and buttons */
        border: 1px solid #ced4da;
        /* Light border */
        border-radius: 5px;
        /* Rounded corners */
        padding: 4px;
        /* Padding inside the input */
        font-size: 12px;
        /* Larger font size for better readability */
        transition: border-color 0.3s ease;
        /* Smooth transition for focus effect */
    }

    .quantity-container input:focus {
        border-color: #80bdff;
        /* Change border color on focus */
        outline: none;
        /* Remove default outline */
    }

    .cart-summary {
        margin-top: 25px;
        text-align: right;
        font-size: larger;
    }

    .cart-summary p {
        margin-bottom: 5px;
    }

    .total {
        font-weight: bold;
    }

    .checkout-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .checkout-btn:hover {
        background-color: #0069d9;
    }

    .del_button {
        position: relative;
        left: 17px;

    }

    .del_button:hover {
        cursor: pointer;
    }

    .del_button:active {
        transform: scale(0.95);
        /* Scale down when the button is clicked */
    }
</style>

<section class="cart-information">
    <div class="cart-container">
        <h1>Your Shopping Cart</h1>

        <?php
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->bind_param("i",$_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $grand_total = 0;
        while ($row = $result->fetch_assoc()) :
        ?>
            <div class="cart-item">
                <div class="food-img-detail">
                    <div class="img-info">
                        <img src="images/food/<?php echo $row['image_name'] ?>" alt="" width="60px">
                    </div>
                    <div class="item-details">
                        <h2><?= $row['food_name'] ?></h2>
                        <p>Delicious cheese pizza</p>
                        <div class="quantity-container">
                            <button class="decrement-btn">-</button>
                            <input type="number" class="quantity" value="<?= $row['qty'] ?>" min="1" max="10">
                            <button class="increment-btn">+</button>
                            <a href="action.php?remove=<?=$row['id']?>" class="del_button" onclick="return confirm('Are you sure you want to delete this itm')">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color=" #dc3545" fill="none">
                                    <path d="M19.5 5.5L19.0982 12.0062M4.5 5.5L5.10461 15.5248C5.25945 18.0922 5.33688 19.3759 5.97868 20.299C6.296 20.7554 6.7048 21.1407 7.17905 21.4302C7.85035 21.84 8.68108 21.9631 10 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M20 15L13 21.9995M20 22L13 15.0005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>


                            </a>
                        </div>
                    </div>
                </div>
                <div class="item-price">&#8377; <span class="price" data-price="<?= $row['price'] ?>"><?= $row['price'] ?></span></div>
            </div>
            <?php
            
            ?>
        <?php endwhile; ?>


        <div class="cart-summary">
            <p>Subtotal: &#8377; <span id="subtotal">0.00</span></p>
            <p>Tax (estimated): &#8377; <span id="tax">0.00</span></p>
            <p class="total">Total: &#8377; <span id="total">0.00</span></p>
            <button class="checkout-btn" onclick="window.location.href='checkout.php'">Checkout</button>
        </div>
    </div>
</section>
<script>
    // Get all the quantity input fields
    const quantityInputs = document.querySelectorAll('.quantity');

    // Function to update the cart summary
    function updateCart() {
        let subtotal = 0;
        let tax = 0;
        let total = 0;

        quantityInputs.forEach((input) => {
            const quantity = parseInt(input.value);
            const unitPrice = parseFloat(input.closest('.cart-item').querySelector('.price').dataset.price);
            const itemPrice = quantity * unitPrice;

            input.closest('.cart-item').querySelector('.price').textContent = itemPrice.toFixed(2);
            subtotal += itemPrice;
        });

        tax = subtotal * 0.1; // Assuming a 10% tax rate
        total = subtotal + tax;

        document.getElementById('subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('tax').textContent = tax.toFixed(2);
        document.getElementById('total').textContent = total.toFixed(2);
    }

    // Call updateCart on page load to initialize the summary
    updateCart();

    // Add event listeners to the quantity input fields
    quantityInputs.forEach((input) => {
        input.addEventListener('input', updateCart);
    });

    // Add event listeners to the increment and decrement buttons
    const incrementBtns = document.querySelectorAll('.increment-btn');
    const decrementBtns = document.querySelectorAll('.decrement-btn');

    incrementBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            quantityInputs[index].value = parseInt(quantityInputs[index].value) + 1;
            updateCart();
        });
    });

    decrementBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            if (quantityInputs[index].value > 1) {
                quantityInputs[index].value = parseInt(quantityInputs[index].value) - 1;
                updateCart();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    // Update the cart item count or content
                    $("#cart-item").html(response);

                    // Call updateCart to refresh the summary after loading cart items
                    updateCart();
                }
            });
        }
    });
</script>

<?php include('partials-front/footer.php') ?>