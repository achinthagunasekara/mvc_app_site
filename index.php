<?php

require_once('config.ini.php');
require_once(BASE_PATH.'/code/setup.inc.php');

include "header.php";
include "code/" . $page . ".php";
include "footer.php";

?>
