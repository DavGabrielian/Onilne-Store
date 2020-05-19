<?php

session_start();

include "connect.php";


$title = $description = $price  = $count =  "";
$titleErr = $descriptionErr = $priceErr = $countErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($link, htmlspecialchars($_POST["title"]));
    if(empty($_POST["title"])) {
         $_SESSION['error']['titleErr'] = '*Title is required';
    } else {
         $title = $_POST["title"];
    }
    $description = mysqli_real_escape_string($link, htmlspecialchars($_POST["description"]));
    if(empty($_POST["description"])) {
         $_SESSION['error']['descriptionErr'] = "*Description is required";
    } else {
        $description = $_POST["description"];
    }
    $price = mysqli_real_escape_string($link, htmlspecialchars($_POST["price"]));
    if(empty($_POST["price"])) {
         $_SESSION['error']['priceErr'] =  "*Price is required";
    } else {
        $price = $_POST["price"];
    }
    $count = mysqli_real_escape_string($link, htmlspecialchars($_POST["count"]));
    if(empty($_POST["count"])) {
        $_SESSION['error']['countErr'] =  "*Count is required";
   } else {
       $count = $_POST["count"];
   }
}


if(empty($_SESSION['error']))
{

    // ADD DATA
    $sqlPost = mysqli_query($link, "INSERT INTO products (title, description, price, count)
    VALUES ('$title',  '$description', '$price', '$count')");



    if($sqlPost) {
        header("Location: index.php");
    } else {
        //insert problem
        header("location: error.php"); 


    }

} else {
     
    header("Location: form.php");
    
}

//UPLOAD

if (isset($_POST['submit'])) {
    
    $targetDir = "uploads/";
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

    $statusMsg  = $insertValuesSQL  =  '';
    $errorMsg = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
        foreach ($_FILES['files']['name'] as $key => $val) {

            // upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // validation
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // upload
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // insert sql 
                    $insertValuesSQL .= "('" . $fileName . "', NOW()),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }
        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            //  file name into database 
            $insert = $link->query("INSERT INTO product_images (file_name, uploaded_on) 
                                    VALUES $insertValuesSQL");
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    echo $statusMsg;
}





