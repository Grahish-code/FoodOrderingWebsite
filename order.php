<?php include("partials-front/menue.php") ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
 
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .order {
        background-image: linear-gradient(to right, rgba(240, 240, 240, 0.8), rgba(250, 250, 250, 0.5), rgba(255, 255, 255, 0.3));
        padding: 20px;
        position: relative;
        right: 20%;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }

    .order:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    /* Fieldset Styles */
    fieldset {
        border: none;
        padding: 0;
        margin-bottom: 20px;
    }

    legend {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
        transition: color 0.3s ease-in-out;
    }

    legend:hover {
        color: #666;
    }

    /* Food Menu Styles */
    .food-menu-img img {
        width: 100%;
        max-width: 200px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }

    .food-menu-img img:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .food-menu-desc h3 {
        font-size: 20px;
        margin-top: 0;
        color: #333;
        transition: color 0.3s ease-in-out;
    }

    .food-menu-desc h3:hover {
        color: #666;
    }

    .food-price {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    /* Input Field Styles */
    .input-responsive {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 14px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease-in-out;
        background: linear-gradient(to bottom, #f5f5f0 0%, #ebe9e0 100%);
    }

    .input-responsive:focus {
        border-color: #666;
    }

    .input-responsive:hover {
        border-color: #999;
    }

    /* Button Styles */
    .btn-primary {
        background-color: black;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
        background-color: #45a049;
    }

    /* Gradient Colors
.gradient {
  background-image: linear-gradient(to bottom, #f2f2f2, #ccc);
  background-size: 100% 100%;
  background-position: 0% 0%;
  transition: background-position 0.3s ease-in-out;
}

.gradient:hover {
  background-position: 100% 0%;
} */
</style>

<?php

if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-order">
    <div class="container">

        <h2 class="text-center text-white">Your Food Is Just One Step Away</h2>
        <form action="pay.php" method="POST" class="order">
            <fieldset>
                <legend style="font-weight:bold">Selected Food</legend>

                <div class="food-menu-img">
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve gradient">
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <p class="food-price"> &#8377;<span id="food-price-value"><?php echo $price; ?></span></p>
                    <input type="hidden" name="food" value="<?php echo $title?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" id="quantity" value="1" min="1" required>
                    <input type="hidden" name="price" value="<?php echo $price?>">

                </div>
                <button type="button" onclick="updateTotalPrice()" style="border-radius: 38px; padding: 5px 20px; background-color: #4CAF50; color: white; ">Update Price</button>

            </fieldset>

            <fieldset>
                <legend class="gradient">Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" style="border-radius: 20px;" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary gradient">
            </fieldset>
        </form>
        <?php

          //CHeck whether submit button is clicked or not
          if(isset($_POST['submit']))
          {
              // Get all the details from the form

              $food = $_POST['food'];
              $price = $_POST['price'];
              $qty = $_POST['qty'];

              $total = $price * $qty; // total = price x qty 

              $order_date = date("Y-m-d h:i:sa"); //Order DAte

              $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

              $customer_name = $_POST['full-name'];
              $customer_contact = $_POST['contact'];
              $customer_email = $_POST['email'];
              $customer_address = $_POST['address'];


              //Save the Order in Databaase
              //Create SQL to save the data
              $sql2 = "INSERT INTO tbl_order SET 
                  food = '$food',
                  price = $price,
                  qty = $qty,
                  total = $total,
                  order_date = '$order_date',
                  status = '$status',
                  customer_name = '$customer_name',
                  customer_contact = '$customer_contact',
                  customer_email = '$customer_email',
                  customer_adress = '$customer_address'
              ";

              //echo $sql2; die();

              //Execute the Query
              $res2 = mysqli_query($conn, $sql2);

              //Check whether query executed successfully or not
              if($res2==true)
              {
                  //Query Executed and Order Saved
                echo "order successfull";
              }
              else
              {
                  //Failed to Save Order
                  echo "ordr unsccessfull";
              }

          }
      


        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php')  ?>
<script>
    function updateTotalPrice() {
        const priceItem = <?php echo $price ?>;
        const quantity = parseInt(document.getElementById('quantity').value);
        if (quantity < 1) {
            alert("Quantity must be atleast 1");
            return;
        }
        const totalprice = priceItem * quantity;
        document.getElementById('food-price-value').textContent = totalprice.toFixed(2);

    }
</script>

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
