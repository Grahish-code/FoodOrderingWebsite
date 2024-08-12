<?php include('./partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; //Displaying Session Message
            unset($_SESSION['pwd-not-match']); //REmoving Session Message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //Displaying Session Message
            unset($_SESSION['user-not-found']); //REmoving Session Message
        }
        ?>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-full">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //CHeck whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //1. Get the DAta from Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                $res=mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        if($new_password==$confirm_password){
                            $sql2= "UPDATE tbl_admin SET 
                            password = '$new_password'
                            WHERE id = $id
                             ";

                             $res2=mysqli_query($conn,$sql2);

                             if($res2==true){
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                             }
                             else{
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                             }
                        }
                        else{
                                //REdirect to Same Page with Error Message
                                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match. </div>";
                                header('location:'.SITEURL.'admin/update-password.php');
                        }

                    }
                    else
                {
                    //User Does not Exist Set Message and REdirect
                    $_SESSION['user-not-found'] = "<div class='error'>Your Current Password did not match, Please try Again. </div>";
                    //Redirect the User
                    header('location:'.SITEURL.'admin/update-password.php');
                }

                }
                
            }
            ?>


<?php include('partials/footer.php'); ?>