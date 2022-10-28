<?php
include 'ConnDB.php';

 $codArt = $_POST['CODART'];
 $result = $conn->query("SELECT COUNT(CODART) as CODART FROM 01_anaart WHERE CODART = '".$codArt."'") or die("errore". $conn->error);

 if($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
     echo $row['CODART'];
 }
$conn->close();
?>
