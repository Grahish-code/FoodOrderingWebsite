<?php include("partials-front/menue.php") ?>


<?php 
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 style="color: red;">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    <?php 
            
            //Create SQL Query to Get foods based on Selected CAtegory
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count the Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food is available or not
            if($count2>0)
            {
                //Food is Available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
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

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Food not available
                echo "<div class='error'>Food not Available.</div>";
            }
        
        ?>

          


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <script type="text/javascript">
    $(document).ready(function(){
        $(".addItemBtn").click(function(e){
            e.preventDefault();
            var $form=$(this).closest(".form-submit");
            var pid=$form.find(".pid").val();
            var ptitle=$form.find(".ptitle").val();
            var pPrice=$form.find(".pPrice").val();
            var pimage=$form.find(".pimage").val();
            var pcode = $form.find(".pcode").val();

            $.ajax({
                url:'action.php',
                method:'post',
                data:{pid:pid,ptitle:ptitle,pPrice:pPrice,pimage:pimage,pcode:pcode},
                success:function(response){
                    $("#message").html(response);
                    if (response.includes('Item Added to your cart!')) {
                $("#message").addClass('success');
                window.scrollTo(0,0);
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

        function load_cart_item_number(){
            $.ajax({
url:'action.php',
method:'get',
data:{cartItem:"cart_item"},
success:function(response){
    $("#cart-item").html(response);
}
            });
        }
    
    });

 </script>


    <?php include('partials-front/footer.php')  ?>