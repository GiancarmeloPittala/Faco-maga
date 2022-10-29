window.onload = () =>{
  generaOption('l1','l2','l3','l4','l5','codscoCli','codscoFornit','unimis');// la select con gli options presi dat database
  gestioneRicercaProdotto();//aggiunge i listener e compila il form con i dati del prodotto inserito

}

const gestioneRicercaProdotto = () =>{
  ricerca_per_cod_articolo();
  ricerca_per_cod_barre();
};


const ricerca_per_cod_barre = () => {
  document.getElementById("codbar").addEventListener("change", ele  => {
if (document.getElementById("CODART").value.trim() == "")
{
  let codartV = ele.target.value;
  let magazzino =document.getElementById("Magazzino").value || 0; 
  let NMagazzino = document.getElementById("Magazzino")[document.getElementById('Magazzino').selectedIndex].innerHTML;


  /*Prendo se esistono l'anagrafica del codice articolo inserito*/
  let sql = "SELECT A.CODART,AE.EAN,AE.id AS idCodbar,DESC1,CATMER,TIPPRO,TIPART,CATINV,CODREP,PRE1";
        sql+= ",ARTMAS,A.TIPPRE,A.INGR,A.CODSCO1,A.CODSCO2,A.UNIMIS ";
        sql+= "FROM 01_anaart AS A LEFT JOIN 01_anaarte AS AE ON A.ID = AE.idanaart WHERE A.CODART = '"+codartV+"'";
       
  query(sql).done( data => {
    if(data.length == 0)//se non ritorna nulla non esiste l'anagrafica dell'articolo quindi è un nuovo prodotto
      prodottoInesistente(codartV);
    else
    prodottoEsistente( JSON.parse(data) );
  }).fail(data => console.log("error",data) );


  let clearForm = () => document.querySelectorAll("input, textarea, select").forEach(ele => (ele.id !="CODART" && ele.id !="Magazzino") ? ele.value = "" : null ); //azzero tutti i campi
  
  let prodottoInesistente = (articolo) =>{
    clearForm();
    $('#alertCentrale').removeClass('alert-success');
    $('#alertCentrale').addClass('alert-dark');
    $('#alertCentrale').text("Stai codificando un nuovo articolo cod: ").append("<strong>"+articolo.toUpperCase()+"</strong>");
    $('#qta').attr('placeholder',"Quantità");
    document.querySelectorAll("select[id='Magazzino'] option").forEach((ele) => {ele.style.color = "black"; ele.style.fontWeight = "normal";});//resetto i colori sella select magazzino

  }

  let prodottoEsistente = (dati) =>{
    let anno = String(new Date().getFullYear()).substring(2,4);
    /*prendo se esistono La quantità , il magazzino e l'ultimo prezzo d'acquisto*/
    let sql = `SELECT (select (NET/QTA) from 01_movmag${anno} as M LEFT join 01_caumag AS c ON C.COD = M.CODCAU where codart ='"+codartV+"' and M.coddep ='"+magazzino+"' and SUBSTRING(C.test,1,1) = '1' order by artmag DESC limit 1 )AS VALOR `;
        sql+= `,CODDEP,SUBSTRING(PROGR,1,12)AS PROGR FROM 01_conar${anno} where CODART ='"+codartV+"' `;
    query(sql).done(valori => {
      if(valori.length == 0)//prodotto che è stato registrato nell'anagrafica ma mai movimentato
      {
        aggiornaCampiForm(dati[0]);
        $('#alertCentrale').removeClass('alert-dark');
        $('#alertCentrale').removeClass('alert-danger');
        $('#alertCentrale').addClass('alert-success');
        $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"</strong>"+" è stato codificato correttamente ma non presenta quantità in nessun magazzino");
      }
      else//prodotto presente in uno o più magizzini
      {
        valori = JSON.parse(valori);
        let datiProdotto = valori.filter(dato => dato.CODDEP == magazzino );//conterrà solo i dati prodotto (valor,progr e coddep) per il deposito selezionato
     
        if(datiProdotto.length !== 0 )//se il prodotto esiste ne magazzino selezionato dall'utente
        {
          $('#alertCentrale').removeClass('alert-dark');
          $('#alertCentrale').removeClass('alert-danger');
          $('#alertCentrale').addClass('alert-success');
          $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"</strong>"+" è presente con quantità: <strong>"+parseFloat(datiProdotto[0].PROGR)+"</strong> nel magazzino <strong>"+NMagazzino+"</strong>");
        }
        else//nel magazzino selezionato non è presente il prodotto
        {
          $('#alertCentrale').removeClass('alert-dark');
          $('#alertCentrale').removeClass('alert-danger');
          $('#alertCentrale').addClass('alert-success');
          $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"<span style='color:red'> NON</span></strong>"+" esiste nel magazzino <strong><span>"+NMagazzino+"</span></strong>");
     
        }
        let TCampi = Object.assign(dati[0],datiProdotto[0]);//creo un unico oggetto che contiene tutti i dati aggiornati del prodotto
        aggiornaCampiForm(TCampi);
       
        
      }
    })
  }
}//fine if
    

  });
  
};

