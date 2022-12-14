<form id="articleForm" class="w-100 bg-dark-sea-green rounded-lg p-4 needs-validation" novalidate autocomplete="off">

  <!-- Primo rigo -->
  <div class="row g-4">
    <div class="col-12 col-xl-6">
      <div class="input-group">
        <label data-bs-title="Codice articolo" data-bs-toggle="tooltip" data-bs-placement="top" title="Codice articolo" for="codArticolo" type="button" class="btn btn-outline-light">Cod. Articolo</label>
        <input id="codArticolo" required type="text" class="form-control " aria-label="Text input with segmented dropdown button">
      </div>
    </div>
    <div class="col-12 col-xl-6 ">
      <div class="input-group">
        <label data-bs-title="Il codice master è una stringa che identifica il gruppo di appartenenza del prodotto" data-bs-toggle="tooltip" data-bs-placement="top" title="Il codice master è una stringa che identifica il gruppo di appartenenza del prodotto" for="codMaster" type="button" class="btn btn-outline-light">Cod. Master</label>
        <input id="codMaster" type="text" class="form-control" aria-label="Text input with segmented dropdown button">
      </div>
    </div>
    <div class="col-12">
      <div class="input-group">
        <label data-bs-title="Codice a barre" data-bs-toggle="tooltip" data-bs-placement="top" title="Codice a barre" for="codbar" type="button" class="btn btn-outline-light">Codice a barre</label>
        <input id="codbar" type="text" class="form-control" aria-label="Codice a barre">
      </div>
    </div>
    <div class="col-12 col-xl-6">
      <div class="input-group">
        <label data-bs-title="Descrizione breve" data-bs-toggle="tooltip" data-bs-placement="top" title="descrizione breve" for="descrizione" type="button" class="btn btn-outline-light">Descrizione</label>
        <input id="descrizione" type="text" class="form-control" aria-label="Descrizione">
      </div>
    </div>
    <div class="col-12 col-xl-6">
      <div class="px-0">
        <div class="input-group">
          <label data-bs-title="quantità" data-bs-toggle="tooltip" data-bs-placement="top" title="quantità" for="qta" type="button" class="btn btn-outline-light">Quantità</label>
          <input id="qta" type="number" step="1" class="form-control" aria-label="quantità">
          <button id="minusBtn" type="button" class="btn btn-outline-light"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg></button>
          <button id="plusBtn" type="button" class="btn btn-outline-light"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></button>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="input-group">
        <label data-bs-title="Sconto Cliente" data-bs-toggle="tooltip" data-bs-placement="top" title="Sconto Cliente" for="codscoCli" type="button" class="btn btn-outline-light">Sconto Cliente</label>
        <select id="codscoCli" class="form-select bootstrap-select">
          <option selected value="">Open this select menu</option>
        </select>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="input-group">
        <label data-bs-title="Sconto fornitore" data-bs-toggle="tooltip" data-bs-placement="top" title="Sconto fornitore" for="codscoFornit" type="button" class="btn btn-outline-light">Sconto fornitore</label>
        <select id="codscoFornit" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="input-group">
        <label data-bs-title="Unità di misura" data-bs-toggle="tooltip" data-bs-placement="top" title="Unità di misura" for="unimis" type="button" class="btn btn-outline-light">Unit. misura</label>
        <select id="unimis" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-3">
      <div class="input-group">
        <label data-bs-title="Categoria di primo livello" data-bs-toggle="tooltip" data-bs-placement="top" title="Categoria di primo livello" for="l1" type="button" class="btn btn-outline-light">L1</label>
        <select id="l1" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-3">
      <div class="input-group">
        <label data-bs-title="Categoria di secondo livello" data-bs-toggle="tooltip" data-bs-placement="top" title="Categoria di secondo livello" for="l2" type="button" class="btn btn-outline-light">L2</label>
        <select id="l2" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Categoria di primo livello" data-bs-toggle="tooltip" data-bs-placement="top" title="Categoria di primo livello" for="l1" type="button" class="btn btn-outline-light">L3</label>
        <select id="l3" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Categoria di primo livello" data-bs-toggle="tooltip" data-bs-placement="top" title="Categoria di primo livello" for="l1" type="button" class="btn btn-outline-light">L4</label>
        <select id="l4" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Categoria di primo livello" data-bs-toggle="tooltip" data-bs-placement="top" title="Categoria di primo livello" for="l1" type="button" class="btn btn-outline-light">L5</label>
        <select id="l5" class="form-select bootstrap-select"></select>
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Prezzo 1" data-bs-toggle="tooltip" data-bs-placement="top" title="Prezzo 1" for="pre1" type="button" class="btn btn-outline-light">Prezzo 1</label>
        <input required id="pre1" type="number" step="0.01" class="form-control" aria-label="Prezzo 1">
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Prezzo 2" data-bs-toggle="tooltip" data-bs-placement="top" title="Prezzo 2" for="pre2" type="button" class="btn btn-outline-light">Prezzo 2</label>
        <input id="pre2" type="number" step="0.01" class="form-control" aria-label="Prezzo 2">
      </div>
    </div>
    <div class="col-12 col-xl-2">
      <div class="input-group">
        <label data-bs-title="Prezzo 3" data-bs-toggle="tooltip" data-bs-placement="top" title="Prezzo 3" for="pre3" type="button" class="btn btn-outline-light">Prezzo 3</label>
        <input id="pre3" type="number" step="0.01" class="form-control" aria-label="Prezzo 3">
      </div>
    </div>
    <div class="col-12 col-xl-3">
      <div class="input-group">
        <label data-bs-title="Prezzo 4" data-bs-toggle="tooltip" data-bs-placement="top" title="Prezzo 4" for="pre4" type="button" class="btn btn-outline-light">Prezzo 4</label>
        <input id="pre4" type="number" step="0.01" class="form-control" aria-label="Prezzo 4">
      </div>
    </div>
    <div class="col-12 col-xl-3">
      <div class="input-group">
        <label data-bs-title="Prezzo 5" data-bs-toggle="tooltip" data-bs-placement="top" title="Prezzo 5" for="pre5" type="button" class="btn btn-outline-light">Prezzo 5</label>
        <input id="pre5" type="number" step="0.05" class="form-control" aria-label="Prezzo 5">
      </div>
    </div>
  </div>

  <div class="row justify-content-between align-items-sm-center  mt-4 g-4">
    <div class="col-lg">

      <div class="d-flex gap-4 align-items-center text-white btn btn-outline-success">
        <input type="checkbox" id="check" name="check" class="w-6 h-6">
        <span>
          <label for="check" class="ml-2">Non generare il movimento di magazzino</label>
        </span>
      </div>

    </div>
    <div class="col-lg ">
      <button type="submit" class=" w-100 btn btn-outline-success font-weight-bold">
        CONFERMA
      </button>
    </div>
  </div>

