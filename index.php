<?php
/*
 *  Welcome to Dana's MVC Attempt. Is it awful?
 */
# constant the files require
const ISINDEX = 1;
 
# load config file or init file
if(!require_once('config/config.php')) {require_once('config/init.php');}

require_once(FILE_ROOT . '/models/model.php');
require_once(FILE_ROOT . '/views/view.php');
require_once(FILE_ROOT . '/controllers/controller.php');

# what goes here?
$controller = new Controller();
?>