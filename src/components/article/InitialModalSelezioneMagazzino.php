<div class="modal fade" id="modalSelectMagazzino" aria-hidden="true" aria-labelledby="modalSelectMagazzino" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-dialog ">
      <div class="modal-content bg-dark-sea-green">
        <div class="modal-header">
          <h5 class="modal-title text-white">Selezionare un magazzino per poter proseguire</h5>
        </div>
        <div class="modal-body">
          <div class="col-lg input-group">
            <label data-bs-title="Magazzino" data-bs-toggle="tooltip" data-bs-placement="top" title="Magazzino" for="maga" type="button" class="btn btn-outline-light">Magazzino</label>
            <select id="maga" class="form-select bootstrap-select">
              <option selected value="Peppino">Open this select menu</option>
            </select>
          </div>
        </div>
        <div class="modal-footer" onclick="modalSelectMagazzino.toggle();">
          <button type="button" class="btn btn-outline-light">Seleziona</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const modalSelectMagazzino = new bootstrap.Modal('#modalSelectMagazzino', {
    backdrop: true,
    focus: true,
    keyboard: false
  })

  const modalSelectMagazzinoEl = document.getElementById('modalSelectMagazzino')
  const coddep =  window.localStorage.getItem('coddep');
 
  if ( coddep == null || coddep == '' )
    modalSelectMagazzino.toggle()

  modalSelectMagazzinoEl.addEventListener('hidden.bs.modal', event => {
    const selected = document.getElementById('maga')
    const option = selected.options[selected.selectedIndex].value;
   
    if( isNaN( Number( option ) ) )
      modalSelectMagazzino.show()
    else window.localStorage.setItem('coddep',option);
  })
</script>