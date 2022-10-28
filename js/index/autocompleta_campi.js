/*funzione di autocompletamento permette all'utente
di vedere se un prodotto esiste o meno (codart)*/

$(function() {
    $( "#CODART" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
                url: "php/autocompleta/autocompletaCodart.php",
                dataType: "json",
                method: "POST",
                data: {
                    q: request.term
                }              
            })
            .done( function( data ) {
              response (data);
              })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });

  /*funzione di autocompletamento permette all'utente
di vedere se un prodotto esiste o meno (cod a barre)*/

$(function() {
  $( "#codbar" ).autocomplete({  
    source: function( request, response ) {
      let q =`SELECT ean FROM 01_anaarte WHERE EAN like '${request.term}%' LIMIT 10 `;
      query(q).done(  data => {
        if (data.length > 0)
              {
                let data1 = JSON.parse(data);
                data = [];
                data1.forEach(element => data.push(element.ean) );
              }
            response(data); 
      } )
                  .fail( ( data , RESPONSE) => {
          console.log("Error " ,data +"  ", RESPONSE);
          console.log(data);
           })
      },
  });
});

  
/*funzione di autocompletamento permette all'utente
di vedere se un prodotto esiste o meno (codmaster)*/
$(function() {
    $( "#codmaster" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
                url: "php/autocompleta/autocompletaCodmaster.php",
                dataType: "json",
                method: "POST",
                data: {
                    q: request.term
                }              
            })
            .done( function( data ) {
              response( data );
            })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });  
  /*funzione di autocompletamento permette all'utente
  di vedere e drscrizioni usati per quella categoria */
  $(function() {
    $( "#desc" ).autocomplete({
        source: function( request, response ) {
          let query = "SELECT DISTINCT desc1 as VAL FROM 01_anaart WHERE desc1 like\"%"+$("#desc").val()+"%\" AND CATMER = \""+$("#l1").val()+"\" limit 10;";
          $.ajax({
                url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query:query
                }              
            })
            .done( function( data ) {
              response( data );
            })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });  