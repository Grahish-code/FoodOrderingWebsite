<?php



include('../config/constant.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    // Remove the image name if avaiable
    if($image_name!=""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);
    
    if($remove==false){
        $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
        //REdirect to Manage Food
        header('location:'.SITEURL.'admin/manage-food.php');
        //Stop the Process of Deleting Food
        die();
    }

}
//Delete Data Base
$sql= "DELETE FROM tbl_food WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res==true){
      //Food Deleted
      $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
}
else{
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
}
}
else{
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>

