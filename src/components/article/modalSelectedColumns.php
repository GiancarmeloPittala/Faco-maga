<div class="modal fade" id="modalSelectedColumns" aria-hidden="true" aria-labelledby="modalSelectedColumns" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-dialog ">
      <div class="modal-content bg-dark-sea-green">
        <div class="modal-header">
          <h5 class="modal-title text-white">Mostra / Nascondi delle colonne</h5>
        </div>
        <div class="modal-body" id="columnShowList">

        </div>
      </div>
    </div>
  </div>
</div>

<script>

  const modalSelectedColumns = new bootstrap.Modal('#modalSelectedColumns', {
    backdrop: true,
    focus: true,
    keyboard: false
  })

  const form = document.querySelectorAll('#articleForm input, #articleForm select ');

  const columnShowList = document.getElementById('columnShowList');

  let values = [];

  for ( const [key, input] of [ ... form.entries() ]){
    if( input.id == 'check' )
      values[input.id] = input.checked;
    else values[input.id] = input.value;
  }
 

  let showColumnList = window.localStorage.getItem('showColumnList');
  const keys = Object.keys( values ).filter( k => !['qta','codArticolo'].includes(k) );

  if ( showColumnList && showColumnList.length > 0  ) showColumnList = JSON.parse(showColumnList);
  
  else showColumnList = keys.map( key => ({ key, selected: true }));



  for( const showColumnSingle of showColumnList ){
    if ( showColumnSingle.selected === true  )
      columnShowList.innerHTML += ` <div colItem class="btn btn-outline-light"> ${ showColumnSingle.key } </div>`
    else
      columnShowList.innerHTML += ` <div colItem class="btn btn-outline-danger"> ${ showColumnSingle.key } </div>`
  }

  const buttonColItem = document.querySelectorAll('[colItem]');

  function buttonListener (button) {

    let showColumnList = JSON.parse( window.localStorage.getItem('showColumnList') );
   
    const current = showColumnList.find( col => col.key == button.innerText );
    if ( current ) current.selected = ! current.selected;


    buttonColItem.forEach( button => {
      const c = showColumnList.find( col => col.key == button.innerText );

        if ( c && !c.selected === true  ){
          button.classList.remove('btn-outline-light')
          button.classList.add('btn-outline-danger')
        }
        else{
          button.classList.add('btn-outline-light')
          button.classList.remove('btn-outline-danger')
        }
    } )
      // nacondo gli input
      const input = document.querySelector(`#${current.key}`);

      if ( current.selected === true)
        input.parentElement.parentElement.classList.remove('d-none')
      else
        input.parentElement.parentElement.classList.add('d-none')
      

    window.localStorage.setItem('showColumnList', JSON.stringify(showColumnList) );

}
  for ( const btn of buttonColItem )
    btn.onclick = () => buttonListener(btn)
   

  window.localStorage.setItem('showColumnList', JSON.stringify(showColumnList) );
</script>