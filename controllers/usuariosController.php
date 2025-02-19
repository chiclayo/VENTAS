<?php
require_once '../models/usuarios.php';
require_once '../models/sedes.php';
require_once '../models/perfil.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$usuarios = new UsuariosModel();
$sedes = new SedesModel();
$perfil = new PerfilModel();
switch ($option) {
    case 'acceso':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $email = $array['email'];
        $password = $array['password'];
        $result = $usuarios->getLogin($email);
        if (empty($result)) {
            $res = array('tipo' => 'error', 'mensaje' => 'EMAIL NO EXISTE');
        } else {
            if (password_verify($password, $result['clave'])) {
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['correo'] = $result['correo'];
                $_SESSION['idusuario'] = $result['idusuario'];
                $_SESSION['idperfil'] = $result['perfil'];
                $_SESSION['idsede'] = $result['sede_id'];
                $res = array('tipo' => 'success', 'mensaje' => 'ok');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'CONTRASEÑA INCORRECTA');
            }
        }
        echo json_encode($res);
        break;

    case 'sedes': 
        $data = $sedes->getSedes();
        echo json_encode($data);
        break;
    case 'perfiles': 
        $data = $perfil->getPerfiles();
        echo json_encode($data);
        break;
    case 'listar':
        $data = $usuarios->getUsers();
        for ($i = 0; $i < count($data); $i++) {

            $delete = "";

            if($data[$i]['idusuario'] != 1) {
                $delete = '<a class="btn btn-outline-danger mx-1 btn-sm" onclick="deleteUser(' . $data[$i]['idusuario'] . ')"><i class="fas fa-trash-alt"></i></a>';
            }

            $data[$i]['accion'] = '<div class="d-flex">
                '.$delete.'
                <a class="btn btn-outline-info  mx-1 btn-sm" onclick="editUser(' . $data[$i]['idusuario'] . ')"><i class="fas fa-edit"></i></a>
                <a class="btn btn-outline-dark btn-sm" onclick="permisos(' . $data[$i]['idusuario'] . ')"><i class="fas fa-lock"></i></a>
                </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $sede_id = $_POST['sede_id'];
        $perfil = $_POST['perfil'];
        $clave = $_POST['clave'];
        $id_user = $_POST['id_user'];
        if ($id_user == '') {
            $consult = $usuarios->comprobarCorreo($correo);
            if (empty($consult)) {
                $hash = password_hash($clave, PASSWORD_DEFAULT);
                $result = $usuarios->saveUser($nombre, $correo, $hash, $perfil, $sede_id);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'USUARIO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CORREO YA EXISTE');
            }
        } else {
            $result = $usuarios->updateUser($nombre, $perfil, $correo, $sede_id, $id_user);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'USUARIO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $usuarios->deleteUser($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'USUARIO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $usuarios->getUser($id);
        echo json_encode($data);
        break;
    case 'permisos':
        $id = $_GET['id'];
        $data['permisos'] = $usuarios->getPermisos();
        $consulta = $usuarios->getDetalle($id);
        $datos = array();
        foreach ($consulta as $asignado) {
            $datos[$asignado['id_permiso']] = true;
        }
        $data['asig'] = $datos;
        echo json_encode($data);
        break;

    case 'savePermiso':
        $id_user = $_POST['id_usuario'];
        $usuarios->eliminarPermisos($id_user);
        $res = true;
        if (!empty($_POST['permisos'])) {
            for ($i = 0; $i < count($_POST['permisos']); $i++) {
                $res = $usuarios->savePermiso($_POST['permisos'][$i], $id_user);
            }
            if ($res) {
                $res = array('tipo' => 'success', 'mensaje' => 'PERMISOS ASIGNADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR LOS PERMISOS');
            }
            
        }
        echo json_encode($res);
        break;

    default:
        # code...
        break;
}
