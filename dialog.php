<?php
include 'i18n/i18n.php';
//open alert with function
function openDialog($title, $msg, $action, $actionurl, $secondaryAction = NULL, $secondaryActionurl = NULL) {
  if (isset($_SESSION["dialog_title"])){
  if ($_SESSION["dialog_title"] == "") {
  $_SESSION["dialog_title"] = $title;
$_SESSION["dialog_msg"] = $msg;
$_SESSION["dialog_action"] = $action;
$_SESSION["dialog_actionurl"] = $actionurl;
$_SESSION["dialog_secondaryAction"] = $secondaryAction;
$_SESSION["dialog_secondaryActionurl"] = $secondaryActionurl;
echo "<script>    if ('referrer' in document) {
  window.location = document.referrer;
  /* OR */
  //location.replace(document.referrer);
} else {
  window.history.back();
}</script>";
}
  }
else{
  $_SESSION["dialog_title"] = $title;
  $_SESSION["dialog_msg"] = $msg;
  $_SESSION["dialog_action"] = $action;
  $_SESSION["dialog_actionurl"] = $actionurl;
  $_SESSION["dialog_secondaryAction"] = $secondaryAction;
  $_SESSION["dialog_secondaryActionurl"] = $secondaryActionurl;
  echo "<script>    if ('referrer' in document) {
    window.location = document.referrer;
    /* OR */
    //location.replace(document.referrer);
  } else {
    window.history.back();
  }</script>";
}
}
function openDiscreteDialog($title, $msg, $action, $actionurl, $secondaryAction = NULL, $secondaryActionurl = NULL) {
global $i18n_notification;
  echo '
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12 fixed z-50 inset-0 overflow-y-auto h-full w-full px-4"
    x-data="{ open: false }"  x-init="() => setTimeout(() => open = true, 500)" x-show="open"     
            x-transition:enter-start="opacity-0 scale-90" 
            x-transition:enter="transition duration-200 transform ease"
            x-transition:leave="transition duration-200 transform ease"
            x-transition:leave-end="opacity-0 scale-90" style="background-color:rgba(0,0,0,0.5);">
      <div class="py-3 sm:max-w-xl sm:mx-auto">
     <div  class="bg-white dark:bg-gray-900 min-w-1xl flex flex-col shadow-lg rounded-xl">
          <div class="px-8 py-7">
            <p class="text-gray-700  dark:text-gray-200">'.$i18n_notification.'</p>
    
            <h2 class="text-gray-900 dark:text-gray-100 text-3xl font-semibold  ">'.$title.'</h2>
          <br>
            <p class="text-gray-700 dark:text-gray-300">'.$msg.'</p>
            </div>';
// when secondary action is set
if ($secondaryAction != null) {
  //divide button into two
  //when screen size is smaller than md, show it in each row

  echo '
  <div class="flex flex-row justify-center py-7">
  <a href="'.$actionurl.'">
  <button @click="open = false" class="bg-cyan-500 text-white text-center w-full focus:bg-cyan-700 py-2 px-4 rounded-lg font-bold text-lg">'.$action.'</button>
</a>
<div class="ml-4 mr-4"></div>
<a href="'.$secondaryActionurl.'">
<button @click="open = false" class="bg-cyan-100 text-cyan-500 text-center w-full focus:bg-cyan-300 py-2 px-4 rounded-lg font-bold text-lg">'.$secondaryAction.'</button>
</a>
</div>
';
}else{
  echo '          <a href="'.$actionurl.'">
            <p @click="open = false" class="bg-cyan-500 text-cyan-100 text-white text-center w-full m-auto focus:bg-cyan-700 py-2 px-2 rounded-lg font-bold text-lg">'.$action.'</p>
          </a>';
}




          echo '
        </div>
      </div>
    </div>
    ';
}
?>
