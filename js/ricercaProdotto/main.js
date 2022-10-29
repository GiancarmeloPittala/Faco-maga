  $(function(){
    let anno = String(new Date().getFullYear()).substring(2,4)
    $("#codart, #codmaster, #codbar, #Desc, #Cat").on("change", function(){
      let valore = "";  
      if($(this).val() != "" && $(this).val() !=" ")
        {
          valore = $(this).val();
          let query;
          query = "SELECT A.CODART,A.ARTMAS,D.DESCR AS CAT,A.DESC1,A.PRE1,A.PRE5,SUBSTRING(C.PROGR,1,12) AS QTA,AE.EAN, ((pre1/pre5*100)-100)AS RICARICO FROM 01_anaart AS A ";
          query +="LEFT JOIN 01_desvar AS D ON A.CATMER = D.COD and tipo ='M' ";
          query +=`LEFT JOIN 01_conart${anno} AS C ON A.CODART = C.CODART and CODDEP ='3' `;
          query +="LEFT JOIN 01_anaarte AS AE ON A.ID = AE.IDANAART ";
  
          if($(this).attr('id') == "codart")
            query +="WHERE A.CODART LIKE '"+$(this).val().trim()+"%' ORDER BY A.CODART ";
          else if($(this).attr('id') == "codmaster")
            query +="WHERE A.ARTMAS LIKE '"+$(this).val().trim()+"%' ORDER BY A.ARTMAS ";
          else if($(this).attr('id') == "codbar")
            query +="WHERE AE.idanaart = (SELECT idanaart FROM 01_anaarte WHERE ean like '%"+$(this).val().trim()+"' ) ORDER BY AE.EAN ";
          else if($(this).attr('id') == "Desc")
            query +="WHERE A.DESC1 like '%"+$(this).val().trim()+"%' AND D.TIPO=\"M\" ORDER BY A.DESC1 ";
          else if($(this).attr('id') == "Cat")
            query +="WHERE D.COD = (SELECT COD FROM 01_desvar WHERE DESCR='"+$(this).val().trim()+"' )  ORDER BY AE.EAN ";

          query+="";
          console.log(query);
          $.ajax({
            url: "php/ricercaProdottoTable.php",
            dataType: "json",
            method: "POST",
            data: {
                "query": query
            }              
        })
        .done( function( data ) {
            
          if(data.length > 0)
          {
            var table = $('#table').DataTable();
            table.clear();
            table.rows.add( data )
            .draw()
          }
          else
          {
            var table = $('#table').DataTable();
            table
            .clear()
            .draw();
            $(".dataTables_empty").text("").append("<strong style=\"color:#cc4565\">"+valore+" Non Trovato </strong>");
          }
        })
        .fail( function( data , RESPONSE) {
        alert("Error " +data +"  "+ RESPONSE);
        })
        $(this).val("");
      }
      else
      $(this).val("");   
    })
      })
