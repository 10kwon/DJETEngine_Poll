<?php
session_start();

$load = true;
require('../../credentials.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);

define('OAUTH2_CLIENT_ID', $oAuth_client_discord); //Your client Id
define('OAUTH2_CLIENT_SECRET', $oAuth_secret_discord); //Your secret client code

$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discordapp.com/api/users/@me';


// Start the login process by sending the user to Discord's authorization page
if(get('action') == 'login') {

  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://'.$_SERVER["HTTP_HOST"].'/oauth/discord.php',
    'response_type' => 'code',
    'scope' => 'identify'
  );

  // Redirect the user to Discord's authorization page
  header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}


// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code')) {

  // Exchange the auth code for a token
  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://'.$_SERVER["HTTP_HOST"].'/oauth/discord.php',
    'code' => get('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


  header('Location: ' . $_SERVER['PHP_SELF']);
}

if(session('access_token')) {

  $user = apiRequest($apiURLBase);

$_SESSION['username'] = $user->username;
$_SESSION['avatar'] = 'https://cdn.discordapp.com/avatars/'.$user->id.'/'.$user->avatar.'.png?size=512';
$_SESSION['userid'] = $user->id;
$_SESSION['method'] = 'discord';

require('../../header.html.php');
$sql0 = "SELECT * FROM `account_users` WHERE `method` = 'discord' AND `id` = '".$_SESSION['userid']."';";
$result0 = $db->query($sql0);
if ($result0->rowCount() > 0){
  $sql = "UPDATE `account_users` SET `username` = '".$_SESSION['username']."', `avatar` = '".$_SESSION['avatar']."' WHERE `account_users`.`id` = '".$_SESSION['userid']."' AND `account_users`.`method` = 'discord';";
  $result = $db->query($sql);
}
else{
  $sql = "INSERT INTO `account_users` (`method`, `id`, `username`, `avatar`, `level`, `creation`) VALUES ('discord', '".$_SESSION['userid']."', '".$_SESSION['username']."', '".$_SESSION['avatar']."', '2', CURRENT_TIMESTAMP);";
  $result = $db->query($sql);
}
$sql2 = "SELECT * FROM `account_ban` WHERE `method` = 'discord' AND `id` = '".$_SESSION['userid']."'";
$result2 = $db->query($sql2);
//
if ($result2->rowCount() > 0){
  while($row = $result2->fetch_assoc() ){

    openDiscreteDialog($i18n_oauth_banned, $i18n_oauth_ban_reason.$row["reason"], $i18n_dialog_previous, '/');
      session_destroy();
  }
}
else{
    echo "<script>location.href='/';</script>";
  exit;
}
///'.$user->id

} else {
  require('../../header.html.php');
  echo $i18n_invalid_request;
}


if(get('action') == 'logout') {
  session_destroy();
  echo "<script>location.href='/';</script>";
  die();
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

?>
<?php
require('../../footer.html.php');
?>
