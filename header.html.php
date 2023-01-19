
<?php

if (isset($load)){
if (session_status() === PHP_SESSION_NONE){
session_start();
ob_start();
}
date_default_timezone_set('Asia/Seoul');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'i18n/i18n.php';
include 'adapter_db.php';
include_once 'dialog.reciever.php';
include_once 'dialog.php';
//autodetect user language
if (isset($title)){
}
else{
    $title = $i18n_app_name.' v 6.0';
    $description = $i18n_app_description;
    $breadcrumb = $i18n_app_name;

$sql = "SELECT * FROM `site_metadata` WHERE `hostname` = '".$_SERVER["HTTP_HOST"]."'";
$result = $db->query($sql);

foreach ($result as $row){
$title = $row['title'];
$titleMD = $row['title'];
$description = $row['description'];
$breadcrumb =  $row['description'];
}



}


$sql = "SELECT * FROM site_header";
$result = $db->query($sql);
}
else{
die($i18n_invalidaccess);
}
?>


<title><?php echo $title;?></title>
<meta name="title" content="<?php echo $title;?>">
<meta name="description" content="<?php echo $description;?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@400;600;700&display=swap');
body{
font-family: 'IBM Plex Sans KR', sans-serif;
}
</style>
<link href="/resources/style.css?version=<?php echo time();?>" rel="stylesheet">
<!--
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.1/lib/index.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.js"></script>
<link rel="apple-touch-icon" sizes="57x57" href="/resources/images/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/resources/images/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/resources/images/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/resources/images/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/resources/images/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/resources/images/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/resources/images/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/resources/images/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/resources/images/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/resources/images/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/resources/images/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/resources/images/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/resources/images/icon/favicon-16x16.png">
<link rel="manifest" href="/resources/images/icon/manifest.json">

<meta name="msapplication-TileImage" content="/resources/images/icon/ms-icon-144x144.png">

<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://<?php echo $_SERVER["HTTP_HOST"];?>/" />
<meta property="og:image" content="https://<?php echo $_SERVER["HTTP_HOST"];?>/resources/images/thumb.png" />
<meta property="og:description" content="<?php echo $description;?>" />


<!-- Include this to make the og:image larger -->
<meta name="twitter:card" content="summary_large_image">

<?php
if ($_SERVER["HTTP_HOST"] == "tokyoexpress.co.kr"){
    echo '
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5699263119523596"
         crossorigin="anonymous"></script>';
}
?>
</head>
<body>
    <style>
            .rotated {
      animation-duration: 500ms;
animation-name: tdRotate;
/*animation-timing-function: steps(15, end);*/
animation-iteration-count: infinite;
animation-direction: alternate;

}
@keyframes tdRotate {
0% { transform: rotate3d(0, 1, 0, 0deg) scale(1);}
100% { transform: rotate3d(0, 1, 0, 360deg) scale(5);}
}
</style>
<!-- <h1 class="rotated text-8xl font-bold text-red-500 text-center bg-red-100 py-4" style="">수 정 중</h1>-->
<div class="fixed z-50 w-full hidden md:block" x-data="{ atTop: true }" x-on:scroll.window="atTop =( window.pageYOffset > 10) ? false : true " x-bind:class="{ &quot;bg-black shadow-lg&quot;: !atTop }">

<div class="bg-gray-200 dark:bg-gray-800">
<div class="hidden md:flex max-w-screen-xl text-gray-700 text-white px-10 items-center mx-auto">
<?php
if (isset($_SESSION["language"])){
    $sql = "SELECT * FROM `site_list` WHERE `language` = '".$_SESSION["language"]."'";
}
else{
$sql = "SELECT * FROM `site_list` WHERE `language` = 'ko'";
}
$result = $db->query($sql);

if ($_SERVER["HTTP_HOST"] != "ssw.pcor.me"){
foreach ($result as $row){
echo '<a href="'.$row['link'].'"><button class="min-w-32 ';
if ($_SERVER["HTTP_HOST"] == $row['hostname']){
echo 'bg-blue-600 border-blue-600 border text-white py-2 px-2';
}
else{
echo 'dark:text-white text-black border-gray-300 dark:border-gray-700 border py-2 px-2';
}
echo '">';
echo $row['name'];
echo '</button></a>';
}
}
?>

<nav class="flex-col flex-grow flex justify-end md:flex-row">
<?php
if (isset($_SESSION['username'])){
    $stmt2 = $db->query("SELECT * FROM `account_users` WHERE `id` = '".$_SESSION['userid']."'");
$row3 = $stmt2->fetch();

    echo '<a class="px-4 py-1 mt-1.5 dark:text-white text-black" href="https://injeonmetro.co.kr/privacycenter">'.str_replace("$1", $_SESSION['username'] ,$i18n_user).'
    <span class="rounded-lg text-cyan-500 font-bold bg-cyan-100  py-1 px-3 text-sm w-fit h-fit">LV.'.$row3['level'].'</span></a>';
    echo '<a class="px-4 py-1 mt-1.5 dark:text-white text-black" href="/oauth/logout.php">'.$i18n_logout.'</a>';
}
else{
    echo '<a class="px-4 py-1 mt-1.5 dark:text-white text-black" href="/oauth.php">'.$i18n_login.'</a>';
}
?>

