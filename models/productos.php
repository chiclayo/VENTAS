<?php
require_once '../config.php';
require_once 'conexion.php';
class Productos{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }
    public function getProducts($sede)
    {
        if($sede == 0) {
            $consult = $this->pdo->prepare("SELECT LPAD(p.codproducto, 4, '0') as codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, SUM(dss.stock) AS stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 GROUP BY p.codproducto, p.nombre, c.nombre, p.precio ");
            $consult->execute();
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $consult = $this->pdo->prepare("SELECT LPAD(p.codproducto, 4, '0') as codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, dss.stock as stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 and dss.id_sede = $sede  AND dss.stock > 0 ");
            $consult->execute();
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

    public function getProduct($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE codproducto = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function searchProducts($name, $sede)
    {
        $consult = $this->pdo->prepare("SELECT p.codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, dss.stock as stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 and dss.id_sede = $sede and p.nombre like '%$name%'");
        $consult->execute([$sede,$name]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comprobarNombre($nombre)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE nombre = ?");
        $consult->execute([$nombre]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProduct($categoria, $nombre,$descripcion, $precio)
    {

        $this->pdo->beginTransaction(); // Iniciar transacción para evitar inconsistencias
    
        try {
            // Insertar en la tabla producto
            $consult = $this->pdo->prepare("INSERT INTO producto (idcategoria, nombre, descripcion, precio) VALUES (?, ?, ?, ?)");
            $consult->execute([$categoria, $nombre, $descripcion, $precio]);

            $producto_id = $this->pdo->lastInsertId();

            $consult2 = $this->pdo->prepare("SELECT * FROM sede WHERE estado = 'ACTIVO' ");
            $consult2->execute();
            $sedes =  $consult2->fetchAll(PDO::FETCH_ASSOC);

            foreach ($sedes as $key => $value) {
                //$this->saveDetalleStockInicial($producto_id, $value['sede_id']);
                $consultStock = $this->pdo->prepare("INSERT INTO detalle_stock_sede (id_producto, id_sede, stock) VALUES (?, ?, ?)");
                $consultStock->execute([$producto_id, $value['sede_id'], 0]);
            }

            $this->pdo->commit();
 
            return $producto_id;

        } catch (Exception $e) {
            $this->pdo->rollBack(); // Revertir cambios en caso de error
            return false; // Retornar false si ocurre un error
        }
    }

    public function saveDetalleStockInicial($idproducto, $sede_id)
    {
        $consultStock = $this->pdo->prepare("INSERT INTO detalle_stock_sede (id_producto, id_sede, stock) VALUES (?, ?, ?)");
        return $consultStock->execute([$idproducto, $sede_id, 0]);
    }

    public function deleteProducto($id)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET status = ? WHERE codproducto = ?");
        return $consult->execute([0, $id]);
    }

    public function updateProduct($cat, $nombre,$descripcion, $precio, $id_product)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET idcategoria=?, nombre=?,descripcion=?, precio=? WHERE codproducto=?");
        return $consult->execute([$cat, $nombre,$descripcion, $precio,  $id_product]);
    }
}

?>