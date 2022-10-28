<?php
include '../ConnDB.php';



    //$q = "p";
    


    $result = $conn->query($_POST['query']);

    $json=array();

    while($row = $result->fetch_array(MYSQLI_BOTH)) {
  
      array_push($json, trim($row['VAL']));
    }

    echo json_encode($json);

$conn->close();



/* $json = array(
        'nome'=> $row['CODART'],
      );*/
?>