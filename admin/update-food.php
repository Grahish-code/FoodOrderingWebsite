<?php include('./partials/menu.php') ?>

<style>
    .main-content {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        /* Light background color */
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

    .wrapper-1 {
        background-color: #fff;
        /* White wrapper background */
        border-radius: 10px;
        /* Increased border radius */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
        /* Darker heading color */
    }

    .food-form {
        width: 100%;
    }

    .food-table {
        width: 100%;
        border-collapse: collapse;
    }

    .food-table th,
    .food-table td {
        padding: 15px;
        /* Increased padding for better spacing */
        border: 1px solid #ddd;
        border-radius: 5px;
        /* Consistent border radius */
    }

    .food-table th {
        text-align: left;
        font-weight: bold;
        background-color: #eee;
        /* Light table header background */
    }

    .food-form input[type="text"],
    .food-form textarea,
    .food-form select {
        width: 100%;
        /* Ensures full width for inputs and textarea */
        padding: 10px;
        /* Increased padding for cleaner look */
        border: 1px solid #ccc;
        border-radius: 5px;
        /* Consistent border radius */
        box-sizing: border-box;
        /* Ensures padding doesn't affect width */
    }

    .food-form textarea {
        height: 100px;
        /* Adjust textarea height as needed */
    }

    .food-form input[type="number"] {
        width: 80px;
        /* Adjusted width for number input */
    }

    .food-form input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .radio-group {
        display: flex;
        /* Arranges radio buttons horizontally */
        margin-top: 5px;
    }

    .radio-group input[type="radio"] {
        margin-right: 10px;
        /* Spacing between radio buttons */
    }

    .btn {
        padding: 10px 20px;
        /* Increased padding for buttons */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        /* Smooth transition for hover effects */
        background-color: #fff6bf;
        /* White button background */
        color: #333;
        /* Darker text color */
    }

    .btn:hover {
        background-color: #ff6b81;
        /* Pink hover color (your primary color) */
        color: white;
        /* White text on hover */
    }

    /* Optional animation for form submission (replace with your preferred animation) */
    .food-form input[type="submit"]:hover {
        animation: button-pulse 0.5s infinite ease-in-out;
    }
</style>
<div class="main-content">
    <div class="wrapper-1">
        <h1>Add Food</h1>
        <br><br>
        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food WHERE id='$id'";
            $res2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);

            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            header('location:' . SITEURL . 'admin/manage-categories.php');
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data" class="food-form">
            <table class="food-table">
                <tr>
                    <th>Title:</th>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>Description:</th>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th>Price:</th>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <th>Select Image:</th>
                    <td>
                        <?php
                        if ($current_image == " ") {
                            //Image Not Available 
                            echo "Image Not Available";
                        } else {
                        ?>
                            <div class="form-group file-input">
                                <div class="photo-frame">
                                    <img id="uploaded-image" src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="Uploaded Image" width="150" height="150">
                                </div>
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" onchange="previewImage(this)">
                            </div>
                    </td>
                <?php

                        }
                ?>

                </tr>

                <tr>
                    <th>Category:</th>
                    <td>
                        <select name="category" required>
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Featured:</th>
                    <td>
                        <div class="radio-group">
                            <input <?php if ($featured == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" id="featured-yes" value="Yes" required>
                            <label for="featured-yes">Yes</label>
                            <input <?php if ($featured == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" id="featured-no" value="No">
                            <label for="featured-no">No</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Active:</th>
                    <td>
                        <div class="radio-group">
                            <input <?php if ($active == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="active" id="active-yes" value="Yes">
                            <label for="active-yes">Yes</label>
                            <input <?php if ($active == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="active" id="active-no" value="No">
                            <label for="active-no">No</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-primary">
                    </td>
                </tr>
            </table>
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
        <?php
        if (isset($_POST['submit'])) {
            //1.Get All the deatials from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2.upload image if selected

            //first check weather upload button is clicked or not 
            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];
                //check weather file is uploaded or not 
                if ($image_name != " ") {
                    //IMAGE IS AVAILABLE 
                    //A.uploaded new image
                    // Rename the image
                    $ext = end(explode('.', $image_name)); // get the extension of image
                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext; // This will remane the image

                    //now to upload image we need src path and destination path 
                    $src_path = $_FILES['image']['tmp_name']; // soruce path
                    $dest_path = "../images/food/" . $image_name; // Destination Path
                    $upload = move_uploaded_file($src_path, $dest_path);

                    // check weather image is uploaded or not 
                    if ($upload == false) {
                        $_SESSION['upload'] = "Failed to upload new Image";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        // Stop the process
                        die();
                    }
                    //3.Remove the image if new image is uploaded and current image exisit
                    // B.Remove current image if avaliable
                    if ($current_image != " ") {
                        // Current image is available
                        // remove the image 
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        // check weather the image is remove or not
                        if ($remove == false) {
                            // failed to remove the image 
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove the image</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_image;  // Default Image When Image Is Not Selected
                }
            } 
            else 
            {
                $image_name = $current_image; //Default Image when button is not clicked
            }
            //4.update the food in database
            $sql3 = "UPDATE tbl_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id
        ";
            $res3 = mysqli_query($conn, $sql3);
            if ($res3 == true) {
                //Query Exectued and Food Updated
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Failed to Update Food
                $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>