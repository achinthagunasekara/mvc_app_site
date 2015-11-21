<?php

/*
 * Author: Achintha Gunasekara
 * Date: 2015
 */
 
$name = "Achintha";

//assign any varuables to the template
$tpl->assign("name", $name);
//display the template
$tpl->display('home.tpl');

?>
