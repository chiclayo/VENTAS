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
        $consult = $this->pdo->prepare("SELECT producto.codproducto,  producto.nombre, producto.descripcion, producto.precio,producto.status, categoria.nombre as nameCategoria FROM producto LEFT JOIN categoria ON categoria.idcategoria = producto.idcategoria WHERE producto.status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE codproducto = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE nombre = ?");
        $consult->execute([$nombre]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProduct($categoria, $nombre,$descripcion, $precio)
    {
        $consult = $this->pdo->prepare("INSERT INTO producto (idcategoria,nombre, descripcion, precio) VALUES (?,?,?,?)");
        return $consult->execute([$categoria, $nombre,$descripcion, $precio]);
    }

    public function deleteProducto($id)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET status = ? WHERE codproducto = ?");
        return $consult->execute([0, $id]);
    }

    public function updateProduct($categoria, $nombre,$descripcion, $precio, $stock, $id)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET idcategoria=?, nombre=?,descripcion=?, precio=?, existencia=? WHERE codproducto=?");
        return $consult->execute([$categoria, $nombre,$descripcion, $precio, $stock, $id]);
    }
}

?>