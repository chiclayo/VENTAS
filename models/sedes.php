<?php
require_once '../config.php';
require_once 'conexion.php';
class SedesModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getSedes()
    {
        $consult = $this->pdo->prepare("SELECT * FROM sede WHERE estado = 'ACTIVO'");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSede($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM sede WHERE sede_id = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre)
    {
        $consult = $this->pdo->prepare("SELECT * FROM sede WHERE nombre = ?");
        $consult->execute([$nombre]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveSede($nombre, $direccion,$estado)
    {
        $consult = $this->pdo->prepare("INSERT INTO sede (nombre, direccion,estado) VALUES (?,?,?)");
        return $consult->execute([$nombre, $direccion, $estado]);
    }

    public function deleteSede($id)
    {
        $consult = $this->pdo->prepare("UPDATE sede SET estado = ? WHERE sede_id = ?");
        return $consult->execute([0, $id]);
    }

    public function updateSede($nombre, $direccion, $estado, $id)
    {
        $consult = $this->pdo->prepare("UPDATE sede SET nombre=?, direccion=?, estado=? WHERE sede_id=?");
        return $consult->execute([$nombre, $direccion, $estado, $id]);
    }

    public function sedesPerfil($idperfil)
    {
        if($idperfil == 1) {
            $consult = $this->pdo->prepare("SELECT * FROM sede WHERE estado = 'ACTIVO'");
            $consult->execute();
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sede_id = $_SESSION['idsede'];
            $consult = $this->pdo->prepare("SELECT * FROM sede WHERE sede_id = ?");
            $consult->execute([$sede_id]);
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

?>