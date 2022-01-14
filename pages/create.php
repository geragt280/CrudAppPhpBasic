<?php
    // echo var_dump($_POST);

    require_once('../databaseconfig/DataBaseConfig.php');

    $database = new DataBaseConfig();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $image = $_FILES['image'] ?? null;
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        // $image = $_POST['title'];
        $price = $_POST['price'];

        $database->insertProduct($title, $description, $price, $image);
    }
    

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/app.css" rel="stylesheet">

    <title>Crud Products!</title>
  </head>
  <body>

  <h1>Create new product</h1>

  <form action="" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Product Image</label>
    <br/>
    <input type="file" name="image">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Title</label>
    <input type="text" class="form-control" name="title" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Description</label>
    <textarea class="form-control" name="description"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Product Price</label>
    <input type="number" step="0.01" class="form-control" name="price">
  </div>

  <div class="mb-3">
    <label class="form-label">Product Create Date</label>
    <input type="date" class="form-control" name="date">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

   
  </body>
</html>