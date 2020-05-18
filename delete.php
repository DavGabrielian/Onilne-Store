<?php
include 'connect.php';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: error.php");
}



$del = mysqli_query($link, "DELETE FROM products WHERE id = '$id'");



if ($del) {
    echo json_encode(['error' => false, 'msg' => "Successfuly deleted"]);
    header("location: index.php");
    exit;
} else {
    echo json_encode(['error' => true, 'msg' => "Couldn't delete the row"]);
}
