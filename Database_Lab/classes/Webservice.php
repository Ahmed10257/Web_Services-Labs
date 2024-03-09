<?php
class Webservice{
    protected $items;

public function __construct(){
    
}

public function getItems(){
    $fields = array("id", "product_name", "list_price");
    $my_db = new DatabaseAccess();
    $my_db->connect();
    $items=$my_db->get_data($fields,0);
    return $items;
}

public function getSingleItem($id){
    $my_db = new DatabaseAccess();
    $my_db->connect();
    $data = $my_db->get_record_by_id($id, "id");
    // echo json_encode($data);
    if(!empty($data)){
        return $data;
    }
    echo "error Resource dosn't exist";
    return null;

} 
} 