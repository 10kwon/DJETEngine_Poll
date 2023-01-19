<?php
include '../i18n/i18n.php';
if ($load != true){
    echo $i18n_invalidaccess;
    die;
}

//if redirect url is specified, add it to session
if (isset($_GET['redirect'])){
    $_SESSION['redirect'] = $_GET['redirect'];
}
?>
        

<div class="h-screen bg-white relative flex flex-col justify-center items-center">
    <div class="md:border md:border-gray-300 md:w-1/2 bg-white md:shadow-xl shadow-none rounded-xl p-10" >
        <div class="flex flex-col items-center space-y-3" data-aos="zoom-out">
            <span class="text-2xl font-semi-bold leading-normal" ><?php echo $i18n_oauth_select_method;?></span>
            <p class="leading-normal"><?php echo $i18n_oauth_select_method_description;?></p>
        </div>
        <div class="my-8">
            <div class="space-y-9">
              <div class="flex-1">
<div class="mt-8">
<div class="mt-6">
<p class="text-gray-500 mt-4">
    광고
</p>
<?php
include '../injeon/santa/advertisement_generator.php';
?>
    <?php
$sql = "SELECT * FROM `account_method`";
$result = $db->query($sql);

foreach ($result as $row){
echo '<a href="/oauth/'.$row['adapter'].'">
<button class="mt-2 flex items-center justify-center w-full text-white text-center rounded-lg shadow-lg m-auto py-2 text-xl font-bold" style="background-color:'.$row['color'].';">
<img src="/resources/images/'.$row['icon'].'" class="h-8 mr-2">'.str_replace("$1",$row["name"],$i18n_oauth_continuewith).'
</button>
</a>';
}
    ?>





</div>
<p class="mt-6 text-sm text-center text-gray-400"><?php //echo $i18n_oauth_eula_accept;?><br>
<strong class="text-red-500"><?php echo $i18n_oauth_readEULA;?> <a href="https://metroplus.notion.site/cd284b7d3b9a442c92d7529b4b637a73" class="text-blue-400">(23.03.13)</a></strong><br>
<br><a href="javascript:history.back()" class="text-blue-400 uppercase font-bold text-sm flex">
<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
</svg>
<?php echo $i18n_oauth_cancel;?></a>
</p>
</div>
</div>
            </div>
        </div>
    </div>
</div>