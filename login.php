<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

 <!--****************Icon******************-->
 <link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">

  <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">

    <title>Autenticazione</title>

    <style>
   *{font-family:Lora,serif}body{margin:0;padding:0;background:#34495e}.box{width:300px;padding:40px;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#191919;text-align:center;border-radius:24px}.box h1{color:#fff;text-transform:uppercase;font-weight:500}.box input[type=password],.box input[type=text]{border:0;background:0 0;display:block;margin:20px auto;text-align:center;border:2px solid #3498db;padding:14px 10px;width:200px;outline:0;color:#fff;border-radius:24px;transition:.25s}.box input[type=password]:focus,.box input[type=text]:focus{width:280px;border-color:#2ecc71}.box input[type=submit]{border:0;background:0 0;display:block;margin:20px auto;text-align:center;border:2px solid #2ecc71;padding:14px 40px;outline:0;color:#fff;border-radius:24px;transition:.25s;cursor:pointer}.box input[type=submit]:hover{background:#2ecc71}
    </style>
</head>
<body>
    <form id="autenticazione" method="POST" autocomplete="off" class="box">
    <h1>LOGIN</h1>
    <input type="text" id="nome" name="nome" placeholder="Nome">
    <input type="password" id="pass" name="pass" placeholder="Password">
    <span id="errorMessage"></span>
    <input type="submit" value="INVIO">
    </form>
</body>

<script src="js/libext/jquery-3.4.0.min.js"></script>
<script> document.getElementById("autenticazione").onsubmit=function(e){e.preventDefault();let t=document.getElementById("nome"),n=document.getElementById("pass");""==t.value&&(t.style.border="2px solid red"),""==n.value&&(n.style.border="2px solid red"),t.addEventListener("change",function(){t.value.length>0?t.style.border="2px solid #3498db":t.style.border="2px solid red"}),n.addEventListener("change",function(){n.value.length>0?n.style.border="2px solid #3498db":n.style.border="2px solid red"}),n.value.length>0&&t.value.length>0&&$.ajax({url:"php/login/index.php",dataType:"text",method:"POST",data:$("#autenticazione").serialize(),statusCode:{404:function(){alert("php/query.php not found")}}}).done(function(e){if("ACCETTATO"==e)window.location.replace("index.php");else{let e=document.getElementById("errorMessage");e.innerHTML="NOME UTENTE O PASSWORD NON CORRETTA",e.style.color="red",e.fontSize="20px",console.log("else")}}).fail(function(e,t){console.log("error"+e+" "+t)})}; </script>
</html>