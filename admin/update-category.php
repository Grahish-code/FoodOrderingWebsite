<?php include('./partials/menu.php') ?>

<style>
    .category-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #f5f5f5;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group.file-input {
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-group.file-input .photo-frame {
        width: 150px;
        height: 150px;
        border: 2px solid #ccc;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .form-group.file-input .photo-frame img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .form-group.file-input label {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-group.file-input input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .form-group.file-input input[type="file"]:hover+label {
        background-color: #45a049;
    }

    fieldset {
        border: none;
        padding: 0;
        margin-bottom: 20px;
    }

    legend {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    .radio-group {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .radio-group {
        display: flex;
        align-items: center;
    }

    .radio-group input[type="radio"] {
        margin-right: 5px;
        margin-left: 5px;
    }

    .submit-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    //Redirect to manage category Page
                    header('location:' . SITEURL . 'admin/manage-categories.php');
                }
            }
        } else {
            //Redirect to manage category Page
            header('location:' . SITEURL . 'admin/manage-categories.php');
        }
        ?>





        <!-- Add Catgeory Form -->
        <form action="" method="POST" enctype="multipart/form-data" class="category-form">
            <fieldset>
                <legend>Category Details</legend>

                <div class="form-group">
                    <label for="title">Category Title:</label>
                    <input type="text" name="title" id="title" placeholder="Enter category title here" value="<?php echo $title; ?>">
                </div>

                <!-- Current Image -->
                <div class="form-group file-input">
                    <div class="photo-frame">
                        <img id="uploaded-image" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Uploaded Image" width="150" height="150">
                    </div>


                    <label for="image">Upload Image</label>
                    <input type="file" name="image" id="image" onchange="previewImage(this)">
                </div>








                <div class="form-group">
                    <label for="featured">Featured:</label>
                    <div class="radio-group">
                        <input <?php if ($featured == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" id="featured-yes" value="yes">
                        <label for="featured-yes">Yes</label>

                        <input <?php if ($featured == "no") {
                                    echo "checked";
                                } ?> type="radio" name="featured" id="featured-no" value="no">
                        <label for="featured-no">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="active">Active:</label>
                    <div class="radio-group">
                        <input <?php if ($active == "yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" id="active-yes" value="yes">
                        <label for="active-yes">Yes</label>

                        <input <?php if ($active == "no") {
                                    echo "checked";
                                } ?> type="radio" name="active" id="active-yes" value="no">
                        <label for="active-yes">No</label>
                    </div>
                </div>
            </fieldset>

            <button type="submit" name="submit" class="submit-btn">Submit</button>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>




        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) { // if (input.files && input.files): This checks if the input element (the file input field) has a files property, and if the first file in the files array exists. This ensures that a file has actually been selected.
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('uploaded-image').src = e.target.result;
                        document.getElementById('uploaded-image').style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <!-- End Catgeory Form -->

        <?php

        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //1. Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Updating New Image if selected
            //Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {
                //Get the Image Details
                $image_name = $_FILES['image']['name'];

                //Check whether the image is available or not
                if ($image_name != "") {
                    //Image Available

                    //A. UPload the New Image

                    //Auto Rename our Image
                    //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                    $image_parts = explode('.', $image_name);
                    $ext = end($image_parts);

                    //Rename the Image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // e.g. Food_Category_834.jpg


                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //Finally Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);


                    //Check whether the image is uploaded or not
                    //And if the image is not uploaded then we will stop the process and redirect with error message
                    if ($upload == false) {
                        //SEt message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        //Redirect to Add CAtegory Page
                        header('location:' . SITEURL . 'admin/manage-categories.php');
                        //STop the Process
                        die();
                    }



                    //B. Remove the Current Image if available
                    // if ($current_image != "") {
                    //     $remove_path = "../images/category/" . $current_image;

                    //     $remove = unlink($remove_path);

                    //     //CHeck whether the image is removed or not
                    //     //If failed to remove then display message and stop the processs
                    //     if ($remove == false) {
                    //         //Failed to remove image
                    //         $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                    //         header('location:' . SITEURL . 'admin/manage-categories.php');
                    //         die(); //Stop the Process
                    //     }
                    // }




                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //3. Update the Database
            $sql2 = "UPDATE tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE id=$id
            ";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //4. REdirect to Manage Category with MEssage
            //CHeck whether executed or not
            if ($res2 == true) {
                //Category Updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-categories.php');
            } else {
                //failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                header('location:' . SITEURL . 'admin/manage-categories.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>