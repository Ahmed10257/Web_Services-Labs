<?php

require './vendor/autoload.php';

$urlParts = explode('/', $_SERVER['REQUEST_URI']);

$resource = $urlParts[4];
$resourceId = (isset($urlParts[5]) && is_numeric($urlParts[5])) ? (int) $urlParts[5] : 0;

/**
 * 1- Define METHOD
 * 2- Define RESOURCE
 * 3- Define Resource_ID
 */
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $data = handleGet($resource, $resourceId);
        echo json_encode($data);
        // echo $_SERVER['REQUEST_URI'].PHP_EOL;
        // echo $resource.PHP_EOL;
        // echo $resourceId.PHP_EOL;
        break;
    case 'POST':
        
        $my_db= new DatabaseAccess();
        $my_db->connect();
        $glass = new Items();
        
        $glass->id = 595;
        $glass->product_name = "custom";
        $glass->list_price = "custom";
        $glass->Photo = "custom";
        $glass->save();
        echo "Will create ".$glass->product_name." Glasses";
        $data=200;
        break;
    case 'PUT':
        echo "Will update";
        $data=200;
        break;
    case 'DELETE':
        echo "Will delete";
        $data=200;
        break;

    default:
        echo 'method not allowed';
        $data=null;
        break;
}

$statusCode = is_null($data) ? 405 : 200;
http_response_code($statusCode);
header('Content-Type: application/json');

// if (!empty($data)) {
    // echo json_encode($data);
// }

/**
 * 
 * Get with no item id (item id = 0) => List all items
 * Get with item id => get only single item by id
 * 
 * @param type $resource
 * @param type $resourceId
 * @return type
 */
function handleGet($resource, $resourceId) {
    if ($resource == 'items') {
        if ($resourceId != 0) {
            return (new  Webservice())->getSingleItem($resourceId);
        }
        return (new Webservice())->getItems();
    }
}
