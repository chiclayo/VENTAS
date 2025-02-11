<?php
require_once '../models/productos.php';
require_once '../models/categorias.php';
require_once '../models/sedes.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$productos = new Productos();
$categorias = new CategoriasModel();
$sede = new SedesModel();
switch ($option) {
    case 'listar':
        $sede_id = $_GET['sede'];
        $data = $productos->getProducts($sede_id);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <a class="btn btn-danger btn-sm" onclick="deleteProducto(' . $data[$i]['codproducto'] . ')"><i class="fas fa-trash-alt"></i></a>
            <a class="btn btn-warning btn-sm" onclick="editProducto(' . $data[$i]['codproducto'] . ')"><i class="fas fa-edit"></i></a>
            </div>';
        }
        echo json_encode($data);
        break;
    case 'listar_reporte':
        $sede_id = $_GET['sede'];
        $data = $productos->getProducts($sede_id);
        echo json_encode($data);
        break;
    case 'save':
        $cat = $_POST['categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $id_product = $_POST['id_product'];
        

        //echo "<pre>"; print_r($_POST); exit;
        if ($id_product == '') {
            $consult = $productos->comprobarNombre($nombre);
            if (empty($consult)) {
                $result = $productos->saveProduct($cat, $nombre,$descripcion, $precio);
                if ($result > 0) {
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL PRODUCTO YA EXISTE');
            }
        } else {
            $result = $productos->updateProduct($cat, $nombre,$descripcion, $precio, $id_product);
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
    case 'categorias':
        $cat = $categorias->getCategorias();
        echo json_encode($cat);
        break;
    case 'sedes':
        $sedes = $sede->getSedes();
        echo json_encode($sedes);
        break;
    default:
        # code...
        break;
}
