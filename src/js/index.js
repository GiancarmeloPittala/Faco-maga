const sleepTime = 0;
export async function query(q) { 
  return await (await fetch("src/php/q.php", {
    method: 'POST' ,
    headers: {
      'Content-Type': 'application/json',
    }, 
    body: JSON.stringify( { query: q } )
  })).json() 
};

export async function sleep (time) { return await new Promise(r => setTimeout(r, time)); } 

export async function initCodScoCli(codScoCli) {
  try {
    codScoCli.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='2' and DESCR != '';`)
    await sleep(sleepTime)
    codScoCli.innerHTML = '<option value=""> Nessuno sconto cliente</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      codScoCli.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCodScoFornit(codScoFor) {
  try {
    codScoFor.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='2' and DESCR != '';`)
    await sleep(sleepTime)
    codScoFor.innerHTML = '<option value=""> Nessuno sconto fornitore</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      codScoFor.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initUnitMis(unimis) {
  try {
    unimis.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='U' and DESCR != '' ;`)
    await sleep(sleepTime)
    unimis.innerHTML = '<option value=""> Nessuno sconto fornitore</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      if(DESCR=="PZ") op.selected = true;
      unimis.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCategorieL1(l1) {
  try {
    l1.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='!' and DESCR != '';`)
    await sleep(sleepTime)
    if ( data.length == 0)
      l1.innerHTML = '<option value=""> Nessuna categoria di livello 1 trovata</option>'
    else 
      l1.innerHTML = '<option value=""> Nessuna categoria</option>'
      
    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      l1.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCategorieL2(l2) {
  try {
    l2.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='£' and DESCR != '';`)
    await sleep(sleepTime)

    if ( data.length == 0)
      l2.innerHTML = '<option value=""> Nessuna categoria di livello 2 trovata</option>'
    else 
      l2.innerHTML = '<option value=""> Nessuna categoria</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      l2.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCategorieL3(l3) {
  try {
    l3.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='$' and DESCR != '';`)
    await sleep(sleepTime)
    if ( data.length == 0)
      l3.innerHTML = '<option value=""> Nessuna categoria di livello 3 trovata</option>'
    else 
      l3.innerHTML = '<option value=""> Nessuna categoria</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      l3.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCategorieL4(l4) {
  try {
    l4.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='%' and DESCR != '';`)
    await sleep(sleepTime)
    if ( data.length == 0)
      l4.innerHTML = '<option value=""> Nessuna categoria di livello 4 trovata</option>'
    else 
      l4.innerHTML = '<option value=""> Nessuna categoria</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      l4.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initCategorieL5(l5) {
  try {
    l5.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='&' and DESCR != '';`)
    await sleep(sleepTime)
    if ( data.length == 0)
      l5.innerHTML = '<option value=""> Nessuna categoria di livello 5 trovata</option>'
    else 
      l5.innerHTML = '<option value=""> Nessuna categoria</option>'

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      l5.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export async function initMaga(maga) {
  try {
    maga.innerHTML = `<option> In attesa dei dati</option>`
    const data = await query(`SELECT COD,DESCR FROM 01_desvar where Tipo='D' and DESCR != '';`)
    await sleep(sleepTime)
    maga.innerHTML = ``

    for( const {COD, DESCR } of data ){
      let op = document.createElement('option');
      op.value = COD;
      op.text = DESCR;
      maga.appendChild(op);
    }
 

  } catch (e) {
    console.error( e )
  }
}
export const keyName = { codbar: "anaarte", codArticolo: "CODART", codMaster: "ARTMAS", descrizione: "DESC1", codscoCli: "CODSCO1", codscoFornit: "CODSCO2", unimis: "unimis", l1: "l1", l2: "l2", l3: "l3", l4: "l4", l5: "l5", pre1: 'PRE1', pre2: 'PRE2', pre3: 'PRE3', pre4: 'PRE4', pre5: 'PRE5', qta: 'qta' }

export async function popolaArticleForm(data){

  const articleForm = document.getElementById('articleForm');
  const inputs = articleForm.querySelectorAll('input, select');

  for ( let input of inputs ){

    if( ['text', 'number'].includes( input.type ) ){
      input.value = data[keyName[input.id]]
      continue;
    }
    

    if ( input.type == 'select-one' ){

      for ( const opt of input.options )
        if ( opt.value == data[keyName[input.id] ] )
          opt.selected = true;
    

    }


    
  }

}
export const anno = String(new Date().getFullYear()).substring(2,4);

export async function getQta(codart, coddep){
  try {
    const queryStr = `SELECT MOVMAG.CODART,anaart.desc1,anaart.desc2,anaart.unimis,desvar.descr AS DESUNIMIS,SUM(QTA*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as QTA, SUM(NET*CONVERT(CONCAT(SubStr(CAUMAG.TEST,4,1),'1'),SIGNED)) as NET,ANAART.PRE1,MOVMAG.CODDEP FROM 
    01_movmag${anno} as MOVMAG 
    Left join 01_caumag as CAUMAG on CAUMAG.COD=MOVMAG.CODCAU 
    Left join 01_anaart as anaart on anaart.CODART=MOVMAG.CODART 
    Left join 01_desvar as desvar on DESVAR.TIPO='U' and anaart.unimis = desvar.COD WHERE SubStr(CAUMAG.TEST, 4, 1) != '' AND ANAART.valmag is not null and ANAART.VALMAG != 'N' and movmag.CODDEP="${coddep}" AND movmag.codart="${codart}" GROUP BY CODDEP,CODART ORDER BY CODDEP,CODART`
    
    const [result] = await query(queryStr);
    return result ? result.QTA : {};

  } catch (error) {
    console.error( error )
  }


}

export const toast = {

  success(message, sound = true){
    if ( sound ){
      const audio = new Audio('public/sound/confirm.wav');
      audio.play();
    }
    
    Toastify({
      text: message,
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: "linear-gradient(to right, #52796fff, #354f52ff)",
      },
    }).showToast();
  },
  error(message, sound = true){
    if ( sound ){
      const audio = new Audio('public/sound/error.flac');
      audio.play();
    }
    Toastify({
      text: message,
      duration: 3000,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "right", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        width: "900px !important",
        background: "linear-gradient(to right, #ae2012ff, #9b2226ff)",
      },
    }).showToast();
  }
} 