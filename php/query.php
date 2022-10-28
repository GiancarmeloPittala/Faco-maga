<?php
include "ConnDB.php";
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $query = $_POST['query'];
    $result = $conn->query($query) or die("Error".$conn->error."<br>".$query);
    $risultato = [];

    while($row = $result->fetch_assoc())
        $risultato['valori'][]=$row;

    if($risultato)//se esistono risultati
    echo json_encode($risultato['valori']);
}
else
    echo "<center><h1 style='color:red'>IMPOSSIBILE ACCEDERE </h1>
        <br><h3>sarai portato in un area accessibile</h3> </center>
        <script>setTimeout(function(){  window.location.replace(\" ../ \"); }, 5000);</script>";

$conn->close();
die;
?>
