
<?php
if(isset($_SESSION['avatar'])) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
        ob_start();
        }
    header('Location: ' . 'index.php');
        } else{
            $load = true;
            include 'header.html.php';
    echo '
    <!DOCTYPE HTML>
<html>';
            include 'oauth/adapter.php';
            include 'footer.html.php';
            echo '</html>';
        }


?>
