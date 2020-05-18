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
include 'upload.php';




