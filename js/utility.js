function query(query,seJson = false){
    return $.ajax({
      url: "php/query.php",
      dataType: seJson == true ? "JSON" : "TEXT" ,
      method: "POST",
      data: { query:query },
      statusCode: {404: function() {alert( "php/query.php not found" );}}             
      });
    }