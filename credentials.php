<?php
if (isset($load)){
#데이터베이스 어댑터

$DB_host = "127.0.0.1";
$DB_user = "사용자명을 입력합니다";
$DB_pass = "비밀번호를 입력합니다";
$DB_name = "DB명을 입력합니다.";

#oAuth 어댑터
$oAuth_client_discord = "디스코드 클라이언트 ID를 입력합니다.";
$oAuth_secret_discord = "디스코드 클라이언트 시크릿을 입력합니다.";

$API_youtube = "유튜브 API 키를 입력합니다.";
}
else{
    die( '정상적이지 않은 접근입니다.');
}