<?php

/*
 * Author: Achintha Gunasekara
 * Date: 2015
 */
 
require_once('config.ini.php'); //include the base configuration path
require_once(BASE_PATH.'/code/setup.inc.php'); //setup the environment
include "header.php";
include "code/" . $page . ".php";
include "footer.php";

?>
