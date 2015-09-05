#MVC Application/Site Template

This is a PHP web application/site template. This follows MVC pattern.

This application used following libraries.

* adodb - http://adodb.sourceforge.net
* phpmailer - http://phpmailer.worxware.com
* smarty - http://www.smarty.net

I have used Smarty library to move view away from the model and controller.

##Installation

Make sure you have Apache, PHP and MySQL installed

Copy the application directory into your web server directory

Set the permissions to Apache User. I use Ubuntu and Apache runs as www-data user

```bash
chown -R www-data:www-data mvc_site_app

chmod -R 0755 mvc_site_app
```

Then open the first configuration file

/mvc_site_app/config.ini.php

Set the base path in the file, save and exit (in the example below, it runs in /var/www/html/)

```php
define("BASE_PATH", '/var/www/html/mvc_site_app');
```

Then open the second configuration file

/mvc_site_app/includes/config.ini.php

Please configure, mysql host, database, user and password. This is importnat or the application won't start.

There is also a configuration called [CONTACT_ME]. This is used by the example module provided in /mvc_site_app/includes/classes/mail.class.php. This section is optional and you'll only need to configure it, if you are going to use the mail.class.php.

That's it! Now go to http://YOUR_WEB_SERVER/mvc_site_app. You should see the app.

##Layout

╔═══════════════════╗
║                   ║
║   Header File     ║
║                   ║
╟───────────────────╢
║ 					║
║ 					║
║ 	Page Stuff		║
║ 					║
║ 					║
╟───────────────────╢
║ 					║
║   Footer File     ║
║                   ║
╚═══════════════════╝

Anything you'd put on header file will always appear in the application. Same goes for the footer page. However content on "Page" will change based on the view.

## Adding a new Page

Open /mvc_site_app/code/setup.ini.php file.

Locate the $valid_pages array and add the new page you'll be creating. Please note array Key is the file name (without the extension) and array value is the HTML page title. Open /mvc_site_app/header.php file and look at <title> HTML tag to see how this is done. Please note unless the page you're viewing is in the $valid_pages array, it can't be displayed.

EG: 

```php
$valid_pages = array(
		"home" => "Home Page Title",
		"sample_page" => "Sample Page Title",
		"sample_page_2" => "Sample Page Title 2"
		);
```

Create the HTML page under "/mvc_site_app/templates/" directory.

Create a page with your application code under "/mvc_site_app/code/" directory. Now assign any variables that needs to be displayed on the HTML page as below.

$tpl->assign('variable', $variable);

Then display the HTML page

$tpl->display('home.tpl');

You'll be able to access your assigned variables on the HTML page using Smarty syntax EG: {$variable}. Please refer to the Smarty documentation at http://www.smarty.net/documentation for more information.

##Adding Modules

Please note any PHP classes you add under "/mvc_site_app/includes/classes" gets auto loaded into the application. (This is done by /mvc_site_app/code/setup.ini.php file)

Please make sure to name your module as MODULE_NAME.class.php to ensure they get loaded.

##Application Configuration File

There are already two configuration sections on the file. You can add as many as you like. Then you're able to access these items within your code.

```php
$config["SAMPLE_SECTION"]["CONFIG_ITEM"]
```

##CSS, JavaScript and ETC.

You can add CSS, JavaScript and etc on the <head> section in the header file.