const ricerca_per_cod_articolo = () => {
  document.getElementById("CODART").addEventListener("blur",(ele) => {

    let codartV = ele.target.value;
    let magazzino =document.getElementById("Magazzino").value || 0; 
    let NMagazzino = document.getElementById("Magazzino")[document.getElementById('Magazzino').selectedIndex].innerHTML;
 

    /*Prendo se esistono l'anagrafica del codice articolo inserito*/
    let sql = "SELECT A.CODART,AE.EAN,AE.id AS idCodbar,DESC1,CATMER,TIPPRO,TIPART,CATINV,CODREP,PRE1";
          sql+= ",ARTMAS,A.TIPPRE,A.INGR,A.CODSCO1,A.CODSCO2,A.UNIMIS ";
          sql+= "FROM 01_anaart AS A LEFT JOIN 01_anaarte AS AE ON A.ID = AE.idanaart WHERE A.CODART = '"+codartV+"'";
         
    query(sql).done( data => {
      if(data.length == 0)//se non ritorna nulla non esiste l'anagrafica dell'articolo quindi è un nuovo prodotto
        prodottoInesistente(codartV);
      else
      prodottoEsistente( JSON.parse(data) );
    }).fail(data => console.log("error",data) );


    let clearForm = () => document.querySelectorAll("input, textarea, select").forEach(ele => (ele.id !="CODART" && ele.id !="Magazzino") ? ele.value = "" : null ); //azzero tutti i campi
    
    let prodottoInesistente = (articolo) =>{
      clearForm();
      $('#alertCentrale').removeClass('alert-success');
      $('#alertCentrale').addClass('alert-dark');
      $('#alertCentrale').text("Stai codificando un nuovo articolo cod: ").append("<strong>"+articolo.toUpperCase()+"</strong>");
      $('#qta').attr('placeholder',"Quantità");
      document.querySelectorAll("select[id='Magazzino'] option").forEach((ele) => {ele.style.color = "black"; ele.style.fontWeight = "normal";});//resetto i colori sella select magazzino

    }

    let prodottoEsistente = async (dati) =>{
      /*prendo se esistono La quantità , il magazzino e l'ultimo prezzo d'acquisto*/

      let anno = String(new Date().getFullYear()).substring(2,4)

      let sql = `select (NET/QTA) AS VALOR from 01_movmag${anno} as M LEFT join 01_caumag AS c ON C.COD = M.CODCAU where 
      codart ='${codartV}' and M.coddep ='${magazzino}' and SUBSTRING(C.test,1,1) = '1' order by artmag DESC limit 1  `;
      
      const results = await query(`SELECT MOVMAG.CODART,anaart.desc1,anaart.desc2,anaart.unimis,desvar.descr AS DESUNIMIS,SUM(QTA*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as PROGR, SUM(NET*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as NET,ANAART.PRE1,MOVMAG.CODDEP FROM 01_movmag${anno} as MOVMAG Left join 01_caumag as CAUMAG on CAUMAG.COD=MOVMAG.CODCAU Left join 01_anaart as anaart on anaart.CODART=MOVMAG.CODART Left join 01_desvar as desvar on DESVAR.TIPO='U' and anaart.unimis = desvar.COD WHERE SubStr(CAUMAG.TEST, 4, 1) != '' AND ANAART.valmag is not null and ANAART.VALMAG != 'N' and movmag.CODDEP='${magazzino}' AND movmag.codart='${codartV}' GROUP BY CODDEP,CODART ORDER BY CODDEP,CODART`);

      console.log( results )
      const { CODDEP, PROGR } = results ?? {};


      query(sql).done(valori => {
        if(valori.length == 0)//prodotto che è stato registrato nell'anagrafica ma mai movimentato
        {
          console.log( { ... dati[0], PROGR, CODDEP } )
          aggiornaCampiForm({ ... dati[0], PROGR, CODDEP });
          $('#alertCentrale').removeClass('alert-dark');
          $('#alertCentrale').removeClass('alert-danger');
          $('#alertCentrale').addClass('alert-success');
          $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"</strong>"+" è stato codificato correttamente ma non presenta quantità in nessun magazzino");
        }
        else//prodotto presente in uno o più magizzini
        {
          valori = JSON.parse(valori);
          let datiProdotto = valori.filter(dato => dato.CODDEP == magazzino );//conterrà solo i dati prodotto (valor,progr e coddep) per il deposito selezionato
       
          if(datiProdotto.length !== 0 )//se il prodotto esiste ne magazzino selezionato dall'utente
          {
            $('#alertCentrale').removeClass('alert-dark');
            $('#alertCentrale').removeClass('alert-danger');
            $('#alertCentrale').addClass('alert-success');
            $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"</strong>"+" è presente con quantità: <strong>"+parseFloat(datiProdotto[0].PROGR)+"</strong> nel magazzino <strong>"+NMagazzino+"</strong>");
          }
          else//nel magazzino selezionato non è presente il prodotto
          {
            $('#alertCentrale').removeClass('alert-dark');
            $('#alertCentrale').removeClass('alert-danger');
            $('#alertCentrale').addClass('alert-success');
            $('#alertCentrale').text("Articolo ").append("<strong>"+codartV.toUpperCase()+"<span style='color:red'> NON</span></strong>"+" esiste nel magazzino <strong><span>"+NMagazzino+"</span></strong>");
       
          }
          let TCampi = Object.assign(dati[0],datiProdotto[0]);//creo un unico oggetto che contiene tutti i dati aggiornati del prodotto
          aggiornaCampiForm(TCampi);
         
          
        }
      })
    }

  });
};


