const frm = document.querySelector('#frmcategoria');
const nombre = document.querySelector('#nombre');
const id_categoria = document.querySelector('#id_categoria');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');
document.addEventListener('DOMContentLoaded', function () {
  $('#table_categorias').DataTable({
    ajax: {
      url: ruta + 'controllers/categoriasController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'idcategoria' },
      { data: 'nombre' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });
  frm.onsubmit = function (e) {
    e.preventDefault();
    if (nombre.value == '' ) {
      message('error', 'TODO LOS CAMPOS SON OBLIGATORIOS')
    } else {
      const frmData = new FormData(frm);
      axios.post(ruta + 'controllers/categoriasController.php?option=save', frmData)
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
    id_categoria.value = '';
    btn_save.innerHTML = 'Guardar';
    nombre.focus();
  }
})

function deleteCategoria(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/categoriasController.php?option=delete&id=' + id)
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

function editCategoria(id) {
  axios.get(ruta + 'controllers/categoriasController.php?option=edit&id=' + id)
    .then(function (response) {
      const info = response.data;
      nombre.value = info.nombre;
      id_categoria.value = info.idcategoria;
      btn_save.innerHTML = 'Actualizar';
    })
    .catch(function (error) {
      console.log(error);
    });
}