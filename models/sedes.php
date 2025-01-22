<?php
require_once '../config.php';
require_once 'conexion.php';
class ClientesModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getSedes()
    {
        $consult = $this->pdo->prepare("SELECT * FROM sede WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSede($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM cliente WHERE sede_id = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre)
    {
        $consult = $this->pdo->prepare("SELECT * FROM cliente WHERE nombre = ?");
        $consult->execute([$nombre]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveCliente($nombre, $direccion,$estado)
    {
        $consult = $this->pdo->prepare("INSERT INTO cliente (nombre, telefono, direccion) VALUES (?,?,?)");
        return $consult->execute([$nombre, $direccion, $estado]);
    }

    public function deleteCliente($id)
    {
        $consult = $this->pdo->prepare("UPDATE cliente SET status = ? WHERE idcliente = ?");
        return $consult->execute([0, $id]);
    }

    public function updateCliente($nombre, $telefono, $direccion, $id)
    {
        $consult = $this->pdo->prepare("UPDATE cliente SET nombre=?, telefono=?, direccion=? WHERE idcliente=?");
        return $consult->execute([$nombre, $telefono, $direccion, $id]);
    }
}

?>