$(function(){
  $('#buttonEqual').on("click",function(){
    if( $("#prezzo").val() !=0 && $("#ricarico").val() !=0 )
    {
      let pre1 = (parseFloat($("#prezzo").val()) + parseFloat($("#prezzo").val()) * parseFloat($("#ricarico").val())/100);
      $("#prezzoRicaricato").val(pre1.toFixed(2)) ;
    }
    else
    $("#prezzoRicaricato").val("0.00") ;
  });
});

$(function(){
  $("#check").on("click",function(){
      if(document.getElementById("check").checked)
      document.getElementById("qta").disabled = true;
      else
      document.getElementById("qta").disabled = false;
  });
});

/*al clickdel bottone close del modal rendo il bottone continua nuovamente cliccabile, che diventa disabilitato ne caso in cui
il codice a barre e già presente nel db*/
$(function(){
 $("#modalClose").on("click",function(){
  $("#modalConferma").attr("disabled", false);
 });
});


$(function(){//inserisco il prodotto al click del conferma del modal
  $('#modalConferma').click(function(){
      inserisciProdotto();
    $('#ModalConferma').modal('hide');//apro il modal di conferma
  })
});

/*Pulsante presente nel input cod.master che permette
di copiare il valore dell'input cod.art sul campo
input cod master*/
$(function() {
  $("#copiaCodArt_su_Cod_master").click(function(){
    $("#codmaster").val($("#CODART").val());
  });
});

