<?php include("partials-front/menue.php") ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 

//Display all the cateories that are active
//Sql Query
$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Count Rows
$count = mysqli_num_rows($res);

//CHeck whether categories available or not
if($count>0)
{
    //CAtegories Available
    while($row=mysqli_fetch_assoc($res))
    {
        //Get the Values
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        ?>
        
        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php 
                    if($image_name=="")
                    {
                        //Image not Available
                        echo "<div class='error'>Image not found.</div>";
                    }
                    else
                    {
                        //Image Available
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
}
else
{
    //CAtegories Not Available
    echo "<div class='error'>Category not found.</div>";
}

?>

          

        

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
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