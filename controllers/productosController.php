<?php
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
require_once '../models/productos.php';
$productos = new Productos();
switch ($option) {
    case 'listar':
        $data = $productos->getProducts();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <a class="btn btn-danger btn-sm" onclick="deleteProducto(' . $data[$i]['codproducto'] . ')"><i class="fas fa-eraser"></i></a>
            <a class="btn btn-primary btn-sm" onclick="editProducto(' . $data[$i]['codproducto'] . ')"><i class="fas fa-edit"></i></a>
            </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $categoria = $_POST['categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $id_product = $_POST['id_product'];

        //echo "<pre>"; print_r($_POST); exit;
        if ($id_product == '') {
            $consult = $productos->comprobarCategoria($categoria);
            if (empty($consult)) {
                $result = $productos->saveProduct($categoria, $nombre,$descripcion, $precio, $stock);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL BARCODE YA EXISTE');
            }
        } else {
            $result = $productos->updateProduct($categoria, $nombre,$descripcion, $precio, $stock, $id_product);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $productos->deleteProducto($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $productos->getProduct($id);
        echo json_encode($data);
        break;
    default:
        # code...
        break;
}