/*funzione che permette di controllare se i campi 
del form sono stati riempiti correttamente 
se riempiti correttamente procede all'inserimento */
(function() {
    'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    const validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', async function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add('was-validated');  
        }
        else 
        {
          event.preventDefault();
          /*controllo se il codice a barre è già presente nel database*/
          let contCodBar =-1;
         if($("#codbar").val().trim() !="")//se il campo per il codice a barre contiene qualcosa
         {
              let query ="SELECT count(ean) as VAL FROM 01_anaarte WHERE ean =\""+$("#codbar").val()+"\" and idanaart not in (select id FROM 01_anaart where CODART = \""+$("#CODART").val()+"\") ";
              console.log(query);
              await $.ajax({
                url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query : query
                }              
            })
            .done( function( data ) {
              contCodBar = parseInt(data);
              console.log("conbar =",contCodBar);
            })
            .fail( function( data , RESPONSE) {
            console.log("Error " +query+" "+data +"  "+ RESPONSE);
            })
         }
          if($('#codmaster').val() == "" || $("#codbar").val() == "" || $("#codbar").val().length <13 || $('#qta').val() == -1 || contCodBar > 0 || document.getElementById("check").checked)//se uno di questi campi è vuoto o qta-1
            {
              $('#ModalConferma').modal('toggle');//apro il modal di conferma
              $('#modalTitle').text("").append("<strong class='text-danger'>ATTENZIONE</strong>");
              $('#modalBody').text("").append("<ul><strong>Controllare i seguenti punti</strong>");             
              
              if(document.getElementById("check").checked)//se non si vuole generare il movimento di magazzino
                $('#modalBody').append("<li><strong style=\"font-size:19px; color:#dc3545\">Non</strong> sarà generato il movimento di magazzino! </li>");
              
              if($("#codbar").val() == "")//se non ionserito il cod a barre
                $('#modalBody').append("<li>Il codice a barre <strong style=\"font-size:19px; color:#dc3545\">Non</strong> è stato inserito!</li>");
                     
              else if($("#codbar").val().length <13)//se il cod a barre non è nel formato EAN 13
                $('#modalBody').append("<li>Il codice a barre <strong style=\"font-size:19px; color:#dc3545\">Non</strong> è nel formato EAN 13!</li>");
              if(contCodBar > 0)//se il cod a master non è stato già usato
              {
                $('#modalBody').append("<li style=\"color:#dc3545 \">Codice a barre <strong>"+$("#codbar").val().toUpperCase()+"<strong> e' già stato usato!</li>");
                $("#modalConferma").attr("disabled", true);
              }

              if($("#codmaster").val() == "")//se il cod a master non è stato inserito
                $('#modalBody').append("<li>Il codice master <strong style=\"font-size:19px; color:#dc3545\">Non</strong> e stato inserito!</li>");
              
              
              
              $('#modalBody').append("</ul><br>Clicca su continua per confermare ");
            }
         else 
          inserisciProdotto();
        }         
    }, false);
    });
  }, false);
})();

function inserisciProdotto()
{
  const forms = document.getElementsByClassName('needs-validation');
  const validation = Array.prototype.filter.call(forms, function(form) {
    form.classList.remove('was-validated');
    $.ajax({
      type: "POST",
      url: "php/gestione.php",
      data: $("#formAggiungiArticolo").serialize(),
      statusCode: {
        404: function() {
          alert( "page not found" );
        }
      }
    })
    .done(function( msg,status ) {
     // $("input[type='number'],input[id='codbar']").val("");
      if(msg.length == 0)//se non è presente un messaggio di errore
      {
        var snd = new Audio('sound/confirm.wav').play();
        $('#alert').removeClass("alert-danger");
        $('#alert').addClass("alert-success");
        $('#alert').fadeIn("slow");
        $('#alert').text("").append("Articolo <strong>"+ $('input:text[name="codmag"]').val().toUpperCase().substr(0, 3)+"</strong>"+  $('input:text[name="codmag"]').val().toUpperCase().substr(3)+" inserito correttamente");
        setTimeout(function(){  $('#alert').fadeOut("slow"); }, 5000);

        $('#alertCentrale').removeClass('alert-dark');
        $('#alertCentrale').removeClass('alert-danger');
        $('#alertCentrale').addClass('alert-success');
        $('#alertCentrale').text("").append("Articolo <strong>"+ $('input:text[name="codmag"]').val().toUpperCase().substr(0, 3)+"</strong>"+  $('input:text[name="codmag"]').val().toUpperCase().substr(3)+" inserito correttamente");
      }
      else//se è presente il messaggio di errore
      {
      var snd = new Audio('sound/error.flac').play();     
        $('#alert').removeClass("alert-success");
        $('#alert').addClass("alert-danger");
        $('#alert').fadeIn("slow");
        $('#alert').text(msg);

        $('#alertCentrale').removeClass("alert-dark");
        $('#alertCentrale').addClass("alert-danger");
        $('#alertCentrale').fadeIn("slow");
        $('#alertCentrale').text(msg);
      }
      
    })
    .fail(function( msg ) {
      alert("Si è verificato un errore! "+ msg);
    })
  });
}

