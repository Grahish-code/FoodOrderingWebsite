<?php include("partials-front/menue.php");
?>
<div id="message"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href=" https://fonts.google.com/specimen/Open+Sans" rel="stylesheet">

<style>
    .welcome-message {
        font-family: 'Open Sans', sans-serif;
        font-style: italic;
        position: absolute;
        font-size: 50px;
        color: #fff;
        padding: 10px;
    }

    #message {
        display: none;
        /* Initially hide the message */
        padding: 15px;
        margin: 0 500px;
        border: 1px solid transparent;
        border-radius: 5px;
        color: #fff;
        transition: opacity 0.5s ease;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1;
    }

    .success {
        background-color: #28a745;
        /* Green for success */
        border-color: #28a745;

    }

    .error {
        background-color: #dc3545;
        /* Red for error */
        border-color: #dc3545;
    }
</style>



<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
        <?php
        if (isset($_SESSION['login-user']) && isset($_SESSION['users'])) {
            $username = $_SESSION['users']; // Assuming 'user' holds the username
            $user_id = $_SESSION['user_id'];
            echo "<div class='welcome-message'>WELCOME $username </div>";
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //create sql query to display category for database
        $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 3 ";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //categories Available
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //checking weather image is avaiable or not
                        if ($image_name == "") {
                            // Display msg
                            echo "Image Not Available";
                        } else {
                            // Image Available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>No Catogies</div>";
        }

        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        //Getting Foods from Database that are active and featured
        //SQL Query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Count Rows
        $count2 = mysqli_num_rows($res2);

        //CHeck whether food available or not
        if ($count2 > 0) {
            //Food Available
            while ($row = mysqli_fetch_assoc($res2)) {
                //Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $product_code = $row['product_code'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Check whether image available or not
                        if ($image_name == "") {
                            //Image not Available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">&#8377;<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <div class="buttons" style="display: flex; justify-content: space-even;  gap: 1px;">
                            <a href="<?php echo isset($_SESSION['login-user']) ? SITEURL . 'order.php?food_id=' . $id : 'login_signup.php'; ?>" class="btn btn-primary">Order Now</a>
                            <?php
                            if (isset($_SESSION['login-user'])) {
                            ?>
                                <form method="POST" class="form-submit">
                                    <input type="hidden" class="pid" name="pid" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" class="ptitle" name="ptitle" value="<?php echo $row['title']; ?>">
                                    <input type="hidden" class="pPrice" name="pPrice" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" class="pimage" name="pimage" value="<?php echo $row['image_name']; ?>">
                                    <input type="hidden" class="pcode" name="pcode" value="<?php echo $row['product_code']; ?>">
                                    <input type="hidden" class="userID" name="userID" value="<?php echo $_SESSION['user_id']; ?>">
                                    <button class="btn btn-primary addItemBtn" style="white-space: nowrap; padding:10px">Add To Cart</button>
                                </form>
                            <?php
                            } else {
                            ?>
                                <p></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

        <?php
            }
        } else {
            //Food Not Available 
            echo "<div class='error'>Food not available.</div>";
        }

        ?>

        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var ptitle = $form.find(".ptitle").val();
            var pPrice = $form.find(".pPrice").val();
            var pimage = $form.find(".pimage").val();
            var pcode = $form.find(".pcode").val();
            var user_id =$form.find(".userID").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    pid: pid,
                    ptitle: ptitle,
                    pPrice: pPrice,
                    pimage: pimage,
                    pcode: pcode,
                    user_id:user_id
                },
                success: function(response) {
                    $("#message").html(response);
                    if (response.includes('Item Added to your cart!')) {
                        $("#message").addClass('success');
                        window.scrollTo(0, 0);
                        load_cart_item_number();
                    } else {
                        $("#message").addClass('error');
                    }
                    $("#message").fadeIn();
                    setTimeout(function() {
                        $("#message").fadeOut();
                    }, 5000);
                }


            });
        });

        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    $("#cart-item").html(response);
                }
            });
        }

    });
</script>




<?php include('partials-front/footer.php')  ?>