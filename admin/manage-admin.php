<?php include('./partials/menu.php')  ?>

<style>
  /* Table Base */

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

  .tbl-full {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
  }

  .tbl-full tr:nth-child(even) {
    background-color: #f8f8f8;
    /* Light gray for even rows */
  }

  .tbl-full tr:hover td {
    color: #000;
    /* Black text on hover for better contrast */
  }

  /* Table Header */
  .tbl-full th {
    background-color: #ff4d4d;
    color: #333;
    padding: 15px 20px;
    text-align: left;
    border: 1px solid #ddd;
    font-weight: bold;
    position: relative;
    /* Needed for hover effect */
    transition: all ease-in 0.2s;
  }

  /* Table Body Rows */
  .tbl-full tr {
    border-bottom: 1px solid #ddd;
    transition: all 0.3s ease-in-out;
    /* Add smooth transitions */
  }

  /* Table Body Cells */
  .tbl-full td {
    padding: 15px 20px;
    color: #333;
    transition: all 0.3s ease-in-out;
    /* Add smooth transitions */
  }

  /* Actions Column */
  .tbl-full td:last-child {
    text-align: center;
    display: flex;
    justify-content: space-around;

  }

  /* Buttons (Base Styles) */

  .btn-secondary,
  .btn-danger,
  .btn-primary {
    padding: 8px 15px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    /* Add smooth transitions */
    text-decoration: none;
  }

  .btn-primary {
    background-color: #6386ee;
    color: #333;
  }

  .btn-secondary {
    background-color: #71bb64;
    color: #333;
  }

  .btn-danger {
    background-color: #ff4d4d;
    color: #fff;
  }

  .btn-danger:hover,
  .btn-primary:hover,
  .btn-secondary:hover {
    transform: scale(1.1);
    /* Scale buttons up slightly on hover */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Add subtle shadow on hover */
  }

  /* Button Hover Effect */
  .tbl-full tr:hover {
    background-color: #c1bebf;
    /* Add subtle background change on hover */
    transform: scale(1.005);
    /* Scale buttons up slightly on hover */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

  }

  /* Table Header Hover Effect (with Transform) */
  .tbl-full th:hover {
    background-color: #be2020;
    /* Change background color on hover */
    transform: translateY(-5px);
    /* Slide header row down slightly */
  }

  .tbl-full th:hover:after {
    content: "";
    /* Add an empty after pseudo-element */
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1);
    /* Add a transparent overlay on hover */
    opacity: 0;
    /* Initially invisible */
    transition: opacity 0.3s ease-in-out;
    /* Add smooth transition for overlay */
  }

  .tbl-full th:hover:after {
    opacity: 0.2;
    /*Show overlay on hover */
  }
</style>

<!-- Main Content Section Starts -->
<div class="main-content ">
  <div class="wrapper ">
    <h1>Manage Admin</h1>

    <br /><br />

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; //Displaying Session Message
      unset($_SESSION['add']); //REmoving Session Message
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete']; //Displaying Session Message
      unset($_SESSION['delete']); //REmoving Session Message
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['change-pwd'])) {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }
    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }
    ?>

    <br><br><br>


    <!-- Button to Add Admin -->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>

    <br /><br /><br />

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php
      //Query to Get all Admin
      $sql = "SELECT * FROM tbl_admin";
      //Execute the Query
      $res = mysqli_query($conn, $sql);

      //CHeck whether the Query is Executed of Not
      if ($res == TRUE) {
        // Count Rows to CHeck whether we have data in database or not
        $count = mysqli_num_rows($res); // Function to get all the rows in database

        $sn = 1; //Create a Variable and Assign the value

        //CHeck the num of rows
        if ($count > 0) {
          //WE HAve data in database
          while ($rows = mysqli_fetch_assoc($res)) {
            //Using While loop to get all the data from database.
            //And while loop will run as long as we have data in database

            //Get individual DAta
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            //Display the Values in our Table
      ?>

            <tr>
              <td><?php echo $sn++; ?>. </td>
              <td><?php echo $full_name; ?></td>
              <td><?php echo $username; ?></td>
              <td>
                <a class="btn-primary" href="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id; ?>">Change Password</a>
                <a class="btn-secondary" href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>
                <a class="btn-danger" onclick="showAlertBox('<?php echo $id; ?>')">Delete Admin</a>
              </td>
            </tr>

            <!-- asking the user if he is sure he want to delete the admin  -->
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
              function showAlertBox(adminId) {
                alertBox.style.display = "block";
              
             
              yesBtn.addEventListener("click", function() {
                // Perform the delete action here
                window.location.href = "<?php echo SITEURL ?>admin/delete-admin.php?id=" + adminId;
                hideAlertBox();
              });
            }

              noBtn.addEventListener("click", function() {
                hideAlertBox();
              });


            </script>


      <?php

          }
        } else {
          //We Do not Have Data in Database
        }
      }

      ?>


    </table>


    <div class="clearFix"></div>

  </div>
</div>
<!-- Main Content Section End -->



<?php include('./partials/footer.php') ?>