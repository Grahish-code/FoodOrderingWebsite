<?php include("partials-front/menue.php") ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<style>
    .addItemBtn {

        position: relative;
        left: 35%;
        bottom: 30px;
        padding: 10px;

    }
</style>



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Display Foods that are Active
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //CHeck whether the foods are availalable or not
        if ($count > 0) {
            //Foods Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the Values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //CHeck whether image available or not
                        if ($image_name == "") {
                            //Image not Available
                            echo "<div class='error'>Image not Available.</div>";
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

                        <a href="<?php echo isset($_SESSION['login-user']) ? SITEURL . 'order.php?food_id=' . $id : 'login_signup.php'; ?>" class="btn btn-primary">Order Now</a>

                        <!-- before add item to cart i want to make sre that session has login-user -->
                        <?php
                        if (isset($_SESSION['login-user'])) {
                        ?>
                            <form method="POST" class="form-submit">
                                <input type="hidden" class="pid" name="pid" value="<?php echo $row['id']; ?>">
                                <input type="hidden" class="ptitle" name="ptitle" value="<?php echo $row['title']; ?>">
                                <input type="hidden" class="pPrice" name="pPrice" value="<?php echo $row['price']; ?>">
                                <input type="hidden" class="pimage" name="pimage" value="<?php echo $row['image_name']; ?>">
                                <input type="hidden" class="pcode" name="pcode" value="<?php echo $row['product_code']; ?>">
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

        <?php
            }
        } else {
            //Food not Available
            echo "<div class='error'>Food not found.</div>";
        }
        ?>










        <div class="clearfix"></div>



    </div>

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

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    pid: pid,
                    ptitle: ptitle,
                    pPrice: pPrice,
                    pimage: pimage,
                    pcode: pcode
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