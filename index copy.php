<?php 
include "./php/gestioneSessione.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <title>Inserimento</title>
  <meta name="description" content="Gestisci i tuoi articoli da una semplice videata">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--****************Icon******************-->
  <link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
  <!--<link rel="manifest" href="img/icon/site.webmanifest">-->

  <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/style.css">

  <meta name="theme-color" content="#fafafa">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery-ui-git.css">
  <link rel="stylesheet" href="css/xdialog-master/xdialog.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">


  <style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: textfield;
      margin: 0;

    }
  </style>

</head>

<body >

<noscript>
<h1 class="alert alert-danger" role="alert">
  Per avere a disposizione tutte le funzionalità di questo sito è necessario abilitare
  Javascript. Qui ci sono tutte le <a href="https://www.enable-javascript.com/it/">
  istruzioni su come abilitare JavaScript nel tuo browser</a>.
</h1>
</noscript>
  
  <!-- Modal -->
  <div class="modal fade" id="ModalConferma" tabindex="-1" role="dialog" aria-labelledby="ModalConferma"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-right" id="modalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose">Close</button>
          <button type="button" class="btn btn-primary" id="modalConferma">Continua</button>
        </div>
      </div>
    </div>
  </div>
  <!--[if IE]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->



  <section class="container">

      <div class="row justify-content-md-center mb-4" style="justify-content:center">
        <div class="alert alert-success" role="alert" id="alertCentrale">
          Inserisci il codice prodotto
        </div>
      </div>


      <div class="row">
        <div class="col-md mb-4">
          <form class="needs-validation" novalidate method="POST" id="formAggiungiArticolo" autocomplete="off">

            <div class="form-row" id="divCodart">
              <div class="col-6 col-md mb-3">
                <label for="Cod_Articolo">Cod. Articolo</label>
                <input type="text" class="form-control autocomplete" name="codmag" id="CODART" placeholder="Codice Articolo" maxlength="20" required style="text-transform:uppercase" >
              </div>

              <div class="col-6 col-md mb-3 ">
                <label for="Cod_Master">Cod. Master</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span data-tooltip title="Cod. Art ==> Cod. Master" class="input-group-text btn-info"
                      style="cursor:pointer" id="copiaCodArt_su_Cod_master"><i class="fas fa-arrow-right"></i></span>
                  </div>
                  <input type="text" class="form-control " name="codmaster" id="codmaster" placeholder="Codice master"
                    style="text-transform:uppercase" maxlength="16">
                </div>
              </div>

              <div class="col-12 col-md mb-3">
                <label for="Cod_a_barre">Cod. a barre</label>
                <input type="number" style="display:none" name="idcodbar" id="idcodbar">
                <input type="text" class="form-control text-uppercase" name="codbar" id="codbar"
                  placeholder="Codice a barre" maxlength="13"/>
              </div>
            </div>

            <div class="form-row">

              <div class="col-8 col-md-8 col-lg-10 mb-3 input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text text-center" id="inputGroupPrepend2" style="width:110px">Descrizione</span>
              </div>
                <input type="text" class="form-control text-uppercase" name="desc" id="desc" placeholder="Descrizione"
                  maxlength="50" required>
              </div>

              <div class="col-4 col-md-4 col-lg-2 mb-3 input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text text-center" id="inputGroupPrepend2" >Mag.</span>
                </div>
                <select class="custom-select" name="magazzino" id="Magazzino" required>
                  <option value="">Nessun magazzino selezionato</option>
                  <?php  include './php/sectionMag.php'?>
                </select>
              </div>
            </div>
            
            <div class="form-row"><!--codici sconto e magazzino e unità di misura-->
              <div class="col-6 col-md-5 col-lg-5 mb-3" >
                <label for="Cod_Master">Sconto Cliente</label>
                <select class="custom-select" name="codscoCli" id="codscoCli" >
                  <option value="">Nessun codice sconto cliente</option>
                </select>
              </div>

              <div class="col-6 col-md-5 col-lg-5 mb-3" >
                <label for="Cod_Master">Sconto fornitore</label>
                <select class="custom-select" name="codscoFornit" id="codscoFornit" >
                  <option value="">Nessun codice sconto fornitore</option>
                </select>
              </div>

              <div class="col-12 col-md-2 col-lg-2 mb-3" >
              <label for="Cod_Master">Unit. Misura</label>
                <select class="custom-select" name="unimis" id="unimis" required>
                  <option value="">Nessuna unità di misura</option>
                </select>
              </div>

            </div>

            <div class="form-row"><!--categorie-->
            <div class="col-4 col-md col-lg mb-3 input-group">
            <div class="input-group-prepend">
                  <span class="input-group-text text-center"  >L1</span>
                </div>
                <select class="custom-select" name="l1" id="l1" id1="categoria" >
                <option value="">Nessuna Categoria</option>
                </select>
              </div>

            <div class="col-4 col-md col-lg mb-3 input-group">
            <div class="input-group-prepend">
                  <span class="input-group-text text-center"  >L2</span>
                </div>
                <select class="custom-select "  name="l2" id="l2" id1="categoria">
                <option value="">Nessuna Categoria</option>
                </select>
              </div>

              <div class="col-4 col-md col-lg mb-3 input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text text-center" >L3</span>
                </div>
                <select class="custom-select "  name="l3" id="l3" id1="categoria">
                <option value="">Nessuna Categoria</option>
                </select>
              </div>

              <div class="col-6 col-md col-lg mb-3 input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text text-center" >L4</span>
                </div>
                <select class="custom-select "  name="l4" id="l4" id1="categoria">
                <option value="">Nessuna Categoria</option>
                </select>
              </div>

              <div class="col-6 col-md col-lg mb-3 input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text text-center" >L5</span>
                </div>
                <select class="custom-select "  name="l5" id="l5" id1="categoria">
                <option value="">Nessuna Categoria</option>
                </select>
              </div>
            
            </div>

            <div class="form-row"><!--axtra-->

              <div class="col-6 col-md-6 col-lg-6 mb-3">
                <label for="Cod_Master">Descrizione lunga</label>
                <textarea class="form-control text-uppercase" name="tippre" id="tippre" rows="3"></textarea>
              </div>

              <div class="col-6 col-md-6 col-lg-6 mb-3">
                <label for="Cod_Master">Stringa di ricerca</label>
                <textarea class="form-control text-uppercase" name="ing" id="ing" rows="3"></textarea>
              </div>

            </div>

            <div class="form-row">

              <div class="col-6 col-sm-6 col-md mb-3 input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text text-center"  style="width:110px">Quantità</span>
                </div>
                <input type="number" name="qta" class="form-control" id="qta" placeholder="Quantità" step=0.01 min=0 required >
              </div>
              
              <div class="col-6 col-sm-6 col-md mb-3 input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" ><i class="fa fa-euro-sign"
                      aria-hidden="true"></i></span>
                </div>
                <input type="number" class="form-control" name="prezzo" id="prezzo" placeholder="Prezzo" step=0.01
                  min=0.01 required>
              </div>

              <div class="col-6 col-sm-6 col-md mb-3 input-group">
                <input type="number" class="form-control" name="ricarico" id="ricarico" placeholder="ricarico" step=0.01 min=0 value="0">
                <div class="input-group-append">
                  <span class="input-group-text" ><i class="fas fa-percentage"></i></span>
                </div>
              </div>

              <div class="col-6 col-sm-6 col-md mb-3 input-group">

              <div class="input-group-prepend">
                  <span data-tooltip title="P+R%" class="input-group-text btn-info" id="buttonEqual" style="cursor:pointer"><i class="fas fa-equals"></i></span>
                </div>
                <input type="number" class="form-control" name="prezzoRicaricato" id="prezzoRicaricato" placeholder="prezzo Ricaricato" step=0.01 min=0 required>
              </div>

            </div>
        
      <div class="row">

          <div class="col-md-2 mb-3 input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" id="check" name="check">
                <span><div class="ml-2">No Mov. mag</div></span>
              </div>
            </div>
          </div>

          <div class="col-md-10 input group">
              <button class="btn btn-dark float-right ml-3" type="submit" id="invio">Invio</button>
              <button class="btn btn-danger float-right" type="reset" id="invio">Reset</button>
            
            <div class="col-md-auto text-success float-right">
              <div class="btn alert-success " role="alert" id="alert" style="display:none; max-width:40vw"></div>
            
            </div>
          </div>
      </div>

        </form>
      </div>
    </div>
  </section>

  <!--<section id="cambioCodArt">
    <div class="separatore mb-3">
      <h1 class="titolo">Cambia Codice articolo</h1>
    </div>
    
    <form method="post" class="container">
      <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text text-center" id="inputPreappendCambiaCodart" >Da</span>
          </div>
          <input class="form-control autocomplete" type="text" name="codArt" id="cambio_codart" placeholder ="Codart">
          <div class="input-group-prepend">
            <span class="input-group-text text-center" id="inputPreappendCambiaCodart" >A</span>
          </div>
          <input class="form-control autocomplete" type="text" name="codArtCambio" id="cambio_codart_cambio" placeholder ="Codart">
        <button type="submit" class="btn btn-outline-secondary">Cambia</button>
      </div>
    </form>

  </section>-->




  <script src="js/libext/jquery-3.4.0.min.js"></script>
  <script src="js/libext/ui-1.12.1-jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="css/xdialog-master/xdialog.js"></script>
  <script src="js/utility.js"></script>
  <script src="js/index/autocompleta_campi.js"></script>
  <script src="js/index/main.js"></script>
  <script>
    $(document).ready(function () {

      $('[data-tooltip]').tooltip();


      document.getElementById("ing").onkeydown = function(e){
        switch (e.keyCode) {
            case 38://up
            document.getElementById("ing").rows =  this.rows -1; 
            break;
            case 40://down
            document.getElementById("ing").rows =  this.rows +1;
            break;
        }
      };
      document.getElementById("tippre").onkeydown = function(e){
        switch (e.keyCode) {
            case 38://up
            document.getElementById("tippre").rows =  this.rows -1; 
            break;
            case 40://down
            document.getElementById("tippre").rows =  this.rows +1;
            break;
        }
      };

      
});

  </script>
</body>

</html>