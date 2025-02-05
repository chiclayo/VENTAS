<?php
require_once '../config.php';
require_once 'conexion.php';
class CategoriasModel{
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
       public function getCategoria($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM categoria WHERE idcategoria = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre)
    {
        $consult = $this->pdo->prepare("SELECT * FROM categoria WHERE nombre = ?");
        $consult->execute([$nombre]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
   
    public function saveCategoria($nombre)
    {
        $consult = $this->pdo->prepare("INSERT INTO categoria (nombre) VALUES (?)");
        return $consult->execute([$nombre]);
    }

    public function deleteCategoria($id)
    {
        $consult = $this->pdo->prepare("UPDATE categoria SET status = ? WHERE idcategoria = ?");
        return $consult->execute([0, $id]);
    }

    public function updateCategoria($nombre, $id)
    {
        $consult = $this->pdo->prepare("UPDATE categoria SET nombre=? WHERE idcategoria=?");
        return $consult->execute([$nombre,  $id]);
    }
}

?>