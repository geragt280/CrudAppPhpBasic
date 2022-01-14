<?php
    $pdo = new PDO('mysql:host=localhost;port=3308;dbname=product_crud', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $pdo->prepare('select * from products order by create_date DESC');
    $statement->execute();
    $product_data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($product_data);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet">

    <title>Crud Products!</title>
  </head>
  <body>

  <h1>Crud Operations PHP</h1>

  <p>
      <a href="pages/create.php" class="btn btn-success">Create</a>
  </p>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($product_data as $key => $value): ?>
        <tr>
            <th scope="row"><?=$key+1 ?></th>
            <td><img src="<?= $value['image'] ?>" alt="No image to preview" width="100px" height="100px" /></td>
            <td><?= $value['title'] ?></td>
            <td><?= $value['description'] ?></td>
            <td><?= $value['price'] ?></td>
            <td><?= $value['create_date'] ?></td>
            <td>
                <form method="GET" action="pages/edit.php" style="display: inline-block;">
                  <input type="hidden" name="id" value="<?= $value['id'] ?>"  />
                  <input type="hidden" name="title" value="<?= $value['title'] ?>"  />
                  <input type="hidden" name="description" value="<?= $value['description'] ?>"  />
                  <input type="hidden" name="image" value="<?= $value['image'] ?>"  />
                  <input type="hidden" name="price" value="<?= $value['price'] ?>"  />
                  <button type="submit" class="btn btn-outline-secondary">Edit</button>
                </form>
                <form method="POST" action="pages/delete.php" style="display: inline-block;">
                  <input type="hidden" name="id" value="<?= $value['id'] ?>"  />
                  <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
  </tbody>
</table>
  </body>
</html>