<?php
session_start();
$nome = "GIAVARICAMBI";
$pass ="GIAVA21@1";


     if( ($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['nome']) && isset($_POST['pass']) )
        {
            if( (strtoupper($_POST['nome']) == $nome && strtoupper($_POST['pass']) == $pass) )
            {
               $_SESSION['LOGIN_ACCOUNT_NOME'] = "confermato";

               echo "ACCETTATO";
            }            
        }
        else
            echo "<center><h1 style='color:red'>IMPOSSIBILE ACCEDERE </h1>
                <br><h3>sarai portato in un area accessibile</h3> </center>
                <script>setTimeout(function(){  window.location.replace(\" ../ \"); }, 5000);</script>";
        
        die;
?>