</form>

<script type="module">
  import {
    query,
    initCodScoCli,
    initCodScoFornit,
    initCategorieL1,
    initCategorieL2,
    initCategorieL3,
    initCategorieL4,
    initCategorieL5,
    initUnitMis,
    initMaga,
    toast
  } from './src/js/index.js';

  const codscoCli = document.getElementById('codscoCli');
  const codscoFornit = document.getElementById('codscoFornit');
  const l1 = document.getElementById('l1');
  const l2 = document.getElementById('l2');
  const l3 = document.getElementById('l3');
  const l4 = document.getElementById('l4');
  const l5 = document.getElementById('l5');
  const unimis = document.getElementById('unimis');
  const maga = document.getElementById('maga');

  (async () => {

    await Promise.all([
      initCodScoCli(codscoCli),
      initCodScoFornit(codscoFornit),
      initCategorieL1(l1),
      initCategorieL2(l2),
      initCategorieL3(l3),
      initCategorieL4(l4),
      initCategorieL5(l5),
      initUnitMis(unimis),
      initMaga(maga)
    ]);

    const articleForm = document.getElementById('articleForm');
    const check = document.getElementById('check');
    const qta = document.getElementById('qta');
    const minusBtn = document.getElementById('minusBtn')
    const plusBtn = document.getElementById('plusBtn')

    check.onclick = () => {
      qta.disabled = check.checked;
    }

    articleForm.onsubmit = async e => {
      event.preventDefault();
      event.stopPropagation();


      articleForm.classList.add('was-validated')
      // se non è valido ritorno 
      if (!articleForm.checkValidity()) return;


      const form = document.querySelectorAll('input, select');
      let values = [];

      for (const [key, input] of [...form.entries()]) {
        if (input.id == 'check')
          values[input.id] = input.checked;
        else values[input.id] = input.value;
      }

      try {
        const res = await fetch('src/php/gestione.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            ...values,
            maga: window.localStorage.getItem('coddep')
          })
        })

        const result = await res.json();
        if (res.status >= 300) throw result;

        articleForm.reset()
        articleForm.classList.remove('was-validated')
        document.querySelector('input[type="search"]').focus();
        toast.success(result.msg)

      } catch (error) {
        console.log(error)
        toast.error(error.msg ?? error.message)
      }

    }

    minusBtn.onclick = () => {
      const currentQta = qta.value;
      if ( !isNaN(currentQta) && currentQta - 1 >= 0 )
        qta.value -= 1;
      else {
        qta.value = 0;
      }
    }

    plusBtn.onclick = () => {
      const currentQta = qta.value;
      if ( !isNaN(currentQta) )
        qta.value = Number( qta.value ) + 1;
    }

  })()
</script>