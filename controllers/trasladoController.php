<?php
require_once '../models/productos.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$producto = new Productos();
switch ($option) {
    case 'searchProducto':
        $name = $_POST['name'];
        $data = $producto->searchProducts($name, $_SESSION['idsede']);
        break;
    case 'listar':
        $data = $categorias->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="deleteCategoria(' . $data[$i]['idcategoria'] . ')"><i class="fas fa-trash-alt"></i></a>
                <a class="btn btn-warning btn-sm" onclick="editCategoria(' . $data[$i]['idcategoria'] . ')"><i class="fas fa-edit"></i></a>
                </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $id_categoria = $_POST['id_categoria'];
        if ($id_categoria== '') {
            $consult = $categorias->comprobarNombre($nombre);
            if (empty($consult)) {
                $result = $categorias->saveCategoria($nombre);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'CATEGORIA REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'LA CATEGORIA YA EXISTE');
            }
        } else {
            
            $result = $categorias->updateCategoria($nombre, $id_categoria);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'CATEGORIA MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $categorias->deleteCategoria($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'CATEGORIA ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $categorias->getCategoria($id);
        echo json_encode($data);
        break;

    default:
        # code...
        break;
}
