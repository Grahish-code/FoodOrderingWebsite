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
        <h1>MANAGE CATEGORIES</h1>

        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>

        <!-- Button to Add Admin -->
        <a href="add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //Query to Get all CAtegories from Database
            $sql = "SELECT * FROM tbl_category";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and assign value as 1
            $sn = 1;

            //Check whether we have data in database or not
            if ($count > 0) {
                //We have data in database
                //get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td>

                            <?php
                            //Chcek whether image name is available or not
                            if ($image_name != "") {
                                //Display the Image
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                            <?php
                            } else {
                                //DIsplay the MEssage
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>

                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a class="btn-danger" onclick="showAlertBox('<?php echo $id; ?>','<?php echo $image_name?>')" >Delete Category</a>
                        </td>



 <!-- asking the user if he is sure he want to delete the food  -->
 <div id="alert-box" class="alert-box">
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
              const alertBox = document.getElementById("alert-box");
              const yesBtn = document.getElementById("yes-btn");
              const noBtn = document.getElementById("no-btn");

              // Show the alert box
              function hideAlertBox(){
                alertBox.style.display ="none";
              }
              function showAlertBox(categoryId,ImageName) {
                alertBox.style.display = "block";
              
             
              yesBtn.addEventListener("click", function() {
                // Perform the delete action here
                window.location.href = "<?php echo SITEURL ?>admin/delete-category.php?id=" + categoryId + "&image_name=" + ImageName;
                hideAlertBox();
              });
            }

              noBtn.addEventListener("click", function() {
                hideAlertBox();
              });


            </script>








                    </tr>
                    
                <?php

                }
            } else {
                //WE do not have data
                //We'll display the message inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added.</div>
                    </td>
                </tr>

            <?php
            }

            ?>

        </table>
       

    </div>
</div>

<?php include('./partials/footer.php') ?>