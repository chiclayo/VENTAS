<?php
require_once '../config.php';
require_once 'conexion.php';
class ProveedorModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getProveedores()
    {
        $consult = $this->pdo->prepare("SELECT * FROM proveedor WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProveedor($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM proveedor WHERE idproveedor = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarTelefono($telefono)
    {
        $consult = $this->pdo->prepare("SELECT * FROM proveedor WHERE telefono = ?");
        $consult->execute([$telefono]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function comprobarRuc($ruc)
    {
        $consult = $this->pdo->prepare("SELECT * FROM proveedor WHERE ruc = ?");
        $consult->execute([$ruc]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProveedor($nombre, $ruc, $telefono, $direccion)
    {
        $consult = $this->pdo->prepare("INSERT INTO proveedor (nombre, ruc,telefono, direccion) VALUES (?,?,?,?)");
        return $consult->execute([$nombre, $ruc, $telefono, $direccion]);
    }

    public function deleteProveedor($id)
    {
        $consult = $this->pdo->prepare("UPDATE proveedor SET status = ? WHERE idproveedor = ?");
        return $consult->execute([0, $id]);
    }

    public function updateProveedor($nombre, $ruc,$telefono, $direccion, $id)
    {
        $consult = $this->pdo->prepare("UPDATE proveedor SET nombre=?, ruc=?,telefono=?, direccion=? WHERE idproveedor=?");
        return $consult->execute([$nombre, $ruc, $telefono, $direccion, $id]);
    }
}

?>