<div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex flex-row items-center px-4 py-1 mt-1.5 dark:text-white text-black">
          <span>Language</span>
          <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div style="z-index:9999;" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
          <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-800 text-black dark:text-white">
            <a class="hover:bg-blue-500 hover:text-white rounded-lg block px-4 py-2 mt-2 bg-transparent text-sm" href="/i18n/set.php?lang=ko">한국어</a>
            <a class="hover:bg-blue-500 hover:text-white rounded-lg block px-4 py-2 mt-2 bg-transparent text-sm" href="/i18n/set.php?lang=en">English</a>
            <a class="hover:bg-blue-500 hover:text-white rounded-lg block px-4 py-2 mt-2 bg-transparent text-sm" href="/i18n/set.php?lang=ja">日本語</a>
          </div>
        </div>

</nav>
</div>
</div>

<div style="backdrop-filter:saturate(200%) blur(10px);background-color:rgba(0, 0, 0, 0.8)" class="backdrop-blur-md shadow w-full" >
<div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
<div class="p-4 flex flex-row items-center justify-between">
<a href="/" class="text-lg font-semibold rounded-lg text-white focus:outline-none focus:shadow-outline flex">
<?php
// if hostname is ssw.pcor.me, hide section 
if($_SERVER["HTTP_HOST"] == "ssw.pcor.me"){
echo '<img src="/resources/images/logo_white.svg" class="h-8" alt="로고">';
}
else{
    echo '<img src="/resources/images/logo-white.png" class="h-12" alt="로고">';
}
?>
</a>
<button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline text-white" @click="open = !open">
<svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
<path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
<path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" style="display: none;"></path>
</svg>
</button>
</div>
<nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
<?php
if (isset($_SESSION["language"])){
$sql = 'SELECT * FROM `site_header` WHERE `hostname` = "'.$_SERVER["HTTP_HOST"].'" AND `language` = "'.$_SESSION["language"].'"';
}
else{
$sql = 'SELECT * FROM `site_header` WHERE `hostname` = "'.$_SERVER["HTTP_HOST"].'"';
}
$result = $db->query($sql);
    foreach ($result as $row){
            echo '<a class="px-4 py-2  text-xl font-semibold bg-transparent rounded-full text-white transition ease-in duration-100 transform hover:-translate-y-1 active:translate-y-0 rounded-lg hover:bg-white hover:text-blue-500" href="'.$row['url'].'">'.$row['title'].'</a>';

        }
?>
<!-- add profile image and logout dropdown -->
<?php
if (isset($_SESSION['username'])){
    
        echo '<a class="px-4 py-2  text-xl font-semibold bg-transparent rounded-full text-white" href="https://injeonmetro.co.kr/privacycenter"><img class="rounded-full h-8 w-8 object-cover" src="'.$_SESSION['avatar'].'" alt="프로필 이미지"></a>';

    }

    ?>

</nav></div>

</div>
</div>

<div style="backdrop-filter:saturate(200%) blur(10px);background-color:rgba(0,0,0, 0.9)" class="block md:hidden z-50 shadow fixed w-full" x-data="{ atTop: true }" x-on:scroll.window="atTop =( window.pageYOffset > 10) ? false : true " x-bind:class="{ &quot;bg-black shadow-lg&quot;: !atTop }">
<div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
<div class="p-4 flex flex-row items-center justify-between">
<a href="/" class="text-lg font-semibold rounded-lg text-white focus:outline-none focus:shadow-outline flex"><img src="/resources/images/logo-white.png" class="h-6" alt="로고"></a>

<div class=" flex space-x-5 justify-center items-center pl-2 mt-1">
    <div class="relative cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 ">
    <?php
if (isset($_SESSION['username'])){
    echo '<a href="https://injeonmetro.co.kr/privacycenter">';
        echo '<button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline text-white mr-4"><img class="rounded-full h-6 w-6 object-cover" src="'.$_SESSION['avatar'].'" alt="프로필 이미지"></button></a>';
        echo '<a href="/oauth/logout.php">
        <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline text-white">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
  </svg>
  
    </button>
    </a>';
    
}
else{
    echo '<a href="/oauth.php">
    <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline text-white">
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
</button>
</a>';
}
?>

</div>

<div class="relative cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 ">
<button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline text-white" @click="open = !open">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
</svg>

</button>
</div>

</div>



</div>
<nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
<?php
if (isset($_SESSION["language"])){
    $sql = 'SELECT * FROM `site_header` WHERE `hostname` = "'.$_SERVER["HTTP_HOST"].'" AND `language` = "'.$_SESSION["language"].'"';
    }
    else{
    $sql = 'SELECT * FROM `site_header` WHERE `hostname` = "'.$_SERVER["HTTP_HOST"].'" AND `language` = "ko"';
    }
$result = $db->query($sql);
    foreach ($result as $row){
    echo '<a class="px-4 py-2  text-sm bg-transparent rounded-full text-white" href="'.$row['url'].'">'.$row['title'].'</a>';
    }
    
?>
</nav></div>

</div>

