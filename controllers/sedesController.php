<?php
require_once '../models/sedes.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$sedes = new SedesModel();
switch ($option) {
    case 'listar':
        $data = $sedes->getSedes();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="deleteSede(' . $data[$i]['sede_id'] . ')"><i class="fas fa-trash-alt"></i></a>
                <a class="btn btn-warning btn-sm" onclick="editSede(' . $data[$i]['sede_id'] . ')"><i class="fas fa-edit"></i></a>
                </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $estado = $_POST['estado'];
        $id_sede = $_POST['id_sede'];
        if ($id_sede== '') {
            $consult = $sedes->comprobarNombre($nombre);
            if (empty($consult)) {
                $result = $sedes->saveSede($nombre, $direccion, $estado);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'SEDE REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'LA SEDE YA EXISTE');
            }
        } else {
            
            $result = $sedes->updateSede($nombre,  $direccion, $estado, $id_sede);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'SEDE MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $sedes->deleteSede($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'SEDE ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $sedes->getSede($id);
        echo json_encode($data);
        break;

    default:
        # code...
        break;
}
