<?php 
$self = $_SERVER['PHP_SELF'];
if(!strpos($self, "admin/FormLogin.php") && !strpos($self, "admin/registration.php")){
    if(!isset($_SESSION['userdata']['id'])){
        redirect('./admin/FormLogin.php');
    }
}
?>