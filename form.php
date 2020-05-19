<?php 

session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
  <title> Register a product </title>

</head>
<body style = "margin: 20px;
              padding: 40px;
              font-size: 1.5em;
              background-color: #ccc
              ">

    <div class='container'>
      <div class='row'>
        <div class='col-md-6' >

            <h1>Register your product</h1>
            
          <form method='post' action='test.php' enctype="multipart/form-data">
            <div class="form-group">
              <label >Title</label>
              <input type="text" name="title"  class="form-control"  required>
            </div>
            <div class="form-group">
              <label >Description</label>
              <input type="text" name="description" class="form-control"  required>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" name="price" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Count</label>
              <input type="number" name="count" class="form-control"  required>
            </div>
            <div class="form-group">
              <label>Upload Images</label>
              <input type="file" name="files[]" class="btn btn-outline-secondary"  multiple>
            </div>
            <input type="submit" name='submit' class="btn btn-secondary btn-lg" value="Submit" >
          </form>
        </div>

        <div>
		       <br> <br> <h3><?php if(isset($_SESSION['error']['titleErr'])) {echo $_SESSION['error']['titleErr'];} ?></h3> <br>
		       <br>  <h3><?php if(isset($_SESSION['error']['descriptionErr'])) {echo $_SESSION['error']['descriptionErr'];} ?></h3> <br>
		       <br>  <h3><?php if(isset($_SESSION['error']['priceErr'])) {echo $_SESSION['error']['priceErr'];} ?></h3> <br>
		       <br> <h3><?php if(isset($_SESSION['error']['countErr'])) {echo $_SESSION['error']['countErr'];} ?></h3>
	        </div>

     </div>
    </div>

  </body>
</html>

<?php 

session_unset();
