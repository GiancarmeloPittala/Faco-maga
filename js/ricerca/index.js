window.onload = () =>{
    popolaSelect(document.querySelectorAll("form select"));
}
let popolaSelect = (select) => {
    select.forEach((singolaSelect) => {
        switch (singolaSelect.id) {
            case "cat":
            query("SELECT COD,DESCR FROM 01_desvar where TIPO = 'M';").done(function(dati){
                dati = JSON.parse(dati);
                dati.forEach((ele)=>{
                    let op = document.createElement("option");
                    op.value=ele['COD'];
                    op.innerHTML=ele['DESCR'];
                    singolaSelect.appendChild(op);
                })
            })   
            break;
            case "Magazzino":
            query("SELECT COD,DESCR FROM 01_desvar where tipo = 'D';").done(function(dati){
                dati = JSON.parse(dati);
                dati.forEach((ele)=>{
                    let op = document.createElement("option");
                    op.value=ele['COD'];
                    op.innerHTML=ele['DESCR'];
                    singolaSelect.appendChild(op);
                })
            })   
            break;
        
            default:
                break;
        }
    })
}

document.getElementById('formRicerca').onsubmit = function(e){
e.preventDefault();

let codArt = document.getElementById("CODART").value;
let codMaster = document.getElementById("CODMAS").value;
let codBarre= document.getElementById("CODBAR").value;
let desc = document.getElementById("DESC").value;

let cat = document.getElementById("cat").value;
let Magazzino = document.getElementById("Magazzino").value;
let qta = document.getElementById("QTA").value;
let prezzo = document.getElementById("Prezzo").value;

let sql = "SELECT A.CODART FROM"

};