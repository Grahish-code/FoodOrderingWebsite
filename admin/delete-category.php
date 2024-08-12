<?php include('../config/constant.php'); 



if(isset($_GET['id']) AND isset($_GET['image_name']))
{
$id = $_GET['id'];
$image_name= $_GET['image_name'];

if($image_name != "")
{
    //Image is Available. So remove it
    $path = "../images/category/".$image_name;
    //REmove the Image
    $remove = unlink($path);

    //IF failed to remove image then add an error message and stop the process
    if($remove==false)
    {
        //Set the SEssion Message
        $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
        //REdirect to Manage Category page
        header('location:'.SITEURL.'admin/manage-category.php');
        //Stop the Process
        die();
    }
}

$sql = "DELETE FROM tbl_category WHERE id=$id";

$res = mysqli_query($conn, $sql);

if($res==true){
    $_SESSION['delete'] = "Admin Deleted Successfully.";
    header('location:'.SITEURL.'admin/manage-categories.php');
}else{
    $_SESSION['delete'] = "Deleteion Of Admin unsuccessful.";
    header('location:'.SITEURL.'admin/manage-categories.php');
}

}else{
    header('location:'.SITEURL.'admin/manage-categories.php');
}


?>

