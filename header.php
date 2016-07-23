<?php
/*
 * Author: Achintha Gunasekara
 * Date: 2015
 */
if(array_key_exists(@$_REQUEST['page'], $valid_pages)) {
	
	$title = $valid_pages[@$_REQUEST['page']];
	$page = @$_REQUEST['page'];
}
else {
	
	$title = $valid_pages['home'];
	$page = 'home';
}
?>
<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<META NAME="description" CONTENT="Some Description">

<title><?php echo $title ?></title>

<!-- Your CSS and Java Script -->
<!-- eg: bootstrap css, 960gs... -->

</head>
<body>

<ul>
<li><a href="index.php?page=home">Home</a></li>
<li><a href="index.php?page=sample_page">Sample Page</a></li>
</ul>
