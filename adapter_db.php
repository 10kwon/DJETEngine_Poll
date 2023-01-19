<?php
include 'credentials.php';

define('DBHOST', $DB_host);
define('DBUSER', $DB_user);
define('DBPASS', $DB_pass);
define('DBNAME', $DB_name);

setLocale(LC_ALL, 'ko_KR.UTF8');
$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
