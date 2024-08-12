<?php include('./partials/menu.php')  ?>



<style>
    
  .alert-box {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .alert-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
  }

  .alert-buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .btn-alert {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 0 10px;
    cursor: pointer;
  }

  .btn-alert:hover {
    background-color: #45a049;
  }

</style>

<div class="main-content ">
        <div class="wrapper ">
            <h1>Manage Food</h1>

            <br /><br />
<?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['unauthorize'])){
    echo $_SESSION['unauthorize'];
    unset($_SESSION['unauthorize']);
}

?>

            <br><br>
            
              <!-- Button to Add Admin -->
              <a href="add-food.php" class="btn-primary">Add Food</a>

<br /><br /><br />

            <table class="tbl-full">
                    <tr>
                    <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                      <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td> &#8377; <?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a onclick="showAlertBox('<?php echo $id; ?>','<?php echo $image_name?>')" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>

 <!-- asking the user if he is sure he want to delete the admin  -->
 <div id="alert-boxF" class="alert-box">
              <div class="alert-content">
                <h2>Are you sure you want to delete the admin?</h2>
                <div class="alert-buttons">
                  <button id="yes-btn" class="btn-alert">Yes</button>
                  <button id="no-btn" class="btn-alert">No</button>
                </div>
              </div>
            </div>

            <script>
              // Get the alert box and the buttons
              const alertBox = document.getElementById("alert-boxF");
              const yesBtn = document.getElementById("yes-btn");
              const noBtn = document.getElementById("no-btn");

              // Show the alert box
              function hideAlertBox(){
                alertBox.style.display ="none";
              }
              function showAlertBox(foodId,Imagename) {
                alertBox.style.display = "block";
              
             
              yesBtn.addEventListener("click", function() {
                // Perform the delete action here
                window.location.href = "<?php echo SITEURL ?>admin/delete-food.php?id=" + foodId + "&image_name=" + Imagename;
                hideAlertBox();
              });
            }

              noBtn.addEventListener("click", function() {
                hideAlertBox();
              });
            </script>
                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
                        }

                    ?>
                    </table>

        </div>
    </div>

<?php include('./partials/footer.php') ?>