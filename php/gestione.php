<?php
include 'ConnDB.php';

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);//toglie gli \
    $data = htmlspecialchars($data);//converte i caratteri speciali in caratteri html
    $data = strtoupper($data);
    return $data;
}
/*VERIFICO I DATI E LI FILTRO*/
if(!isset($_POST['qta']))//vuol dire che ha selezionato il chech no mov mag
    $_POST['qta'] = 0;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $codArt = test_input($_POST['codmag']);
    $codMaster = test_input($_POST['codmaster']);
    $codBar = test_input($_POST['codbar']);
    $mag = test_input($_POST['magazzino']);
    $desc = test_input($_POST['desc']);
    $qta = (double)test_input($_POST['qta']);
    $prezzo = (double)test_input($_POST['prezzo']);
    $ricarico = (double)test_input($_POST['ricarico']);
    $catmer = test_input($_POST['l1']);
    $tippro = test_input($_POST['l2']);
    $tipart = test_input($_POST['l3']);
    $catinv = test_input($_POST['l4']);
    $codrep = test_input($_POST['l5']);
    $ing = test_input($_POST['ing']);
    $tippre =test_input($_POST['tippre']);
    $prezzoRicaricato = (double)test_input($_POST['prezzoRicaricato']);
    
    $qta_copy = $qta;
    $prezzo_copy = $prezzo;
    $ricarico_copy = $ricarico;
    $prezzoRicaricato_copy = $prezzoRicaricato;
    $scoCli = test_input($_POST['codscoCli']);
    $scoFor = test_input($_POST['codscoFornit']);
    $unimis = test_input($_POST['unimis']);
    $idCodbar = $_POST['idcodbar'];

    /*VARIABILI DI CONTROLLO*/
    $rim_ret = 'RIM';//inizialmente settata su rimanenza iniziale
    $data = `01-01-2019`;
/*COPIE DELLE VARIABILI DI TIPO DOUBLE IN QUANTO IL METODO preg_match TRASFORMA I NUMERI IN STRINGA*/
    if(!preg_match("/[A-Za-z0-9]+/",$codArt))
        die("Per il codice articolo è consentito solo lettere e numeri!");
    if(!empty($codMaster) && !preg_match("/[A-Za-z0-9]+/",$codMaster))
        die("Per il master è consentito solo lettere e numeri!");
    if(!empty($codBar) && !preg_match("/[A-Za-z0-9]+/",$codBar))
        die("Per il codice a barre è consentito solo lettere e numeri!");
    if(!empty($desc) && !preg_match("/[A-Za-z0-9]+/",$desc))
        die("Per le descrizione a barre è consentito solo lettere e numeri!");
    if(!empty($qta_copy) && !preg_match('/[0-9]+\.([0-9]+)/', '£3.25',$qta_copy))
        die("Per il campo quantità è consitito solo l'uso di numeri!");
    if(!empty($prezzo_copy) && !preg_match('/[0-9]+\.([0-9]+)/', '£3.25',$prezzo_copy))
        die("Per il campo prezzo è consitito solo l'uso di numeri!");
    if(!empty($ricarico_copy) && !preg_match('/[0-9]+\.([0-9]+)/', '£3.25',$ricarico_copy))
        die("Per il campo ricarico è consitito solo l'uso di numeri!");
    if(!empty($prezzoRicaricato_copy) && !preg_match('/[0-9]+\.([0-9]+)/', '£3.25',$prezzoRicaricato_copy))
        die("Per il campo prezzo ricaricato è consitito solo l'uso di numeri!");

}
else
    die("Pagina Non eseguibile eseguibile!");



