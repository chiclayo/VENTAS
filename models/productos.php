<?php
require_once '../config.php';
require_once 'conexion.php';
class Productos{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }
    public function getProducts()
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE codproducto = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarCategoria($categoria)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE categoria = ?");
        $consult->execute([$categoria]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProduct($categoria, $nombre,$descripcion, $precio, $stock)
    {
        $consult = $this->pdo->prepare("INSERT INTO producto (categoria,nombre, descripcion, precio, existencia) VALUES (?,?,?,?,?)");
        return $consult->execute([$categoria, $nombre,$descripcion, $precio, $stock]);
    }

    public function deleteProducto($id)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET status = ? WHERE codproducto = ?");
        return $consult->execute([0, $id]);
    }

    public function updateProduct($categoria, $nombre,$descripcion, $precio, $stock, $id)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET categoria=?, nombre=?,descripcion=?, precio=?, existencia=? WHERE codproducto=?");
        return $consult->execute([$categoria, $nombre,$descripcion, $precio, $stock, $id]);
    }
}

?>