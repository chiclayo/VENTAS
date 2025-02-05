const frm = document.querySelector('#frmLogin');
const email = document.querySelector('#email');
const password = document.querySelector('#password');

document.addEventListener('DOMContentLoaded', function(){
    frm.onsubmit = function(e){
        e.preventDefault();
        if (email.value == '' || password.value == '') {
            message('error', 'TODO LOS CAMPOS SON OBLIGATORIOS');
        } else {
            axios.post(ruta + 'controllers/usuariosController.php?option=acceso', {
                email: email.value,
                password: password.value
              })
              .then(function (response) {
                const info = response.data;
                if (info.tipo == 'success') {
                    window.location = ruta + 'plantilla.php';
                }
                message(info.tipo, info.mensaje);
              })
              .catch(function (error) {
                console.log(error);
              });
        }
    }
})

function message(tipo, mensaje) {
    Snackbar.show({
        text: mensaje,
        pos: 'top-right',
        backgroundColor: tipo == 'success' ? '#fdfefe' : '#CC0000 ',
        actionText: 'Cerrar'
    });
}