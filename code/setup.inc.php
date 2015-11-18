<?php

/*
 * Author: Archie Gunasekara
 * Date: 2015
 */

$config = parse_ini_file(BASE_PATH . '/includes/config.ini.php', TRUE);

$valid_pages = array(
		"home" => "Home Page Title",
		"sample_page" => "Sample Page Title"
		);

//Load all the class files
if ($handle = opendir('includes/classes/'))
{
	while (false !== ($file = readdir($handle)))
	{
		if ($file != "." && $file != "..")
		{
			$reverse = strrev($file); //remove any temp files
			if($reverse{0} != "~")
			{
				include "includes/classes/" . $file;
			}
		}
	}

	closedir($handle);
}
else
{
	echo "Failed to load the modules!";
}

define('SMARTY_DIR', BASE_PATH.'/libs/smarty/');
define('ADODB_BASE_PATH', BASE_PATH.'/libs/adodb/');

if (file_exists(ADODB_BASE_PATH . 'adodb.inc.php'))
{
	// use a diff. dir per unix user as sometimes
	// we run as nobody/apache/cron/manual user
	// and we get permission problems.
	$unix_user = trim('whoami');
	$ADODB_CACHE_DIR = BASE_PATH . '/files/adodb_cache/' . $unix_user;
	unset($unix_user);

	if(!file_exists($ADODB_CACHE_DIR))
	{
		mkdir($ADODB_CACHE_DIR);
	}

	require_once(ADODB_BASE_PATH . 'adodb-exceptions.inc.php');
	require_once(ADODB_BASE_PATH . 'adodb.inc.php');

	/**
	* ADODB Connection to DB
	* @global mixed $db
	*/

	$db = ADONewConnection($config['DB']['DRIVER']);
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	// We are not using PConnect here as mysql will re-use the connection when we connect to another db on the same server
	$db->NConnect($config['DB']['HOST'], $config['DB']['LOGIN'], $config['DB']['PASSWORD'], $config['DB']['NAME']);

	if (isset($config['DEBUG']) && $config['DEBUG'])
	{
		$db->debug = true;
	}
}
else
{
	echo "ADODB class not found";
}

require_once(SMARTY_DIR . 'Smarty.class.php');

class Smarty_Extend extends Smarty
{
	function Smarty_Extend($path_dir, $cache = false, $subdirs = false)
	{
		//$this->Smarty();
		parent::__construct();
		$this->template_dir = $path_dir.'/templates';
		$this->secure_dir = $path_dir.'/templates';
		$this->config_dir = $path_dir.'/config';
		$this->compile_dir = $path_dir.'/files/templates_c';
		$this->cache_dir = $path_dir.'/files/cache';
		$this->caching = $cache;
		$this->use_sub_dirs = $subdirs;
		$this->config_booleanize = true;
	}
}

define('DEFAULT_CACHE_LIFETIME', 3600);

/**
* Main Instance of Smarty Template Engine
* @global Smarty_Extend $tpl
*/

$tpl = new Smarty_Extend(BASE_PATH,false);

if (file_exists(BASE_PATH . '/libs/phpmailer/class.phpmailer.php')) {
        require_once(BASE_PATH . '/libs/phpmailer/class.phpmailer.php');
}
else
{
        echo "PHP Mailer Class Not Found";
}

/*
* Turn on error reporting in debug mode
* this is done after smarty etc since they
* trigger lost of E_STRICT errors
*/

if (isset($config['DEBUG']) && $config['DEBUG']) {
    error_reporting(E_ALL | E_STRICT);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}

/* Set a few vars that are always available to all apps */

$tpl->assign('config_path', $config['PATH']);
$tpl->assign('base_path', '');

?>
