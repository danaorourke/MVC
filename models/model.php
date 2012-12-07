<?php
/* model gatekeeper */ if (!defined('ISINDEX')) { die('You should not be here.');}

/* Base Model Class, to be extended by other classes */
class Model {
    private $connection;

    # connect
    public function db_connect() {
        $db = 'mysql:host=' . HOSTNAME . ';dbname=' . DATABASE;
        try {
            $this->connection = new PDO ($db, USERNAME, PASSWORD, array(PDO::ATTR_PERSISTENT => true));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e ) {
            $c .= 'Error: ' . $e->getMessage();
            return $c;
        }
    }
    # close - does pdo have a proper close function?
    
    # update
    public function db_update() {}

    # insert
    public function db_insert() {}
    
    # delete
    public function db_delete() {}
    
    # select
    public function db_select() {}
    
}
?>