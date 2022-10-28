class Ricerca {
    constructor (formID){
        this.form = document.getElementById(formID);
        this.keyPressed = {};
        this.init();
        
    }
    init(){

        let input = document.querySelectorAll("#formRicerca input");
        let selects = document.querySelectorAll("#formRicerca select");
        let bottoni = document.querySelectorAll("#ricercaEsatta ,#ricercaParziale");

        this.gestioneInput(input);
        this.generaOption(selects);
        
        
        
      
        document.querySelectorAll("#ricercaEsatta").forEach(ele => ele.addEventListener("click", this.ricerca))
        document.querySelectorAll("#ricercaParziale").forEach(ele => ele.addEventListener("click", this.ricerca))
    }
    permesso = (e) => {
        switch (e) {
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case '0':
            case '<':
            case '>':
            case '=':
            case '!=':
            case ' ':
            case 'Delete':
            case 'Backspace':
            case 'Shift':
                return true;

            default:
                return false;
        }
    }
    gestioneInput = inputs => {
        inputs.forEach(i => i.onkeydown = onkeyup = this.cerca );


  
            let inputPrezzo;
            inputs.forEach(i => i.id == "Prezzo" ? inputPrezzo = i : null );
            inputPrezzo.onkeyup = (e) => {
                let p = inputPrezzo.value;
                 if(!this.permesso(e.key))
                     p = p.replace(/[^<>!0-9]/g, '');

                p = p.replace('<<', '<');
                p = p.replace('>>', '>');
                p = p.replace('<>', '<');
                p = p.replace('><', '>');
                p = p.replace('!!', '!');
                p = p.replace('!<', '!');
                p = p.replace('!>', '!');
                p = p.replace('<!', '<');
                p = p.replace('>!', '>');
                p = p.replace('==', '=');
                p = p.trimStart();
                 inputPrezzo.value = p;
                }

        }
    
    
    generaOption = (selects) =>
    {
        selects.forEach(s => {
            let sql= "";
            switch (s.id) {
                case "cat":
                    sql="SELECT COD,DESCR FROM 01_desvar where TIPO ='M';";
                break;
                case 'dep':
                    sql= `SELECT COD,DESCR FROM 01_desvar where tipo = 'D';`;
                break;
                default:
                    return;
                    
    
            }
            query(sql).done( data => {
            data = JSON.parse(data);
            data.forEach(ele => {
                let op = document.createElement("option");
                op.value = ele['COD'];
                op.innerHTML =ele['DESCR'];
                s.appendChild(op);
            })
            })
        });
    }

    cerca = key => {
        if (key.isComposing || key.keyCode === 229) { return; }
    
        key = key || event; // to deal with IE
        if(key.keyCode == 13 || key.keyCode == 17)
        {
            this.keyPressed[key.keyCode] = key.type == 'keydown';
    
            if(this.keyPressed[17] && this.keyPressed[13])
                this.ricerca(key);
            else if(this.keyPressed[13])
                this.ricerca(key,false);
                
        }
    }
    controlloPrezzo = (stringaPrezzo,campo) => {
        let operazioni = stringaPrezzo.split(" ");
        let sreturn = "";

        if(stringaPrezzo.lastIndexOf(">") < 0 && stringaPrezzo.lastIndexOf("<") && stringaPrezzo.lastIndexOf("="))
        {
            sreturn += `${campo} Between ${parseFloat(operazioni[0])-parseFloat(operazioni[0]/2)} AND ${parseFloat(operazioni[0])+parseFloat(operazioni[0]/2)} `;
            console.log(operazioni[0]/2);
            return sreturn;
        }
   
        operazioni.forEach( op => {
            let s = op.toString();
            sreturn += `${campo}${op} AND `;
        });
        sreturn = sreturn.substring(0,sreturn.lastIndexOf("AND"));//tolgo l'ultimo AND
        return sreturn;
    }

    ricerca = (ele,esatta=true) => {

    let tipoRicerca = ele.target.getAttribute("rif"); //contiene il riferimento al campo input interessato
    let campoTabella = ele.target.getAttribute("campo");//contiene il campo della tabella
    let coddep = document.getElementById("dep").value == "" ? `` : `AND CODDEP = ${document.getElementById("dep").value} `;
   
    let condizione = "";
    let extra = "";
    let val = document.getElementById(tipoRicerca).value;
    
  

    if(campoTabella == "AE.EAN")
        {
            campoTabella = "A.CODART ";
            condizione = ` = (SELECT CODART FROM 01_ANAART WHERE ID = (SELECT IDANAART FROM 01_anaarte where ean = '${val}' ) ) `;
        }
    else
        if(esatta && ( ele.target.type == "text" || ele.target.type == "number" || (ele.target.type == "button" && ele.target.id == "ricercaEsatta") ) )
            condizione = `= '${val}' `;
        else
            condizione = `LIKE '%${val}%' `; 
    
    /*filtri*/
        let categoria = document.getElementById("cat").value;
        let prezzo = document.getElementById("Prezzo").value.trim();
        let tipoPrezzo = document.getElementById("tipoPrezzo").value;
        if(categoria != "")
        extra += `AND A.CATMER = '${categoria}' `;
        
        if(prezzo !="")
        extra += `AND ${this.controlloPrezzo(prezzo,tipoPrezzo)}`;

        document.querySelector(".loader").style.display = "block";

    let sql = `SELECT A.CODART, AE.EAN AS CODBAR, A.DESC1, A.UNIMIS, A.PRE1 ,A.PRE2, A.PRE3, A.PRE4, A.PRE5, A.ARTMAS, A.INGR, A.TIPPRE, `;
        sql += `l1.DESCR AS l1, L2.DESCR AS l2, L3.DESCR AS l3, L4.DESCR AS l4, L5.DESCR AS l5, `;
        sql += `scoCli.DESCR AS codscocli, scoForn.DESCR AS codscofornit, `;
        sql += `C.CODDEP, SUBSTRING(C.PROGR,1,12) AS PROGR, ((A.pre1/A.pre5*100)-100) AS RICARICO `;
        sql += `FROM 01_anaart AS A `;
        sql += `LEFT JOIN 01_conart19 AS C ON A.CODART = C.CODART ${coddep} `;
        sql += `LEFT JOIN 01_anaarte AS AE ON A.id = AE.idanaart `;
        sql += `LEFT JOIN 01_desvar AS L1 ON A.CATMER = L1.COD AND L1.TIPO = 'M' `;
        sql += `LEFT JOIN 01_desvar AS L2 ON A.TIPPRO = L2.COD AND L2.TIPO = 'X' `;
        sql += `LEFT JOIN 01_desvar AS L3 ON A.TIPART = L3.COD AND L3.TIPO = '4' `;
        sql += `LEFT JOIN 01_desvar AS L4 ON A.CATINV = L4.COD AND L4.TIPO = 'i' `;
        sql += `LEFT JOIN 01_desvar AS L5 ON A.CODREP = L5.COD AND L5.TIPO = '5' `;
        sql += `LEFT JOIN 01_desvar AS scoCli ON A.CODSCO1 = scoCli.COD AND scoCli.TIPO = '2' `;
        sql += `LEFT JOIN 01_desvar AS scoForn ON A.CODSCO2 = scoForn.COD AND scoForn.TIPO = '2' `;
        sql += `WHERE ${campoTabella}  ${condizione} ${extra} LIMIT 10000 `;

        console.log(sql);
    query(sql).done( dati => {
        var table = $('#ricerca').DataTable();
        if(dati.length > 0)
        {
            dati = JSON.parse(dati);
            table.clear();
            table.rows.add( dati )
            .draw() 
            .nodes()
            .to$()
            .addClass( 'new' );
            $('#ricerca').resize();
            $('#ricerca').resize();
        }
        else
        {table.clear()
            .draw()
        }
    }).fail (dati => {
        console.log("ERROR ",dati);
    }).always ( dati => {
        document.querySelector(".loader").style.display = "none";
    })


    }

}

