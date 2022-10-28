<?php

include 'php/ConnDB.php';


$sql = "SELECT * FROM 01_anaart limit 10000";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()){
  $data['value'][] = $row;
}


$results = ["sEcho" => 1,
        	"iTotalRecords" => count($data['value']),
        	"iTotalDisplayRecords" => count($data['value']),
        	"aaData" => $data['value'] ];


echo json_encode($results);

$result->free();
$results->free();
$data->free();
?>