<?php

session_start();
$load = true;

if($_GET['action'] == 'login') {
    require('../header.html.php');
    $sql0 = "SELECT * FROM `account_users` WHERE `id` = '".$_SERVER['REMOTE_ADDR']."' AND `method` = 'ip';";
    $result0 = $db->query($sql0);
    if ($result0->rowCount() > 0){
        foreach ($result0 as $row){
            $_SESSION['username'] = $row['username'];
            }
    }
    else{

    $state = time();
    $nickname = '익명이'.$state;
    $_SESSION['avatar'] = '/resources/images/ip.png';

      $sql = "INSERT INTO `account_users` (`method`, `id`, `username`, `avatar`, `level`, `creation`) VALUES ('ip', '".$_SERVER['REMOTE_ADDR']."', '".$nickname."', '".$_SESSION['avatar']."', '0', CURRENT_TIMESTAMP);";
      $result = $db->query($sql);
      $_SESSION['username'] = $nickname;
      $_SESSION['userid'] = $_SERVER['REMOTE_ADDR'];
    }
    $sql2 = "SELECT * FROM `account_ban` WHERE `method` = 'ip' AND `id` = '".$_SESSION['userid']."'";
    $result2 = $db->query($sql2);
    //
    if ($result2->rowCount() > 0){
      while($row = $result2->fetch_assoc() ){
          echo "<script>alert('당신은 서비스 이용이 제한된 사용자입니다. (사유: ".$row["reason"].")');";
          echo "location.href='/';</script>";
          session_destroy();
      }
    }
    else{
        echo "<script>location.href='/';</script>";
      exit;
    }


  }

if($_GET['action'] == 'logout') {
    session_destroy();
    echo "<script>location.href='/';</script>";
    die();
  }
  
?>