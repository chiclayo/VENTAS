const frm = document.querySelector('#frmConfiguracion');
const telefono = document.querySelector('#telefono');
const nombre = document.querySelector('#nombre');
const ruc = document.querySelector('#ruc');
const direccion = document.querySelector('#direccion');
const correo = document.querySelector('#correo');
const id = document.querySelector('#id');
const btn_save = document.querySelector('#btn-save');
document.addEventListener('DOMContentLoaded', function () {
    //mostra datos de la empresa
    cargarDatos()

    frm.onsubmit = function (e) {
        e.preventDefault();
        if (telefono.value == '' || nombre.value == ''|| ruc.value == ''
            || direccion.value == '' || correo.value == '') {
            message('error', 'TODO LOS CAMPOS SON OBLIGATORIOS')
        } else {
            const frmData = new FormData(frm);
            axios.post(ruta + 'controllers/adminController.php?option=save', frmData)
                .then(function (response) {
                    console.log(response);
                    const info = response.data;
                    message(info.tipo, info.mensaje);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
})

function cargarDatos() {
    axios.get(ruta + 'controllers/adminController.php?option=datos')
        .then(function (response) {
            const info = response.data;
            telefono.value = info.telefono;
            nombre.value = info.nombre;
            ruc.value = info.ruc;
            direccion.value = info.direccion;
            correo.value = info.email;
            id.value = info.id;
        })
        .catch(function (error) {
            console.log(error);
        });
}