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