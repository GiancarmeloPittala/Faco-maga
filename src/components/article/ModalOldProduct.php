<div class="modal fade" id="modalOldProducts" aria-hidden="true" aria-labelledby="oldProducts" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-dialog ">
      <div class="modal-content bg-dark-sea-green">
        <div class="modal-header">
          <h5 data-bs-title="Seleziona un prodotto per ottenere i dati" data-bs-toggle="tooltip" data-bs-placement="top" title="Seleziona un prodotto per ottenere i dati" class="modal-title text-white">Lista prodotti</h5>
        </div>
        <div class="modal-body" style="width: 400px">
          <div id="oldProductList" class="list-group">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
   const modalOldProducts = new bootstrap.Modal('#modalOldProducts', {
    backdrop: true,
    focus: true,
    keyboard: false
  })
</script>

