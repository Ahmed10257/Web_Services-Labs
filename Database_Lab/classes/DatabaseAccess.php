<?php
// Calling the Capsule class from the Illuminate\Database\Capsule namespace
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseAccess implements DbHandler {
    private $capsule;
    //Completed the constructor
    public function __construct() {
        $this->capsule = new Capsule;
        $this->capsule->bootEloquent();
    }
    //Completed the connect method
    public function connect() {
        try {
            $this->capsule->addConnection([
                'driver' => Driver_DB,
                'host' => Host_DB,
                'database' => Name_DB,
                'username' => User_DB,
                'password' => Pass_DB,
                'collation' => collation,
                'charset' => charset,
            ]);
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
            return true;
        } catch(Exception $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    public function get_data($fields = array(), $start = 0) {
        $items = Items::skip($start)->take(5)->get();
        if (empty($fields)) {
            foreach ($items as $item) {
            echo $item->id . " <br>";
                                    }
        } else {
        return $items;
    }
  }
    //Suposed to be done
    public function disconnect() 
      {try {
      capsule::disconnect();
      return true;
    } catch (Exception $err) {
      echo "Error(in disconnect): " . $err->getMessage();
      return false;
    }
  }
  // Working on it
  public function search_by_column($name_column, $value){
        $items = Items::where($name_column, "like", "%$value%")->get();
        if (count($items) > 0)
        return $items;
  }
  // Done
    public function get_record_by_id($id, $primary_key) {
    $item = Items::where($primary_key, "=", $id)->get();
    if (count($item) > 0)
      return $item[0];
    }

    
}