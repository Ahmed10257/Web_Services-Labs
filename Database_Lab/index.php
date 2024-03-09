<?php
require_once("vendor/autoload.php");

$my_db = new DatabaseAccess();
$fields = array("id", "product_name", "list_price");
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$items= array();

$totalItems = 16;

$totalPages = ceil($totalItems / records_per_page);

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
  if ($_GET["click"] == "prev") {
    $page = max($page - 1, 0);
  } else if ($_GET["click"] == "next") {
    $page = min($page + 1, $totalPages - 1);
  }
}


if($my_db->connect())   {
    echo "Connected to the database";
    echo "<pre>";
    $items=$my_db->get_data($fields,$page*records_per_page);
    echo "</pre>";
} 

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["name_column"]) && isset($_GET["value"])) {
  $items = $my_db->search_by_column($_GET["name_column"], $_GET["value"]);
}
?>
<html>
    <body>
  <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name_column">Search Column:</label>
    <select name="name_column">
      <?php foreach ($fields as $field) { ?>
        <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
      <?php } ?>
    </select>
    <label for="value">Search Value:</label>
    <input type="text" name="value" >
    <button type="submit">Search</button>
    <a href='adding_glasses.php'>Add a glasses</a>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Show All</a>
  </form>
  <?php
  if (count($items) > 0) {
    echo '<table>';
    echo '<tr>';
    foreach ($fields as $field) {
      echo '<th>' . $field . '</th>';
    }
    echo '</tr>';

    foreach ($items as $item) {
      echo '<tr>';
      foreach ($fields as $field) {
        echo '<td>' . $item->$field . '</td>';
      }
      echo '<td><a href="glasses_view.php/?id=' . $item->id . '">More</a></td>';
      echo '</tr>';
    }
    echo '</table>';
    echo '<div>';
    if ($page > 0) {
      echo "<a href='?click=prev&page=$page'>Prev </a>";
    }
    if ($page < $totalPages - 1) {
      echo "<a href='?click=next&page=$page'>Next</a>";
    }
    echo '</div>';
  }
  ?>
</body>

</html>
<?php
$my_db->disconnect();
?>