<form autocomplete="off" id="searchForm" class="w-100 bg-dark-sea-green rounded-lg p-4 p-lg-5 needs-validation" novalidate>
  <div>
    <div class="mb-2 text-ash-gray">
      Ricerca per 
      <span class=" text-white font-weight-bolder" id="campoRicerca"></span> 
      <span class=" text-white font-weight-bolder" id="tipoRicerca"></span> 
      <span class=" text-white font-weight-bolder" id="stringaRicerca"></span>
    </div>
    <div class="col input-group ">
      <button type="button" class="btn btn-outline-light dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
        </svg>
      </button>
      <ul class="dropdown-menu" id="listCampi">
        <li class="dropdown-item cursor-pointer" value="a.CODART" >Cod. Articolo</li>
        <li class="dropdown-item cursor-pointer" value="ae.EAN" >Cod. a barre</li>
        <li class="dropdown-item cursor-pointer" value="a.ARTMAS" >Cod. master</li>
        <li class="dropdown-item cursor-pointer" value="a.DESC1" >Descrizione breve</li>
      </ul>
      <button type="button" class="btn btn-outline-light dropdown-toggle-split border-l-0" data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
        </svg>
      </button>
      <ul class="dropdown-menu" id="listTipoRicerca">
        <li class="dropdown-item cursor-pointer" value="like">Include</li>
        <li class="dropdown-item cursor-pointer" value="equal">Uguale a</li>
      </ul>
      <input placeholder="XX00000" id="searchInput" type="text" class="form-control" aria-label="Search Input" required>
      <button type="submit" data-bs-title="Cerca un prodotto" data-bs-toggle="tooltip" data-bs-placement="top" title="Cerca un prodotto" for="descrizione" type="button" class="btn btn-outline-light">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </button>
    </div>
  </div>
</form>


<script type="module">
  let article = {};

  import {
    keyName,
    query,
    popolaArticleForm,
    getQta
  } from './js/index.js';

  class SearchForm {
    constructor(id = '#searchForm') {
      this.form = document.querySelector(id);
      this.form.onsubmit = e => this.search(e);

      this.listCampi = document.querySelectorAll('#listCampi > li');
      [].forEach.call( this.listCampi, listCampo => {
        listCampo.onclick = e => this.changeCampoRicerca(listCampo.getAttribute('value'), listCampo.innerText);
      })

      this.listTipoRicerca = document.querySelectorAll('#listTipoRicerca > li');
      [].forEach.call( this.listTipoRicerca, listTipo => {
        listTipo.onclick = e => this.changeTipoRicerca(listTipo.getAttribute('value'), listTipo.innerText);
      })

      this.campoRicerca = document.getElementById('campoRicerca');
      this.tipoRicerca = document.getElementById('tipoRicerca');
      this.stringaRicerca = document.getElementById('stringaRicerca');
      this.searchInput = document.getElementById('searchInput');

      this.searchInput.onkeyup = e => this.changeText(searchInput.value);
    }
    changeCampoRicerca(newCampo, label){
      this.currentCampoRicerca = newCampo;
      this.campoRicerca.innerHTML = label;
    }
    changeTipoRicerca(newCampo, label){
      this.currentTipoRicerca = newCampo;
      this.tipoRicerca.innerHTML = label;
    }
    async search(event) {
      event.preventDefault()
      event.stopPropagation()

      // se non è valido ritorno 
      if (!this.form.checkValidity()) return
      let where = ``;
      const value = document.getElementById('searchInput').value;

      switch (this.currentCampoRicerca) {
        case 'a.CODART':
          if ( this.currentTipoRicerca == 'like' )
            where = `a.CODART like '%${value}%'`;
          else
            where = `a.CODART = '${value}'`;
        break;
        case 'ae.EAN':
          if ( this.currentTipoRicerca == 'like' )
            where = `ae.EAN like '%${value}%'`;
          else
            where = `ae.EAN = '${value}'`;

        break;
        case 'a.ARTMAS':
          if ( this.currentTipoRicerca == 'like' )
            where = `a.ARTMAS like '%${value}%'`;
          else
            where = `a.ARTMAS = '${value}'`;
        break;
        case 'a.DESC1':
          if ( this.currentTipoRicerca == 'like' )
            where = `a.DESC1 like '%${value}%'`;
          else
            where = `a.DESC1 = '${value}'`;

        break;
      
        default:
          break;
      }

      
      const cols = "a.ID, a.CODART, a.ARTMAS, a.DESC1, a.CODSCO1, a.CODSCO2, a.UNIMIS, a.PRE1, a.PRE2, PRE3, PRE4, PRE5";

      const data = await query(`Select ${cols}, ean from 01_anaart a left join 01_anaarte ae on a.ID = ae.idanaart where ${where} limit 0, 10;`)
      

      if ( data.length == 0) { alert('nessun risultato'); return; }
      if ( data.length >  1) { alert('più result'); return; }
      if ( data.length == 1) article = data[0];
      
      // pulisco i dati non necessari, se non ha ean viene cancellato il recor
      // query(`delete from 01_anaarte where ean = ''; `)
      
        getQta(article.CODART, window.localStorage.getItem('coddep') )
      const [ codbar, qta ] = await Promise.all([
        query(`Select ID, EAN from 01_anaarte where idanaart = ${article.ID}; `),
        getQta(article.CODART, window.localStorage.getItem('coddep') )
      ]);

      article.anaarte = codbar.map( cbar => cbar.EAN ).join(',');
      article.qta = qta;

      popolaArticleForm(article)
      this.form.classList.add('was-validated')
    }
    changeText(newValue){
      this.stringaRicerca.innerText = newValue;
    }
  }
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict'
    const searchForm = new SearchForm()
    searchForm

    searchForm.changeCampoRicerca('a.CODART', 'Codice Articlo' );
    searchForm.changeTipoRicerca('like', 'Incude');
  })()
</script>