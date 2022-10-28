<?php
include '../ConnDB.php';


    $q=$_POST["q"];
    //$q = "p";
    $sql="SELECT CODART FROM 01_anaart WHERE CODART LIKE '%$q%' limit 5";
    $result = $conn->query($sql);

    $json=array();

    while($row = $result->fetch_array(MYSQLI_BOTH)) {
  
      array_push($json, $row['CODART']);
    }

    echo json_encode($json);

$conn->close();



/* $json = array(
        'nome'=> $row['CODART'],
      );*/
?>