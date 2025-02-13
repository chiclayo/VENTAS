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

const filterForm = document.getElementById('filterForm');

filterForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const frmData = new FormData(filterForm);
      axios.post(ruta + 'controllers/ventasController.php?option=reporte-caja', frmData)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            const tbody = document.getElementById('tbody');

            const datos = info.data;

            let html = "";

            datos.forEach(venta => {
              html += `
              <tr>
                <td>${venta.fecha}</td>
                <td>${venta.nameSede}</td>
                <td>${venta.metodo}</td>
                <td>${venta.total}</td>
              </tr>
              `;
            });

            tbody.innerHTML = html;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
})