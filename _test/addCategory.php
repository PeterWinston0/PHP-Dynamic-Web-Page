<?php require_once "../../DB/dbcon.php";
if (isset($_POST['submit'])){

    $title = $_POST['title'];

    if ((($_FILES['file']['type']=="image/gif") ||
        ($_FILES['file']['type']=="image/jpeg") ||
        ($_FILES['file']['type']=="image/png") ||
        ($_FILES['file']['type']=="image/pjpeg"))&&
        ($_FILES['file']['size']<10000000)){
        if($_FILES['file']['error']>0){
            echo "error code: ". $_FILES['file']['error'];
        }else{
            echo "Uploaded: ". $_FILES['file']['name']. "<br>";
            echo "Type: ". $_FILES['file']['type']. "<br>";
            echo "Size: ". $_FILES['file']['size']. "<br>";
            echo "Temp file: ".$_FILES['file']['tmp_name']. "<br>";

            if (file_exists("img/".$_FILES['file']['name'])){
                echo "no dude, you already have tha file!";
            }else{
                move_uploaded_file($_FILES['file']['tmp_name'], "img/".$_FILES['file']['name']);
                    $myFile = $_FILES['file']['name'];
                    $dbCon = dbCon($user, $pass);
                    $query = $dbCon->prepare("INSERT INTO category(`title`, `image`) VALUES ('$title', '$myFile')");
                    $query->execute();
                    header("Location: ../../admin/index.php?status=added");
            }
        }
    }else{ 
        echo "invalid file!";
    }
    }else{
        header("Location: ../../admin/index.php?status=0");
    }
