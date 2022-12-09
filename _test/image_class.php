<?php
class ImageUpload
{
    // Class properties ============================
    private $image_name; // image name.
    private $image_type; // image type.
    private $image_size; // image size.
    private $image_temp; // the images temporary location.
    private $uploads_folder = "./assets/img"; // the uploads folder

    // setting the max upload file size to 2MB.
    private $upload_max_size = 2 * 1024 * 1024;
    // creating an array of allowed image types.
    private $allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    public $error; // I need a property to store any validation error.

    // Class methods =======================
    public function __construct($image)
    {
        $this->image_name = $image['image']['name'];
        $this->image_size = $image['image']['size'];
        $this->image_temp = $image['image']['tmp_name'];
        $this->image_type = $image['image']['type'];

        // These are all the methods we need in our class.
        $this->isImage(); // Checking if the uploaded file is actually an image.
        $this->imageNameValidation(); // Sanitizing the images name.
        $this->sizeValidation(); // Validating the file size.
        $this->checkFile(); // Checking if the file exists in uploads folder.

        // If there is no error.
        if ($this->error == null) {
            // moving the file from the temporary location to the uploads folder.
            $this->moveFile();
        }
        // if there is no errors
        if ($this->error == null) {
            // Recording the images name in the database.
            $this->recordImage();
        }
    }

    private function isImage(){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $this->image_temp);
        finfo_close($finfo);
        if(!in_array($mime, $this->allowed_image_types) ){
           return $this->error = "This is not a valid image type";
        }
     }

     private function imageNameValidation(){
        return $this->image_name = filter_var($this->image_name, FILTER_SANITIZE_STRING);
     }

     private function sizeValidation(){
        if($this->image_size > $this->upload_max_size){
           return $this->error = "File is bigger than 2MB";
        }
     }

     private function checkFile(){
        if(file_exists($this->uploads_folder.$this->image_name)){
           return $this->error = "File already exists in folder";
        }
     }

     private function moveFile(){
        if(!move_uploaded_file($this->image_temp, $this->uploads_folder.$this->image_name)){
           return $this->error = "There was an error, please try again";
        }
     }

     private function recordImage(){
        $mysqli = new mysqli('localhost', 'peter', '1234', 'playground');
        $mysqli->query("INSERT INTO images(image_name)VALUES('$this->image_name')");
        if($mysqli->affected_rows != 1){
           if(file_exists($this->uploads_folder.$this->image_name)){
              unlink($this->uploads_folder.$this->image_name);
           }
           return $this->error = "There was an error, please try again";
        }
     }
}