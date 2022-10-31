<?php
include 'ConnDB.php';

$anno = date("y");
$fullanno = date("Y-m-d");
$rim_ret = 'RIM';
$conn->autocommit(FALSE);

function query(string $query, string $type, array $params, bool $returnData = true){
  global $conn;

  $stmt = $conn->prepare($query);
  if ( $stmt === false)
    die ('prepare() failed: ' . $conn->error);

  $result = $stmt->bind_param($type, ...$params);
  if ( $result === false)
    die ('bind_param() failed: ' . $conn->error);
  
  $result = $stmt->execute() or die("ERRORE : ".$conn->error." ");
  
  printf("%d row inserted.\n", $stmt->affected_rows);
  if ( $result === false)
    die ('execute() failed: ' . $conn->error);
  
  if ( $returnData ){
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }
 
  
}

function aggiornaArticolo($data){ 
  global $conn;
  $q = "UPDATE 01_anaart SET  CODBAR = '$data[codbar]', DESC1 = '$data[descrizione]', CATMER = '$data[l1]', TIPPRO = '$data[l2]', TIPART = '$data[l3]', CATINV = '$data[l4]', CODREP = '$data[l5]', PRE1 = '$data[pre1]', PRE2 = '$data[pre2]', PRE3 = '$data[pre3]', PRE4 = '$data[pre4]', PRE5 = '$data[pre5]', VALMAG = 'S', UNIMIS = '$data[unimis]', CODIVA = '22', TIPFAT = 'C', ARTMAS = '$data[codMaster]', CODPRO = 'PRO', CODSCO1 = '$data[codscoCli]', CODSCO2 = '$data[codscoFornit]' WHERE CODART = '$data[codArticolo]' ";
  
  // creo l'articolo
  $conn->query($q);

  // verifico il codice a barre
  $res = $conn->query("SELECT id FROM  01_anaarte WHERE IDANAART = (SELECT ID FROM 01_anaart WHERE CODART = '$data[codArticolo]' );" );
  $row = $res->fetch_array(MYSQLI_ASSOC);

  if( $res->num_rows == 0 ){
    $conn->query("INSERT INTO 01_anaarte(idanaart,ean) VALUES ((SELECT ID FROM 01_anaart where CODART = '$data[codArticolo]' ), '$data[codbar]');");
  } else {
    
    $conn->query("UPDATE 01_anaarte SET EAN = '$data[codbar]' WHERE ID = $row[id];");
  }



}

function creaArticolo($data){
  global $conn;
  $facoData = [
    "CODART" => $data['codArticolo'],
    "CODBAR" => $data['codbar'],
    "DESC1" => $data['descrizione'],
    "CATMER" => $data['l1'],
    "TIPPRO" => $data['l2'],
    "TIPART" => $data['l3'],
    "CATINV" => $data['l4'],
    "CODREP" => $data['l5'],
    "PRE1" => $data['pre1'],
    "PRE2" => $data['pre2'],

    "PRE3" => $data['pre3'],
    "PRE4" => $data['pre4'],
    "PRE5" => $data['pre5'],
    "VALMAG" => "S",
    "UNIMIS" => $data['unimis'],
    "CODIVA" => "22",
    "TIPFAT" => "C",
    "ARTMAS" => $data['codMaster'],
    "CODPRO" => "PRO",
    "CODSCO1" => $data['codscoCli'],

    "CODSCO2" => $data['codscoFornit']
  ];
  $keys = implode( ',', array_keys($facoData));
  $values = substr( str_repeat(' ?,', count( array_keys($facoData) ) ), 0 , -1 );

  $q = "INSERT INTO 01_anaart($keys) VALUES ($values)";

  // creo l'articolo
  $article = query($q,"ssssssssiiiiissssssss", array_values($facoData), false);

  // crea codice a barre
  $q = "INSERT INTO 01_anaarte(idanaart,ean) VALUES (?, ?);";
  query($q,"is",[$conn->insert_id, $facoData['CODBAR'] ], false);


}

function getQta(string $codArt, string $mag){
  global $anno;
  global $conn;

  $sql = "SELECT MOVMAG.CODART,anaart.desc1,anaart.desc2,anaart.unimis,desvar.descr AS DESUNIMIS,SUM(QTA*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as QTA, SUM(NET*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as NET,ANAART.PRE1,MOVMAG.CODDEP FROM 01_movmag$anno as MOVMAG Left join 01_caumag as CAUMAG on CAUMAG.COD=MOVMAG.CODCAU Left join 01_anaart as anaart on anaart.CODART=MOVMAG.CODART Left join 01_desvar as desvar on DESVAR.TIPO='U' and anaart.unimis = desvar.COD WHERE SubStr(CAUMAG.TEST, 4, 1) != '' AND ANAART.valmag is not null and ANAART.VALMAG != 'N' and movmag.CODDEP='$mag' AND movmag.codart='$codArt' GROUP BY CODDEP,CODART ORDER BY CODDEP,CODART";
  
  $res = $conn->query($sql);
  $row = $res->fetch_array(MYSQLI_ASSOC);
  
  return $row['QTA'] ?? 0;

}

  try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $q = "select count(*) as esiste from 01_anaart where codart = ?;";
    $result = query($q,"s", [$data['codArticolo']]);

    if ( $result['esiste'] === 0 ) creaArticolo($data);
    if ( $result['esiste'] === 1 ) { $rim_ret = "RET"; aggiornaArticolo($data); }


    $qta = getQta($data['codArticolo'], $data['maga']);

    if( $data['check'] == false && $data['qta'] != $qta ){
      
      $qtamov =  floatval( $data['qta'] ) - floatval( $qta );

      $net = floatval( $qtamov ) * floatval( $data['pre1'] );

      $sql = "Insert into 01_movmag$anno(CODART,QTA,LOR,NET,DESCMO,DATREG,CODDEP,CODCAU,CASC,UTENTE) 
        VALUES ('$data[codArticolo]', '$qtamov','$net','$net', '$data[descrizione]','$fullanno','$data[maga]','$rim_ret','C','00')";


      $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
    }

  } catch (Exception $e) {
    die( json_encode($e->getMessage()) );
  } finally{
    $conn->commit();
    $conn->close();
  }
