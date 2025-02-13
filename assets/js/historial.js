let minDate, maxDate, table;
document.addEventListener('DOMContentLoaded', function () {
  loadSedes();

  setTimeout(() => {

    renderVentas();

  }, 1500);

      minDate = new DateTime($('#desde'), {
        format: 'YYYY-MM-DD'
      });
      maxDate = new DateTime($('#hasta'), {
        format: 'YYYY-MM-DD'
      });
    
      
})

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
  function (settings, data, dataIndex) {
    var min = minDate.val();
    var max = maxDate.val();
    var date = new Date(data[4]);

    if (
      (min === null && max === null) ||
      (min === null && date <= max) ||
      (min <= date && max === null) ||
      (min <= date && date <= max)
    ) {
      return true;
    }
    return false;
  }
);

function loadSedes() {
  const profile = document.getElementById('profile');

  if(profile.value == 1) {
    axios.get(ruta + 'controllers/productosController.php?option=sedes')
    .then(function (response) {
      const info = response.data;
      const sedes= document.getElementById('sede');

      let html = ``;

      info.forEach(sede=> {
        html += `<option value="${sede.sede_id}">${sede.nombre}</option>`;
      });

      sedes.innerHTML = html;
      
    })
    .catch(function (error) {
      console.log(error);
    });
  }
  
}

function renderVentas() {
  const idsede = document.getElementById('sede').value;
  $('#table_ventas').DataTable().destroy();
  table =  $('#table_ventas').DataTable({
    ajax: {
      url: ruta + 'controllers/ventasController.php?option=historial&idsede='+idsede,
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'nombre' },
      { data: 'metodo' },
      { data: 'total' },
      { data: 'fecha' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    }
  });

  // Refilter the table
  $('#desde, #hasta').on('change', function () {
    table.draw();
  });
}

const idsede = document.getElementById('sede');

idsede.addEventListener('change', (e) => {
  renderVentas();
})