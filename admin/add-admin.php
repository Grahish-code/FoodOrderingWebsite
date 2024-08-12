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
        <h1>Add Admin</h1>

        <br><br>
        <?php  
if(isset($_SESSION['add'])){
echo ($_SESSION['add']); // displaying session thing
unset($_SESSION['add']); // removing session
}
?>
<br><br><br>
        <form action="" method="POST">

<table class="tbl-30">
    <tr>
        <td>Full Name: </td>
        <td>
            <input type="text" name="full_name" placeholder="Enter Your Name">
        </td>
    </tr>

    <tr>
        <td>Username: </td>
        <td>
            <input type="text" name="username" placeholder="Your Username">
        </td>
    </tr>

    <tr>
        <td>Password: </td>
        <td>
            <input type="password" name="password" placeholder="Your Password">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
        </td>
    </tr>

</table>

</form>


</div>
</div>

<?php include('partials/footer.php'); ?>

<?php


//Get The Data From The Form
if(isset($_POST['submit'])){
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);  //password encrytion with md5

//2. SQL Query To save the data into Database
$sql = "INSERT INTO tbl_admin SET 
full_name='$full_name',
username='$username',
password='$password'
";

//3.Execute Query and Save Data in Database
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($res==TRUE){
  $_SESSION['add']="Admin Added Successfully";
  //Redirect Page
  header("location:".SITEURL.'admin/manage-admin.php');
}
else{
  $_SESSION['add']="Fail";
  //Redirect Page
  header("location:".SITEURL.'admin/add-admin.php');
}

}
?>