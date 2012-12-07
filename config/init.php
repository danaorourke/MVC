<?php
/* init gatekeeper */ if (!defined('ISINDEX')) { die('You should not be here.');}

/* file will eventually contain entire set-up script */
    # check for config file
    # config file exists, display success for setup

/* start up the db */
class Initializer extends Model {
    private $filename;
    private $queries;
    private $cleanquery;
    
    private function openInitFile() {
        $this->filename = FILE_ROOT . "/models/schema/init.mysql";
        if($this->queries = fopen($this->filename, 'r')) {
            while(!feof($this->queries)) {
                $this->cleanqueries .= fgets($this->queries);
            } #endwhile
            $this->queries = fclose($this->queries);
        } else {
            print "Cannot connect to initalization file.";
        }
    } #end openInitFile
    
    public function __construct() {
        $this->openInitFile();
        $this->db_query($this->cleanqueries);
    }
}
?>