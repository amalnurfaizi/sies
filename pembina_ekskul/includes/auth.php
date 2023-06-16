<?php 
$self = $_SERVER['PHP_SELF'];
if(!strpos($self, "pembina_ekskul/FormLogin.php") && !strpos($self, "pembina_ekskul/registration.php")){
    if(!isset($_SESSION['userdata']['id'])){
        redirect('./pembina_ekskul/FormLogin.php');
    }
}
?>