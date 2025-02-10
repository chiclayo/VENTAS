let table_temp = document.querySelector('#table_temp tbody');

const nombre_cliente = document.querySelector('#nombre-cliente');
const dir_cliente = document.querySelector('#dir-cliente');
const id_cliente = document.querySelector('#id-cliente');

const btn_save = document.querySelector('#btn-guardar');
const metodo = document.querySelector('#metodo');

const seacrh = document.querySelector('#seacrh');

let table_clientes;

document.addEventListener('DOMContentLoaded', function () {
  $('#table_venta').DataTable({
    ajax: {
      url: ruta + 'controllers/ventasController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'codproducto' },
      { data: 'nombre' },
      { data: 'descripcion' },
      { data: 'stock_total' },
      { data: 'precio' },
      { data: 'addcart' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    }
  });

  temp()

  table_clientes = $('#table_clientes').DataTable({
    ajax: {
      url: ruta + 'controllers/ventasController.php?option=listar-clientes',
      dataSrc: ''
    },
    columns: [
      { data: 'nombre' },
      { data: 'telefono' },
      { data: 'direccion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    }
  });

  $('#table_clientes tbody').on('dblclick', 'tr', function () {
    let datos = table_clientes.row(this).data();
    id_cliente.value = datos.idcliente;
    nombre_cliente.value = datos.nombre;
    dir_cliente.value = datos.direccion;
    $('#modal-cliente').modal('hide');
  })

  btn_save.onclick = function () {
    if(nombre_cliente.value === "") {
      alert('seleccione un cliente');
      return false;
    }

    axios.post(ruta + 'controllers/ventasController.php?option=saveventa', {
      idCliente: id_cliente.value,
      metodo: metodo.value,
    })
      .then(function (response) {
        const info = response.data;
        if (info.tipo == 'success') {
          window.location = ruta + 'plantilla.php?pagina=reporte&sale=' + info.sale;
          temp();
        }
        message(info.tipo, info.mensaje);
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  

})


function addCart(codProducto) {
  const quanty = $("#cantidad-"+codProducto).val();
  
  axios.get(ruta + 'controllers/ventasController.php?option=addcart&id=' + codProducto+'&cantidad='+quanty)
    .then(function (response) {
      const info = response.data;

      if(info.tipo === 'error') {
        message('error', info.mensaje);
        return false;
      }

      message(info.tipo, info.mensaje);
      temp();
      sumaVentaCarrito();
    })
    .catch(function (error) {
      console.log(error);
    });
}

function temp() {
  axios.get(ruta + 'controllers/ventasController.php?option=listarTemp')
    .then(function (response) {
      const info = response.data;
      let tempProductos = '';
      info.forEach(pro => {
        tempProductos += `<tr>
                    <td>${pro.nombre}</td>
                    <td><input class="form-control" type="number" value="${pro.precio}" onchange="addPrecio(event, ${pro.id})" /></td>
                    <td><input class="form-control" type="number" id="cantidad-${pro.id_producto}" value="${pro.cantidad}" onchange="addCantidad(event, ${pro.id}, ${pro.id_producto})" /></td>
                    <td>0.00</td>
                    <td>${parseFloat(pro.precio) * parseInt(pro.cantidad)}</td>
                    <td><i class="fas fa-trash-alt text-danger"  onclick="deleteproducto(${pro.id})"></i></td>
                </tr>`;
      });
      table_temp.innerHTML = tempProductos;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function sumaVentaCarrito() {
  axios.get(ruta + 'controllers/ventasController.php?option=sumaVentaTemporal')
    .then(function (response) {
      const info = response.data;

      const total = document.getElementById('total');

      total.textContent = info[0].total;
      
    })
    .catch(function (error) {
      console.log(error);
    });
}

function addCantidad(e, idTemp, idProd) {
  axios.post(ruta + 'controllers/ventasController.php?option=addcantidad', {
    id: idTemp,
    cantidad: e.target.value,
    producto: idProd
  })
    .then(function (response) {
      const info = response.data;
      if (info.tipo == 'warning') {
        message('error', info.mensaje);
        $("#cantidad-"+idProd).val(info.stock);
        return;
      }

      if (info.tipo == 'error') {
        message(info.tipo, info.mensaje);
        return;
      }
      temp();
      sumaVentaCarrito();
    })
    .catch(function (error) {
      console.log(error);
    });
}

function addPrecio(e, idTemp) {
  axios.post(ruta + 'controllers/ventasController.php?option=addprecio', {
    id: idTemp,
    precio: e.target.value
  })
    .then(function (response) {
      const info = response.data;
      if (info.tipo == 'error') {
        message(info.tipo, info.mensaje);
        return;
      }
      temp();
      sumaVentaCarrito();
    })
    .catch(function (error) {
      console.log(error);
    });
}

function deleteproducto(idTemp) {
  axios.get(ruta + 'controllers/ventasController.php?option=delete&id=' + idTemp)
    .then(function (response) {
      const info = response.data;
      message(info.tipo, info.mensaje);
      temp();
      sumaVentaCarrito();
    })
    .catch(function (error) {
      console.log(error);
    });
}
document.addEventListener('click', function (event) {
  if (event.target.classList.contains('btnEliminar')) {
      let idVenta = event.target.getAttribute('data-id');

      if (confirm('¿Estás seguro de eliminar esta venta?')) {
          fetch('controllers/ventasController.php?option=delete&id=' + idVenta, {
              method: 'GET'
          })
          .then(response => response.json())
          .then(data => {
              if (data.tipo === 'success') {
                  alert('Venta eliminada correctamente');
                  location.reload();
              } else {
                  alert('Error al eliminar');
              }
          })
          .catch(error => console.log(error));
      }
  }
});