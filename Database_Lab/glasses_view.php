<?php

require_once("vendor/autoload.php");

$my_db = new DatabaseAccess();
$item = null;

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["id"])) {
  if ($my_db->connect()) {
    $item = $my_db->get_record_by_id($_GET["id"], "id");
  }
}

if (!empty($item)) {
?>
<html>
    <body>
        <h1>View Glasses</h1>
        <table>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
            </tr>
            <?php
            
                    echo "<tr>";
                    echo "<td>".$item->id."</td>";
                    echo "<td>".$item->product_name."</td>";
                    echo "<td>".$item->list_price."</td>";
                    echo "<td><img src='../Resources/images/{$item->Photo}' width=20%></td>";
                    echo "</tr>";
            
            ?>
        </table>
        <!-- <a href="<php? echo $previous_page; ?>"> < Back </a> | <a href="<php? echo $next_page; ?>"> Next > </a> -->
    </body>
</html>
<?php
}

$my_db->disconnect();

?>