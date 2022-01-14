<?php

    class DataBaseConfig{
        private $pdo;
        
        public function __construct()
        {
            $this->pdo = new PDO('mysql:host=localhost;port=3308;dbname=product_crud', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function selectQuery(){
            $statement = $this->pdo->prepare('select * from products order by create_date DESC');
            $statement->execute();
            $product_data = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $product_data;
        }

        public function insertProduct($title,$description,$price,$image){
            $imagePathInDB = '';
            if (!is_dir('../images')) {
                mkdir('../images');
            }
            if ($image && $image['tmp_name']) {
                $imgName = $this->randomString(8);
                mkdir("../images/$imgName/");
                move_uploaded_file($image['tmp_name'], "../images/$imgName/".$image['name']);
                $imagePathInDB = "images/$imgName/".$image['name'];
            }

            $date = date('Y-m-d H:i:s');
            $statement = $this->pdo->prepare("insert into products (title, image, description, price, create_date) values ('$title','$imagePathInDB','$description',$price,'$date')");
            $statement->bindValue(':title', $title);
            $statement->bindValue(':image', $imagePathInDB);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':date', $date);
            $statement->execute();
            header('Location: ../index.php');
        }

        public function updateProduct($id,$title,$description,$price,$image){
            $imagePathInDB = '';
            if (!is_dir('../images')) {
                mkdir('../images');
            }
            if ($image && $image['tmp_name']) {
                $imgName = $this->randomString(8);
                mkdir("../images/$imgName/");
                move_uploaded_file($image['tmp_name'], "../images/$imgName/".$image['name']);
                $imagePathInDB = "images/$imgName/".$image['name'];
            }
            var_dump($id,$title, $description, $price, $image);

            $date = date('Y-m-d H:i:s');
            $statement = $this->pdo->prepare("update products SET title='$title',description='$description',image='$imagePathInDB',price=$price,create_date='$date' WHERE products.id='$id'");
            $statement->bindValue(':id', $id);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':image', $imagePathInDB);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':date', $date);
            $statement->execute();
            header('Location: ../index.php');
        }

        public function deleteProduct($id){
            $this->pdo->exec("DELETE FROM `products` WHERE id=$id");
        }

        function randomString($n){
            $characters = '0123456789abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = '';
            for ($i=0; $i < $n; $i++) { 
                $index = rand(0, strlen($characters) - 1);
                $str .= $characters[$index];
            }
            return $str;
        }
    }

?>