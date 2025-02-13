<?php
require_once 'conexion.php';
class Reporte
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }
    public function getConfiguracion()
    {
        $consult = $this->pdo->prepare("SELECT * FROM configuracion");
        $consult->execute();
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function getSale($id_venta)
    {
        $consult = $this->pdo->prepare("SELECT v.*, c.* FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente WHERE v.id = ?");
        $consult->execute([$id_venta]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsVenta($id_venta)
    {
        $consult = $this->pdo->prepare("SELECT d.*, p.nombre FROM detalle_ventas d INNER JOIN ventas v ON d.id_venta = v.id INNER JOIN producto p ON d.id_producto = p.codproducto WHERE v.id = ?");
        $consult->execute([$id_venta]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsCompra($id_compra)
    {
        $consult = $this->pdo->prepare("SELECT d.*, p.nombre FROM detalle_compras d INNER JOIN compras c ON d.id_compra = c.id INNER JOIN producto p ON d.id_producto = p.codproducto WHERE c.id = ?");
        $consult->execute([$id_compra]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getShoping($id_compra)
    {
        $consult = $this->pdo->prepare("SELECT c.*, p.* FROM compras c INNER JOIN proveedor p ON c.id_proveedor = p.idproveedor WHERE c.id = ?");
        $consult->execute([$id_compra]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function getProducts($sede)
    {
        if($sede == 0) {
            $consult = $this->pdo->prepare("SELECT p.codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, SUM(dss.stock) AS stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 GROUP BY p.codproducto, p.nombre, c.nombre, p.precio ");
            $consult->execute();
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $consult = $this->pdo->prepare("SELECT p.codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, dss.stock as stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 and dss.id_sede = $sede  AND dss.stock > 0 ");
            $consult->execute();
            return $consult->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

}
