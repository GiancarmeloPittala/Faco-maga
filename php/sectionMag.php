<?php

include 'ConnDB.php';

$sql = "SELECT COD,DESCR FROM 01_desvar where tipo = 'D';";

$result = $conn->query($sql);
if (!$conn -> query($sql)) {
  echo("Error description: " . $mysqli -> error);
}

else 
while($row = $result->fetch_assoc()) 
    echo "<option value=". $row["COD"].">". $row["DESCR"]." </option>";
    


$conn->close();


?>