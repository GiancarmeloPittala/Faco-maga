<?php
include "ConnDB.php";
header("Content-Type: application/json");
try {
  if(!$_SERVER['REQUEST_METHOD'] === 'POST') new Exception('Errore metodo');

  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  $query = $data['query'];
  $data = $conn->query($query);


  if ( !$data ) new Exception($conn->error);

  $fetched = $data->fetch_all( MYSQLI_ASSOC );

  
  echo json_encode($fetched);

} catch (Exception $e) {
  echo json_encode($e->getMessage());
}
$conn->close();
die;