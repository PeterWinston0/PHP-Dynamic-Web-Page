<?php
   require("classes/image-upload-class.php");
   if(isset($_POST['upload-image'])){
      if($_FILES['image']['error'] == 0){
         $image_upload = new ImageUpload($_FILES);
      }
   }
?>
<!DOCTYPE html>
 
<body>
<form action="" method="post" enctype="multipart/form-data">
   <h2><i class="far fa-file-image"></i> Choose an image to upload</h2>
   <input type="file" name="image" >
   <h3>
      Accepted image file types are <span>( .jpg .png .gif )</span>,
      and the file must be smaller than <span>2MB</span>.
   </h3>
 
   <input type="submit" name="upload-image" value="upload-image">
   <p class="error"><?php echo @$image_upload->error; ?></p>
</form>