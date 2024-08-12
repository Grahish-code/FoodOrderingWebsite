<?php include('partials/menu.php'); ?>

<style>
   
    form {
  display: flex; /* Arrange form elements horizontally */
  flex-direction: column; /* Stack elements vertically */
  align-items: center; /* Center elements horizontally */
  width: 100%; /* Make form fit container */
  max-width: 400px; /* Limit form width for responsiveness */
  margin: 0 auto; /* Center form horizontally */
  padding: 20px;
  border-radius: 5px; /* Add rounded corners */
  background-color: #f2f2f2; /* Light gray background */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Table Base */
.tbl-30 {
  width: 100%; /* Make table fit form container */
  border-collapse: collapse; /* Remove default cell spacing */
}

/* Table Rows */
.tbl-30 tr {
  margin-bottom: 15px; /* Add space between rows */
}

/* Table Labels (Left Column) */
.tbl-30 td:first-child {
  width: 30%; /* Fixed width for labels */
  text-align: right; /* Align labels to the right */
  padding-right: 10px; /* Add some padding for separation */
  font-weight: bold; /* Make labels stand out */
}

/* Table Inputs (Right Column) */
.tbl-30 td:last-child {
  width: 70%; /* Remaining space for input fields */
  padding: 5px 10px; /* Add padding for readability */
  border-radius: 30px; /* Rounded corners for inputs */
  font-size: 16px; /* Consistent font size */
}

/* Input Fields (within right column cells) */
.tbl-30 td input[type="text"],
.tbl-30 td input[type="password"] {
  width: 100%; /* Make input fields fill available space */
  border: none; /* Remove default border (inherited from table cell) */
  outline: none; /* Remove default outline on focus */
  padding: 5px; /* Consistent padding for inputs */
  font-family: inherit; /* Use same font family as form */
}

/* Submit Button */
.btn-secondary {
  padding: 10px 20px; /* Adjust padding as needed */
  border: none;
  border-radius: 5px; /* Rounded corners for button */
  cursor: pointer; /* Indicate clickable button */
  background-color: #3498db; /* Blue background */
  color: #fff; /* White text */
  font-weight: bold; /* Make button text bolder */
  transition: all 0.3s ease-in-out; /* Add smooth transitions */
  margin-right: 120px;
    margin-top: 20px;
}

.btn-secondary:hover {
  background-color: #2980b9; /* Darker blue on hover */
  transform: translateY(-2px); /* Slight upward movement on hover */
}
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>