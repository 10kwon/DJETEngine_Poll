<?php

session_start();
$load = true;

if($_GET['action'] == 'login') {
    require('../../header.html.php');
    $sql0 = "SELECT * FROM `account_users` WHERE `id` = '".$_SERVER['REMOTE_ADDR']."' AND `method` = 'ip';";
    $result0 = $db->query($sql0);
    if ($result0->rowCount() > 0){
        foreach ($result0 as $row){
            $_SESSION['username'] = $row['username'];
      $_SESSION['userid'] = $row['id'];
      $_SESSION['avatar'] = $row['avatar'];
      $_SESSION['method'] = 'ip';
            }
    }
    else{

    $state = time();
    $nickname = $i18n_oauth_ip_anonymous.$state;
    $_SESSION['avatar'] = '/resources/images/ip.png';

      $sql = "INSERT INTO `account_users` (`method`, `id`, `username`, `avatar`, `level`, `creation`) VALUES ('ip', '".$_SERVER['REMOTE_ADDR']."', '".$nickname."', '".$_SESSION['avatar']."', '1', CURRENT_TIMESTAMP);";
      $result = $db->query($sql);
      $_SESSION['username'] = $nickname;
      $_SESSION['userid'] = $_SERVER['REMOTE_ADDR'];
      $_SESSION['method'] = 'ip';
    }
    $sql2 = "SELECT * FROM `account_ban` WHERE `method` = 'ip' AND `id` = '".$_SESSION['userid']."'";
    $result2 = $db->query($sql2);
    //
    if ($result2->rowCount() > 0){
      while($row = $result2->fetch_assoc() ){
        openDiscreteDialog($i18n_oauth_banned, $i18n_oauth_ban_reason.$row["reason"], $i18n_dialog_previous, '/');
        session_destroy();
      }
    }
    else{

      openDiscreteDialog($i18n_oauth_ip_done, $i18n_oauth_ip_warning, $i18n_dialog_understand, '/');

          require('../../footer.html.php'); 
      exit;
    }


  }

if($_GET['action'] == 'logout') {
    session_destroy();
    echo "<script>location.href='/';</script>";
    die();
  }
  
?>