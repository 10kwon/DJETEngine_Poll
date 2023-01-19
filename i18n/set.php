<?php

$load = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE){
    session_start();
    ob_start();
    }
    
setLocale(LC_ALL, 'ko_KR.UTF8');
include '../header.html.php';

if (isset($_GET["lang"])){
    $_SESSION["language"] = $_GET["lang"];
openDialog($i18n_notification, $i18n_language_set, $i18n_dialog_confirm, '#');
}
else{
openDialog($i18n_api_error, $i18n_error_unset_id, $i18n_dialog_confirm, '#');
}

include '../footer.html.php';
?>