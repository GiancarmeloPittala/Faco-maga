<?php
include 'ConnDB.php';


    $query= $_POST['query'];
    //$query = 'SELECT A.CODART,A.ARTMAS,D.DESCR AS CAT,A.DESC1,A.PRE1,A.PRE5,C.PROGR AS QTA,AE.EAN FROM 01_anaart AS A JOIN 01_desvar AS D ON A.CATMER = D.COD JOIN 01_conart19 AS C ON A.CODART = C.CODART JOIN 01_anaarte AS AE ON A.ID = AE.IDANAART WHERE A.CODART LIKE "a%" AND D.TIPO="M"';
             
    
    $result = $conn->query($query);

    $json=array();

    while($row = $result->fetch_array(MYSQLI_BOTH)) {

        $json[]=[ $row['CODART'],$row['ARTMAS'],$row['EAN'] ,(FLOAT)$row['QTA'],$row['CAT'],$row['DESC1'],(FLOAT)$row['PRE5'],round((float)$row['RICARICO'],2),(FLOAT)$row['PRE1'] ] ;
    }
    echo json_encode($json);

$conn->close();



/* $json = array(
        'nome'=> $row['CODART'],
      );*/
?>