<?php
include 'i18n/i18n.php';
if ($load != true){
    echo $i18n_invalidaccess;
    die;
}
if (isset($_SESSION["dialog_title"])){
  if ($_SESSION["dialog_title"] != ""){
    echo '
<div x-data="{ open: true }"  x-show="open"   x-init="() => setTimeout(() => open = false, 5500)" class="min-h-screen py-6 flex flex-col justify-center sm:py-12 fixed z-50 inset-0 overflow-y-auto h-full w-full px-4" >
  
  <div  x-show="open"     
        x-transition:enter-start="opacity-0 scale-90" 
        x-transition:enter="transition duration-200 transform ease"
        x-transition:leave="transition duration-200 transform ease"
        x-transition:leave-end="opacity-0 scale-90"
         class="border max-w-screen-md md:max-w-screen-lg mx-auto fixed bg-white inset-x-5 p-5 bottom-5 rounded-lg shadow-lg flex gap-4 flex-nowrap text-left items-center justify-between">
    <div class="w-full"><strong>'.$_SESSION["dialog_title"].'</strong> '.$_SESSION["dialog_msg"].'</div>
    <div class="flex gap-4 items-center flex-shrink-0">
    ';
    if (isset($_SESSION["dialog_secondaryAction"])){}
    if ($_SESSION["dialog_secondaryAction"] != null){
        echo '
        <a href="'.$_SESSION["dialog_secondaryActionurl"].'">
        <button class="bg-gray-500 text-white text-center w-full shadow-lg py-2 px-2 rounded-lg font-bold text-lg">'.$_SESSION["dialog_secondaryAction"].'</button>
        </a>
        ';}
        if ($_SESSION["dialog_action"] == $i18n_dialog_confirm){
            echo '
            <a href="#"><button @click="open = false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
  <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
</svg>

</button></a>
          </div>
        </div></div>';
        }
        else{
            echo '
            <a href="'.$_SESSION["dialog_actionurl"].'"><button @click="open = false" class="bg-blue-500 px-5 py-2 text-white rounded-lg shadow-lg font-bold hover:bg-blue-700 focus:outline-none">'.$_SESSION["dialog_action"].'</button></a>
          </div>
        </div></div>';
        }
      
  $_SESSION["dialog_title"] = "";
$_SESSION["dialog_msg"] = "";
$_SESSION["dialog_action"] = "";
$_SESSION["dialog_actionurl"] = "";
$_SESSION["dialog_secondaryAction"] = "";
$_SESSION["dialog_secondaryActionurl"] = "";
}
}
  ?>