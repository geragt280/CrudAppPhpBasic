<?php 

    include_once('../databaseconfig/DataBaseConfig.php');
    $id = $_POST['id'] ?? null;


    $database = new DataBaseConfig();

    if (!$id) {
        header('Location: ../index.php');
        exit;
    }


    $database->deleteProduct($id);

    header('Location: ../index.php');

?>