<?php 
$self = $_SERVER['PHP_SELF'];
if(!strpos($self, "ketua_ekskul/FormLogin.php") && !strpos($self, "ketua_ekskul/registration.php")){
    if(!isset($_SESSION['userdata']['id'])){
        redirect('./ketua_ekskul/FormLogin.php');
    }
}
?>