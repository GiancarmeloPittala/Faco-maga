<?php 
session_start();

function getServerAddress() {
    if(array_key_exists('REMOTE_ADDR', $_SERVER)) return $_SERVER['REMOTE_ADDR'];
    else 
        return false;
      
    }
function addressValido(){
    $serverAddress = getServerAddress();
    if($serverAddress == "::1")
        return true;
    
    $serverAddress = explode(".",$serverAddress);
    if($serverAddress[0] == "192" && $serverAddress[1] == "168")
        return true;
    
    return false;
}

if (!addressValido() && isset($_SESSION['LOGIN_ACCOUNT_NOME']) )
    echo "<script>window.location =\"login.php\" </script>";  


?>