function aggiornaCampiForm(rigoDB)
{
   $('#CODART').val(rigoDB['CODART'] || "");
   $('#codmaster').val(rigoDB['ARTMAS'] || "");
   $('#codbar').val(rigoDB['EAN'] || "");
   $('#tippre').val(rigoDB['TIPPRE'] || "");
   $('#ing').val(rigoDB['INGR'] || "");
   $('#desc').val(rigoDB['DESC1'] || "");
   $('#qta').val(parseFloat(rigoDB['PROGR']) || 0);
   $('#prezzo').val(parseFloat(rigoDB['VALOR']) || 0);
   $('#ricarico').val(0);
   $('#prezzoRicaricato').val(parseFloat(rigoDB['PRE1']) || 0);
   $('#idcodbar').val(rigoDB['idCodbar'] || "" );

    /*seleziono il MAGAZZINO del prodotto e setto tutti gli option con colore nero e testo normale*/
    let selectMag = document.querySelectorAll("select[id='Magazzino'] option");
    selectMag.forEach((op) => {
     op.style.color = "black";
     op.style.fontWeight="normal"
    if(op.value == rigoDB['CODDEP']) op.selected = true;//il magazzino passato lo metto selected
    });
    let anno = String(new Date().getFullYear()).substring(2,4)
    /*Prendo tutti i magazzini in cui è presente questo prodotto*/
    query(`SELECT CODDEP from 01_conart${anno} where codart ='${rigoDB['CODART']}' `).done(function (data){
      if(data.length > 0) {
        data = JSON.parse(data);
          data.forEach(function(value){//per ogni valore preso da database
           selectMag.forEach((op) =>{//lo confronto con quelli presenti nella select
             if(op.value == value['CODDEP'])
             {
               op.style.color = "red";
               op.style.fontWeight = "bold";
             }
           })
         });
      }
    
    }); 


   let lengthCategoriel1 = document.getElementById("l1").options.length;//seleziono la categoria l1 del prodotto
   document.getElementById("l1").options[0].selected = true;
   for(let i = 0; i<lengthCategoriel1; i++)
      if(document.getElementById("l1").options[i].value == rigoDB['CATMER'])
         document.getElementById("l1").options[i].selected = true;
 
   let lengthCategoriel2 = document.getElementById("l2").options.length;//seleziono la categoria l2 del prodotto
   document.getElementById("l2").options[0].selected = true;
    for(let i = 0; i<lengthCategoriel2; i++)
     if(document.getElementById("l2").options[i].value == rigoDB['TIPPRO'])
       document.getElementById("l2").options[i].selected = true;
 
   let lengthCategoriel3 = document.getElementById("l3").options.length;//seleziono la categoria l3 del prodotto
   document.getElementById("l3").options[0].selected = true;
   for(let i = 0; i<lengthCategoriel3; i++)
     if(document.getElementById("l3").options[i].value == rigoDB['TIPART'])
       document.getElementById("l3").options[i].selected = true;
 
   let lengthCategoriel4 = document.getElementById("l4").options.length;//seleziono la categoria l4 del prodotto
   document.getElementById("l4").options[0].selected = true;
   for(let i = 0; i<lengthCategoriel4; i++)
     if(document.getElementById("l4").options[i].value == rigoDB['CATINV'])
       document.getElementById("l4").options[i].selected = true;
 
   let lengthCategoriel5 = document.getElementById("l5").options.length;//seleziono la categoria l5 del prodotto
   document.getElementById("l5").options[0].selected = true;
   for(let i = 0; i<lengthCategoriel5; i++)
     if(document.getElementById("l5").options[i].value == rigoDB['CODREP'])
       document.getElementById("l5").options[i].selected = true;

document.querySelectorAll("select[id='codscoCli'] option").forEach((op,i) => {
  if(i = 0) op.selected = true;
  if(op.value == rigoDB['CODSCO1']) {op.selected = true;}
})
document.querySelectorAll("select[id='codscoFornit'] option").forEach((op) => {
  if(i = 0) op.selected = true;
  if(op.value == rigoDB['CODSCO2']) op.selected = true;
})
document.querySelectorAll("select[id='unimis'] option").forEach((op) => {
  if(i = 0) op.selected = true;
  if(op.value == rigoDB['UNIMIS']) op.selected = true;
})

}

