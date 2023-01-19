<?php
if (isset($_SESSION["language"])){
    //if language is english and host is injeonmetro.co.kr

    $classpath = 'lang_'.$_SESSION["language"].'.php';

    include 'lang_ko.php';
    include $classpath;
}
else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
$alang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);  
$_SESSION["language"] = $alang;  
$classpath = 'lang_'.$alang.'.php';
    include 'lang_ko.php';
    include $classpath;
    }
    else{
    include 'lang_ko.php';
    }
?>
