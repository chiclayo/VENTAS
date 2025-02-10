<?php
require_once '../config.php';
require_once 'conexion.php';
class DetalleStockModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }
    public function getCategorias()
    {
        $consult = $this->pdo->prepare("SELECT * FROM categoria WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>