function generaOption(...id){//richiamato al onload del body
  id.forEach((valore,indice,array)=>{
    let sql = "";   
    let idSelect = ""; 
    switch (valore) {
      case 'l1':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='M';";
        idSelect = valore;
      break;
      case 'l2':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='X';";
        idSelect = valore;
      break;
      case 'l3':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='4';";
        idSelect = valore;
      break;
      case 'l4':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='i';";
        idSelect = valore;
      break;
      case 'l5':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='5';";
        idSelect = valore;
      break;
      case 'codscoCli':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='2';";
        idSelect = valore;
      break;
      case 'codscoFornit':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='2';";
        idSelect = valore;
      break;
      case 'unimis':
        sql = "SELECT COD,DESCR FROM 01_desvar where Tipo='U';";
        idSelect = valore;
      break;
    }
    query(sql).done(function( msg,status ) {
      if(msg)//se esistono valori
      {
        msg = JSON.parse(msg);
        msg.forEach((valore,indice,array)=>{
          let op = document.createElement('option');
          op.value = valore['COD'];
          op.text = valore['DESCR'];
          if(valore['DESCR']=="PZ") op.selected = true;
          let select = document.getElementById(idSelect);
          select.appendChild(op);
        });
        
      }
    })
    .fail(function( msg,status ) {
      console.log("error"+msg);
    });
    
  })
};


const cambiaMagazzino = (obj) =>{
  let codart = document.getElementById('CODART').value;
  let anno = String(new Date().getFullYear()).substring(2,4)
  if(codart.trim() != "")
  {
    let mag = document.getElementById("Magazzino")[obj.selectedIndex].innerHTML || "";
    let magV = document.getElementById("Magazzino")[obj.selectedIndex].value;
    let sql ="SELECT SUBSTRING(PROGR,1,12) AS PROGR,";
        sql +=`(select (NET/QTA) from 01_movmag${anno} as M LEFT join 01_caumag AS c ON C.COD = M.CODCAU where codart ='${codart}' and M.coddep ='${magV}' and SUBSTRING(C.test,1,1) = '1' order by artmag DESC limit 1 )AS VALOR`;
        sql +=` FROM 01_conart${anno} WHERE codart = '"+codart+"' AND CODDEP ='${magV}' `; 
  
    query(sql).done(function( msg,status ) {
      if(msg.length > 0)
       { 
         msg = JSON.parse(msg);
            if(msg[0]['PROGR'].length > 0)
              {
                let qta = parseFloat(msg[0]['PROGR']);
                let valor = parseFloat(msg[0]['VALOR']);

                document.getElementById('qta').value = qta;
                document.getElementById('prezzo').value = valor;
              $('#alertCentrale').text("Articolo ").append("<strong>"+codart.toUpperCase()+"</strong>"+" è presente con quantità: <strong>"+qta+"</strong> nel magazzino <strong><span>"+mag+"</span></strong>");            
              }
       }else
       {
       $('#alertCentrale').text("Articolo ").append("<strong>"+codart.toUpperCase()+ " <span style='color:red'>NON</span></strong>"+" esiste nel magazzino <strong><span>"+mag+"</span></strong>");            
       document.getElementById("qta").value = 0;
       document.getElementById('prezzo').value = 0;
     }
    })
    .fail(function(msg,status){
      console.log("fail "+msg+" <br>"+status);
    })
  }
}

/*quando cambia il magazzino controllo l'esistenza del prodotto selezionato nel magazzino selezionato*/
document.getElementById('Magazzino').onchange = function(){
  Magazzino_selezionato = this.value
  cambiaMagazzino(this);
};

