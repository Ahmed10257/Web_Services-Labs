<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
  </head>
  <body>
    <div><h1>Adding a Glasses</h1></div>
    <div>
      <form action="" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" /><br />
        <label for="name">Name</label>
        <input type="text" name="name" /><br />
        <label for="price">Price</label>
        <input type="text" name="price" /><br />
        <label for="img">Image</label>
        <input type="file" name="img" /><br />
        <input type="submit" />
      </form>
    </div>
  </body>
</html>

<?php
require_once("vendor/autoload.php");

$my_db= new DatabaseAccess();
$my_db->connect();
$glass = new Items();
        
        $glass->id = $_POST['id'];
        $glass->product_name = $_POST['name'];
        $glass->list_price = $_POST['price'];
        $glass->Photo = $_POST['img'];
        $glass->save();
$my_db->disconnect();
?>