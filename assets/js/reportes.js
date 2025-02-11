loadSedes();

function loadSedes() {
    axios.get(ruta + 'controllers/productosController.php?option=sedes')
      .then(function (response) {
        const info = response.data;
        const sedes= document.getElementById('sede_id');
  
        let html = `<option value="">Seleccione...</option>`;
  
        info.forEach(sede=> {
          html += `<option value="${sede.sede_id}">${sede.nombre}</option>`;
        });
  
        sedes.innerHTML = html;
        
      })
      .catch(function (error) {
        console.log(error);
      });
}

const sede = document.getElementById('sede_id');

sede.addEventListener('change', (e) => {
    const valor = e.target.value;

    if(valor != "") {
        renderProductos(valor)
    }
})

function renderProductos(sede) {
    $('#tablaReporte').DataTable().destroy();
    $('#tablaReporte').DataTable({
      ajax: {
        url: ruta + 'controllers/productosController.php?option=listar_reporte&sede='+sede,
        dataSrc: ''
      },
      columns: [
        { data: 'codproducto' },
        { data: 'nameCategoria' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'precio' },
        { data: 'stock_total' }
      ],
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
      },
      "order": [[0, 'desc']]
    });
  }