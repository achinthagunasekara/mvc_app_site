<?php

/*
 * Author: Achintha Gunasekara
 * Date: 2015
 */
 
//include the base configuration path
require_once('config.ini.php');
//setup the environment
require_once(BASE_PATH.'/code/setup.inc.php');

include "header.php";
include "code/" . $page . ".php";
include "footer.php";

?>
