<?php

include 'ConnDB.php';

$sql = "SELECT COD,DESCR FROM 01_desvar where tipo = 'D';";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) 
    echo "<option value=". $row["COD"].">". $row["DESCR"]." </option>";
    


$conn->close();


?>