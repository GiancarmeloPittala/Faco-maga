<?php
include '../ConnDB.php';


    $q=$_POST["q"];
    $sql="SELECT `ARTMAS` FROM `01_anaart` WHERE ARTMAS LIKE '$q%' limit 5";
    $result = $conn->query($sql);

    $json=array();

    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      array_push($json, $row['ARTMAS']);
    }

    echo json_encode($json);

$conn->close();
?>