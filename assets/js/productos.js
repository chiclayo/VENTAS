const frm = document.querySelector('#frmProductos');
const categoria = document.querySelector('#categoria');
const nombre = document.querySelector('#nombre');
const descripcion = document.querySelector('#descripcion');
const precio = document.querySelector('#precio');
const stock = document.querySelector('#stock');
const id_product = document.querySelector('#id_product');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');
const sede_id = document.getElementById('sede_id');

document.addEventListener('DOMContentLoaded', function () {
  loadSedes();

  setTimeout(() => {

    renderProductos(sede_id.value);

  }, 1000);
  
  frm.onsubmit = function (e) {

    e.preventDefault();
    if ( categoria.value == ''|| nombre.value == ''|| descripcion.value == ''
      || precio.value == '' ) {
      message('error', 'TODO LOS CAMPOS SON OBLIGATORIOS')
    } else {
      const frmData = new FormData(frm);
      axios.post(ruta + 'controllers/productosController.php?option=save', frmData)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
  btn_nuevo.onclick = function () {
    frm.reset();
    id_product.value = '';
    btn_save.innerHTML = 'Guardar';
    nombre.focus();
  }

  loadCategorias();
  
})

function renderProductos(sede) {
  $('#table_productos').DataTable().destroy();
  $('#table_productos').DataTable({
    ajax: {
      url: ruta + 'controllers/productosController.php?option=listar&sede='+sede,
      dataSrc: ''
    },
    columns: [
      { data: 'codproducto' },
      { data: 'nameCategoria' },
      { data: 'nombre' },
      { data: 'descripcion' },
      { data: 'precio' },
      { data: 'stock_total' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });
}

function deleteProducto(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/productosController.php?option=delete&id=' + id)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });

}

function editProducto(id) {
  axios.get(ruta + 'controllers/productosController.php?option=edit&id=' + id)
    .then(function (response) {
      
      const info = response.data;
      categoria.value = info.idcategoria;
      nombre.value = info.nombre;
      descripcion.value = info.descripcion;
      precio.value = info.precio;
      id_product.value = info.codproducto;
      btn_save.innerHTML = 'Actualizar';
    })
    .catch(function (error) {
      console.log(error);
    });
}
function loadCategorias() {
  axios.get(ruta + 'controllers/productosController.php?option=categorias')
    .then(function (response) {
      const info = response.data;
      const categoria= document.getElementById('categoria');

      let html = `<option value="">Seleccione...</option>`;

      info.forEach(cat=> {
        html += `<option value="${cat.idcategoria}">${cat.nombre}</option>`;
      });

      categoria.innerHTML = html;
      
    })
    .catch(function (error) {
      console.log(error);
    });
}

function loadSedes() {
  axios.get(ruta + 'controllers/productosController.php?option=sedes')
    .then(function (response) {
      const info = response.data;
      const sedes= document.getElementById('sede_id');

      let html = `<option value="0">TODOS</option>`;

      info.forEach(sede=> {
        html += `<option value="${sede.sede_id}">${sede.nombre}</option>`;
      });

      sedes.innerHTML = html;
      
    })
    .catch(function (error) {
      console.log(error);
    });
}

sede_id.addEventListener('change', (e) => {
  const valor = e.target.value;
  renderProductos(valor);
})