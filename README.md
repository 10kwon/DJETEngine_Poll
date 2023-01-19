# DJETEngine_Poll
투표에 사용하는 '디젯엔진'의 투표시스템입니다.

## 절차
### 1. Tailwind CSS 설정
NodeJS 환경에서 Tailwind CSS를 사용하기 위해선 `tailwindcss`와 `postcss`를 설치해야 합니다.
```bash
npm install
```
NodeJS가 설치되어 있지 않다면, [NodeJS 공식 홈페이지](https://nodejs.org/ko/)에서 다운로드 받으세요.

### 2. CSS 빌드
```bash
npx tailwindcss -i ./input.css -o ./resources/style.css --watch
```
`input.css`를 `style.css`로 빌드합니다. (라우팅 시스템에 의해 어떤 계열 사이트에서도 접근 가능) `--watch` 옵션을 사용하면, `input.css`가 변경될 때마다 자동으로 빌드합니다.

### 3. 서버 구성
LAMP 환경에서 구동하여야 합니다.
이때, 가상 호스트 설정 파일 (대개 `/etc/apache2/sites-available/000-default.conf`에 위치해 있음)을 열어 아래와 같은 내용을 추가합니다.
```apache
<VirtualHost *:80>
        ServerName example.com
        ServerAdmin webmaster@localhost
        DocumentRoot /home/ubuntu/html/DJETEngine_poll/djet
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        ErrorDocument 404 "/router.php"
</VirtualHost>
```
`ServerName`은 해당 사이트의 도메인을, `DocumentRoot`는 해당 사이트의 루트 디렉토리를 지정합니다. `ErrorDocument`는 404 에러가 발생했을 때, `router.php`를 실행시킵니다.

### 4. 데이터베이스 구성
데이터베이스는 MySQL을 사용합니다. `clone.sql`을 실행하여 데이터베이스를 구성합니다.

### 5. 설정 파일 수정
`credentials.php`를 열어 아래와 같이 수정합니다.
```php
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
```
