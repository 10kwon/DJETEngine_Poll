<?php
$load = true;

if (session_status() === PHP_SESSION_NONE){
    session_start();
    ob_start();
    }
    
setLocale(LC_ALL, 'ko_KR.UTF8');
include '../../header.html.php';
//show error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//set mime to json
if (isset($_SESSION["userid"])){
    $members = json_decode(file_get_contents('/home/ubuntu/10kbot/members.json'), true);
    //check each child's userID field
    $found = false;
    foreach ($members as $child) {
        if ($child['userId'] == $_SESSION['userid']) {
            $found = true;
            break;
        }
    }
    if ($found == false) {
        openDialog('메트로+에 참여해주세요', '메트로+에 참여하지 않으면 기록이 저장되지 않아요.', '메트로+ 참여하기 ', 'https://discord.gg/Ntg7ErBVHY');
    }

if (isset($_POST["vote"])){
    if ($_POST["vote"] == "yes" or $_POST["vote"] == "nopunish" or $_POST["vote"] == "notserious" or $_POST["vote"] == "abstain" or $_POST["vote"] == "notguilty" or $_POST["vote"] == "donotvote" or $_POST["vote"] == "myfault"){
        $stmt2 = $db->query("SELECT * FROM `vote` WHERE `userid` = '".$_SESSION["userid"]."'");
while($row2 = $stmt2->fetch()){
    openDialog('이미 투표함', '이미 투표했습니다', $i18n_dialog_confirm, $i18n_dialog_confirm);
    die;
}

$sql = 'INSERT INTO `vote` (`method`, `userid`, `poll`) VALUES ("discord", "'.$_SESSION["userid"].'", "'.$_POST["vote"].'")';
$result = $db->query($sql);
openDialog('투표 완료', '', $i18n_dialog_confirm, '#');

    die;

    }
}
else{
    //open discrete alert
    openDialog('표의 값이 없음', '표를 선택하세요', $i18n_dialog_confirm, $i18n_dialog_confirm);
die;
}
}
else{
    openDialog('로그인 후 사용', '로그인하세요', $i18n_dialog_confirm, $i18n_dialog_confirm);
    die;
}