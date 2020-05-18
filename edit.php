<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
<body style = "margin: 20px;
              padding: 30px;
              font-size: 1.2em;
              background-color: #ccc
              ">
<?php
    include 'connect.php';

    if(!empty($_GET['id']) && is_numeric($_GET['id']) ) {
        $id = $_GET['id'];
    } else {
        header("location: error.php"); 
    }


$query = mysqli_query($link,"SELECT * from products where id='$id'"); 
$data = mysqli_fetch_assoc($query); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $title = mysqli_real_escape_string($link, htmlspecialchars($_POST["title"]));
    $description = mysqli_real_escape_string($link, htmlspecialchars($_POST["description"]));
    $price = mysqli_real_escape_string($link, htmlspecialchars($_POST["price"]));
    $count = mysqli_real_escape_string($link, htmlspecialchars($_POST["count"]));

	
    $edit = mysqli_query($link,"update products set title='$title', description='$description', price='$price',count='$count' where id='$id'");
	
    if($edit)
    {
        mysqli_close($link); 
        header("location: index.php"); 
        exit;
    }
    else
    {
        echo mysqli_error($link);
    }    	
}

if ($data['title']==null) {
    header("location: error.php"); 
}
if ($data['description']==null) {
    header("location: error.php"); 
}
if ($data['price']==null) {
    header("location: error.php"); 
}
if ($data['count']==null) {
    header("location: error.php"); 
}

?>

<h2><strong>Update Data</strong></h2>

<form method="POST">
  <input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter the title" required>
  <input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description" required>
  <input type="text" name="price" value="<?php echo $data['price'] ?>" placeholder="Enter the price" required>
  <input type="number" name="count" value="<?php echo $data['count'] ?>" placeholder="Enter the count" required>
  <input type="submit" name="update" class="btn btn-outline-secondary" value="Update">
</form>