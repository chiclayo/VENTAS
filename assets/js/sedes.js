const frm = document.querySelector('#frmsede');
const nombre = document.querySelector('#nombre');
const direccion = document.querySelector('#direccion');
const estado = document.querySelector('#estado');
const id_sede = document.querySelector('#id_sede');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');
document.addEventListener('DOMContentLoaded', function () {
  $('#table_sedes').DataTable({
    ajax: {
      url: ruta + 'controllers/sedesController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'sede_id' },
      { data: 'nombre' },
      { data: 'direccion' },
      { data: 'estado' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });
  frm.onsubmit = function (e) {
    e.preventDefault();
    if (nombre.value == '' || direccion.value == ''
      || estado.value == '') {
      message('error', 'TODO LOS CAMPOS CON * SON REQUERIDOS')
    } else {
      const frmData = new FormData(frm);
      axios.post(ruta + 'controllers/sedesController.php?option=save', frmData)
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
    id_sede.value = '';
    btn_save.innerHTML = 'Guardar';
    nombre.focus();
  }
})

function deleteSede(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/sedesController.php?option=delete&id=' + id)
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

function editSede(id) {
  axios.get(ruta + 'controllers/sedesController.php?option=edit&id=' + id)
    .then(function (response) {
      const info = response.data;
      nombre.value = info.nombre;
      direccion.value = info.direccion;
      estado.value = info.estado;
      id_sede.value = info.sede_id;
      btn_save.innerHTML = 'Actualizar';
    })
    .catch(function (error) {
      console.log(error);
    });
}