$conn->autocommit(FALSE);
$result = $conn->query("select * from 01_anaart where codart = \"".$codArt."\"") or die("ERRORE : ".$conn->error);
    if($result->num_rows == 0) //se il prodotto non è stato ancora codificato
    {
        $sql = "INSERT INTO 01_anaart(CODART,CODBAR,DESC1,CATMER,TIPPRO,TIPART,CATINV,CODREP,PRE1,VALMAG,UNIMIS,CODIVA,TIPFAT,ARTMAS,PRE5,INGR,TIPPRE,CODPRO,CODSCO1,CODSCO2) VALUES (\"".(string)$codArt."\",\"".(string)$codBar."\",\"".(string)$desc."\",\"".(string)$catmer."\",\"".(string)$tippro."\",\"".(string)$tipart."\",\"".(string)$catinv."\",\"".(string)$codrep."\",".$prezzoRicaricato.", \"S\" ,\"".$unimis."\",\"22\",\"C\", \"".(string)$codMaster."\",".$prezzo.",\"".$ing."\",\"".$tippre."\",'PRO','".$scoCli."','".$scoFor."');";
        $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
        $sql = "INSERT INTO 01_anaarte(idanaart,ean) VALUES ($conn->insert_id, \"".(string)$codBar."\");";
        $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
    }
    else
    {
        /*Se il prodotto esiste setto la variabile rim_ret in retifica*/
        $rim_ret = "RET";
        $data = date("Y-m-d");
    /*controllo se ha IL CODICE A BARRE CHE STAVO MODIFICANDO cod a barre*/
        $sql = "SELECT ID FROM  01_anaarte WHERE IDANAART = (SELECT ID FROM 01_anaart WHERE CODART =\"".(string)$codArt."\") AND ID ='".$idCodbar."' ;";        
        $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
        $row = $result->fetch_assoc();

        if($result->num_rows == 0)//se non aveva il codice a barre
        {
            $sql = "INSERT INTO 01_anaarte(idanaart,ean) VALUES ((SELECT ID FROM 01_anaart where CODART =\"".(string)$codArt."\"), \"".(string)$codBar."\");";
            $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
        }
        else {
            $sql = "UPDATE 01_anaarte SET EAN = \"".(string)$codBar."\" WHERE ID =".$idCodbar." ;";        
            $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
        }
       
        
        $sql = "UPDATE 01_anaart SET 
                CODBAR = \"".(string)$codBar."\",
                DESC1  = \"".(string)$desc."\",
                CATMER = \"".(string)$catmer."\",
                TIPPRO = \"".(string)$tippro."\",
                TIPART = \"".(string)$tipart."\",
                CATINV = \"".(string)$catinv."\",
                CODREP = \"".(string)$codrep."\",
                INGR   = \"".(string)$ing."\",
                TIPPRE =\"".(string)$tippre."\",
                PRE1   = ".$prezzoRicaricato.",
                ARTMAS = \"".(string)$codMaster."\", 
                PRE5   = ".$prezzo. ",
                CODSCO1 = '".$scoCli."',
                CODSCO2 = '".$scoFor."',
                UNIMIS = '".$unimis. "'
                WHERE CODART = \"".(string)$codArt."\";";
        $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);

    }
    $sql = "SELECT PROGR FROM 01_conart19 where codart ='$codArt' AND CODDEP ='$mag' ";
    $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ". $sql);//controllo se la quantità inserita è uguale a quella nel db
    $row = $result->fetch_assoc();
    $qtaProdotto = (double)$row['PROGR'];
    if(!(isset($_POST['check'])) && !($qtaProdotto == $qta) )//true quando non si vuole memorizzare mov mag false quando si vuole farlo
        {
            /*Prendo il progressivo di quel prodotto*/
            $q = "SELECT SUBSTRING(PROGR,1,12) AS PROGR from 01_conart19 where CODDEP='$mag' and CODART=\"".(string)$codArt."\";";
            $result = $conn->query($q) or die("ERRORE : ".$conn->error." ".$q);
            $row = $result->fetch_assoc();
            $progressivo = ( ($result->num_rows == 0) ? $progressivo = 0 : $progressivo = (double)$row['PROGR']);//se non esiste metto 0 se no metto il progressivo del prodotto
            if($result->num_rows == 0)//se non è presente la quantità NEL MAGAZZINO SELEZIONATO
            {
                /*inserisco la quantita del prodotto*/
                $progConSpazi = str_pad( (string) $qta , 12,' ',STR_PAD_LEFT);
                $valor = str_pad( (string) $prezzo , 24,' ',STR_PAD_LEFT);
                $sql = "INSERT INTO 01_conart19(CODDEP,CODART,PROGR,VALOR) VALUES ('$mag', \"".(string)$codArt."\", '".$progConSpazi."', '".$valor."')";
                $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
            }
            else //se presente faccio un update
            { 
                $p = str_pad( (string) $qta , 12,' ',STR_PAD_LEFT);    
                $v = str_pad( (string) $prezzo , 12,' ',STR_PAD_LEFT);    
                
                $sql = "SELECT PROGR,VALOR FROM 01_conart19 WHERE CODDEP='$mag' AND CODART='".(string)$codArt."'";
                $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
                $row = $result->fetch_assoc();
                $PROGR = $row['PROGR'];
                $PROGR = $p.substr($row['PROGR'],12);//i primi 12 progr e il resto lo copio dal db
                $VALOR = $row['VALOR'];
                $VALOR = substr($row['VALOR'],0,12).$v.substr($row['VALOR'],24);

                $sql = "UPDATE 01_conart19 SET PROGR='".$PROGR."',VALOR='".$VALOR."'  WHERE CODDEP='$mag' AND CODART='".(string)$codArt."'";
                $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);
            }
            
            $qtamov =(double)((double)$qta - $progressivo);
            $net = $qtamov * (double)$prezzo;
            /*MOV MAG*/
            $sql = "UPDATE 01_anaatt19 SET numarm = numarm + 1 where COD = '26120'";
            $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);//incremento il numarm

            $result = $conn->query("SELECT last_insert_id(numarm) as numarm from 01_anaatt19 where COD = '26120'") or die("ERRORE : ".$conn->error);//prelevo numarm
            $row = $result->fetch_assoc();
            $artmag = (string)$row['numarm'];
            echo "art mag => $artmag ";
            
            $sql = "Insert into 01_movmag19(CODART,QTA,LOR,NET,DESCMO,ARTMAG,DATREG,CODDEP,CODCAU,CASC,UTENTE) VALUES (\"".(string)$codArt."\", ".$qtamov.",".$net.",".$net.", \"".(string)$desc."\",".$artmag.",'".$data."','$mag',\"".$rim_ret."\",\"C\",\"00\")";
            $result = $conn->query($sql) or die("ERRORE : ".$conn->error." ".$sql);

        }
        if (!$conn->commit()) {
            print("Transaction commit failed\n");
            exit();
        }
$conn->close();
?>
