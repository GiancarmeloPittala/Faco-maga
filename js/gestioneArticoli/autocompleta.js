$(function() {
    $( "#CODART" ).autocomplete({
        minLength: 1,
        source: function( request, response ) {         
            query("SELECT CODART FROM 01_anaart where codart like '%"+request.term+"%' LIMIT 10").done( function( data ) {
              if(data.length > 0 )
              {
                data = JSON.parse(data);
                let array = [];
                data.forEach(element => { array.push(element['CODART']); });
                  response (array);
              }
              else
              response ("");
              })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });

  $(function() {
    $( "#CODMAS" ).autocomplete({
        minLength: 1,
        source: function( request, response ) {         
            query("SELECT ARTMAS FROM 01_anaart where ARTMAS like '%"+request.term+"%' LIMIT 10").done( function( data ) {
              if(data.length > 0 )
              {
                data = JSON.parse(data);
                let array = [];
                data.forEach(element => { array.push(element['ARTMAS']); });
                  response (array);
              }
              else
              response ("");
              })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });

  $(function() {
    $( "#CODBAR" ).autocomplete({
        minLength: 1,
        source: function( request, response ) {         
            query("SELECT EAN FROM 01_anaarte where ean like '%"+request.term+"%' LIMIT 10").done( function( data ) {
              if(data.length > 0 )
              {
                data = JSON.parse(data);
                let array = [];
                data.forEach(element => { array.push(element['EAN']); });
                  response (array);
              }
              else
              response ("");
              })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });

  $(function() {
    $( "#DESC" ).autocomplete({
        minLength: 1,
        source: function( request, response ) {         
            query("SELECT DESC1 FROM 01_anaart where DESC1 like '%"+request.term+"%' LIMIT 10").done( function( data ) {
              if(data.length > 0 )
              {
                data = JSON.parse(data);
                let array = [];
                data.forEach(element => { array.push(element['DESC1']); });
                  response (array);
              }
              else
              response ("");
              })
            .fail( function( data , RESPONSE) {
            console.log("Error " +data +"  "+ RESPONSE);
             })
        },
    });
  });