loadSedes();

function loadSedes() {
    const idperfil = document.getElementById('idperfil');
    
    axios.get(ruta + 'controllers/productosController.php?option=sedes')
      .then(function (response) {
        const info = response.data;
        const sedes= document.getElementById('sede_id');
        const sed= document.getElementById('idsede');
  
        let html = `<option value="">Seleccione...</option>`;
  
        info.forEach(sede=> {
          if(idperfil.value == 1) {
            html += `<option value="${sede.sede_id}">${sede.nombre}</option>`;
          } else {
            if(sede.sede_id == sed.value) {
              html += `<option value="${sede.sede_id}" selected>${sede.nombre}</option>`;
            }
          }
          
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

            $('#ingresosTable').DataTable().destroy();

            tbody.innerHTML = html;

            $('#ingresosTable').DataTable({
              dom: 'Bfrtip', // Habilita los botones
              buttons: [
                  {
                      extend: 'excelHtml5',
                      text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
                      className: 'btn btn-success'
                  }
              ]
            });
          }
        })
        .catch(function (error) {
          console.log(error);
        });
})