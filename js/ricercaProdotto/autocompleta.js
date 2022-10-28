
$(function() {
    $( "#codart" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
                url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query: "SELECT CODART AS VAL FROM 01_anaart WHERE CODART LIKE '%"+request.term+"%' LIMIT 10"
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

$(function() {
    $( "#codmaster" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
             url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query: "SELECT DISTINCT ARTMAS AS VAL FROM 01_anaart WHERE ARTMAS LIKE '%"+request.term+"%' LIMIT 10"
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

  $(function() {
    $( "#codbar" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
             url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query: "SELECT EAN AS VAL FROM 01_anaarte WHERE EAN LIKE '%"+request.term+"%' LIMIT 10"
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

  $(function() {
    $( "#Desc" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
             url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query: "SELECT DISTINCT DESC1 AS VAL FROM 01_anaart WHERE DESC1 LIKE '%"+request.term+"%' LIMIT 10"
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
  $(function() {
    $( "#Cat" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
             url: "php/autocompleta/autocompleta.php",
                dataType: "json",
                method: "POST",
                data: {
                    query: "SELECT DESCR AS VAL FROM 01_desvar WHERE TIPO=\"M\" AND DESCR LIKE '"+request.term+"%' LIMIT 10"

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
