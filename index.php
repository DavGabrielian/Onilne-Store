<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<title>Products</title>

</head>
<body style = "margin: 20px;
              padding: 30px;
              font-size: 1.2em;
              background-color: #ccc
			  ">

	
<?php

include 'connect.php';

$sqlQuery = "SELECT id, title, description, price, count FROM products ";
$resultSet = mysqli_query($link, $sqlQuery) or die("database error:". mysqli_error($link));
?>
<h1><strong>Available now</strong></h1>
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>TITLE</th>
			<th>DESCRIPTION</th>
			<th>PRICE</th>													
			<th>COUNT</th>	
			<th></th>											
			<th></th>											
		</tr>
	</thead>
	<tbody>
		<?php 

		while( $product = mysqli_fetch_assoc($resultSet) ) { ?>
		   	<tr id="<?= $product ['id']; ?>">
			   	<td><?= $product ['id']; ?></td>
		   		<td><?= $product ['title']; ?></td>
			   	<td><?= $product ['description']; ?></td>  				   				   				  
       			<td><?= $product ['price']; ?></td>
				<td><?= $product ['count']; ?></td>
				<td><a class="btn btn-outline-secondary" href="edit.php?id=<?= $product['id']; ?>">Edit</a></td>
				<td><a class="btn btn-outline-secondary" href="delete.php?id=<?= $product['id']; ?>">Delete</a></td>
      		</tr>
		<?php } 

		?>
	</tbody>
</table> 

<?php


$sql = "SELECT * FROM product_images ORDER BY id DESC";
$result = $link->query($sql);

if ($result) {
if($result->num_rows > 0){
    while($row = $query->fetch_assoc()){
		$imageURL = 'uploads/'.$product["file_name"];
?>
    <img src="<?= $imageURL ?>" alt="" >
<?php }
}
}else{ ?>
    <p>No image found...</p>
<?php } ?> 

  <a type="submit" href ='./form.php' class="btn btn-secondary btn-lg">Add a product</a>

  <script>
	  
	  $(function(){
    	$(document).on('click','.btn btn-outline-secondary',function(){
    	    var del_id= $(this).attr('id');
    	    var $ele = $(this).parent().parent();
    	    $.ajax({
    	        url:'delete.php',
    	        type:'GET',
				dataType: 'json',
    	        data:{'id':del_id},
    	        success: function(data){

    	             	if(!data.error){
							<div class="alert alert-info" role="alert">
								Successfuly deleted
							</div>
    	                	$ele.remove();
    	             	}else{
							<div class="alert alert-danger" role="alert">
 		 						Couldn't delete the row
							</div>
    	             	}
    	         	}

    	        });

    	    });
	});

  </script>
	<?php 
	
	?>

</body>
</html>