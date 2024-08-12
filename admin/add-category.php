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

.form-group.file-input input[type="file"]:hover + label {
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
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- Add Catgeory Form -->
        <form action="" method="POST"  enctype="multipart/form-data" class="category-form">
  <fieldset>
    <legend>Category Details</legend>

    <div class="form-group">
      <label for="title">Category Title:</label>
      <input type="text" name="title" id="title" placeholder="Enter category title here">
    </div>

    <div class="form-group file-input">
  <div class="photo-frame">
    <img id="uploaded-image" src="#" alt="Uploaded Image" width="150" height="150" style="display: none;">
  </div>
  <label for="image">Upload Image</label>
  <input type="file" name="image" id="image" onchange="previewImage(this)">
</div>

    <div class="form-group">
      <label for="featured">Featured:</label>
      <div class="radio-group">
        <input type="radio" name="featured" id="featured-yes" value="yes">
        <label for="featured-yes">Yes</label>

        <input type="radio" name="featured" id="featured-no" value="no">
        <label for="featured-no">No</label>
      </div>
    </div>

    <div class="form-group">
      <label for="active">Active:</label>
      <div class="radio-group">
        <input type="radio" name="active" id="active-yes" value="yes">
        <label for="active-yes">Yes</label>

        <input type="radio" name="active" id="active-yes" value="no">
        <label for="active-yes">No</label>
      </div>
    </div>
  </fieldset>

  <button type="submit" name="submit" class="submit-btn">Submit</button>
</form>

<script>
  function previewImage(input) {
    if (input.files && input.files[0]) {  // if (input.files && input.files): This checks if the input element (the file input field) has a files property, and if the first file in the files array exists. This ensures that a file has actually been selected.
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
if(isset($_POST['submit'])){
   $title=$_POST['title'];


   // for radio input type we need to check weather the button is clicked or not 
   if(isset($_POST['featured'])){
    // get the value from the for else set the deafult value 
    $featured = $_POST['featured'];
   }else{
    $featured =$_POST["no"];
   }

   if(isset($_POST['active'])){
    $active = $_POST['active'];
   }else{
    $active =$_POST["no"];
   }


 if(isset($_FILES['image']['name'])){
$image_name = $_FILES['image']['name'];




$image_parts = explode('.', $image_name);
$ext = end($image_parts);

//Rename the Image
$image_name = "Food_Category_".rand(000, 999).'.'.$ext; 







$source_path = $_FILES['image']['tmp_name'];
$destination_path="../images/category/".$image_name;

$upload = move_uploaded_file($source_path,$destination_path);

if($upload==false){
  $_SESSION['upload'] ='Failed To Upload Image';
  header('location:'.SITEURL.'admin/add-category.php');
  die();
}

 }else{
  $image_name="";
 }

   // create a sql query to insert category into database
   $sql="INSERT INTO tbl_category SET 
   title='$title',
   image_name='$image_name',
   featured='$featured',
   active = '$active'
   ";

$res=mysqli_query($conn,$sql);
if($res==true){
    $_SESSION['add']="Category Added Succesfully";
    header('location:'.SITEURL.'admin/manage-categories.php');
}else{
    $_SESSION['add']="Category Failed to add";
    header('location:'.SITEURL.'admin/add-category.php');
}

}
?>
    </div>
</div>

<?php include('partials/footer.php') ?>