<?php
require_once '../config.php';
require_once 'conexion.php';
class Ventas{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getProducts($sede)
    {
        $consult = $this->pdo->prepare("SELECT p.codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, dss.stock as stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 and dss.id_sede = $sede");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($cve, $idsede)
    {
        $consult = $this->pdo->prepare("SELECT p.codproducto, p.nombre, p.descripcion, c.nombre as nameCategoria, p.precio, dss.stock as stock_total, p.status FROM producto p LEFT JOIN categoria c on c.idcategoria = p.idcategoria LEFT JOIN detalle_stock_sede dss ON p.codproducto = dss.id_producto WHERE p.status = 1 and dss.id_sede = ? and p.codproducto = ? ");
        $consult->execute([$idsede, $cve]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function addTemp($id_user, $id_product, $cantidad, $precio)
    {
        $consult = $this->pdo->prepare("INSERT INTO temp_ventas (id_usuario, id_producto, cantidad, precio) VALUES (?,?,?,?)");
        return $consult->execute([$id_user, $id_product, $cantidad, $precio]);
    }

    public function getProductsUsers($id_user)
    {
        $consult = $this->pdo->prepare("SELECT temp.*, pro.nombre, pro.codproducto FROM temp_ventas temp INNER JOIN producto pro ON temp.id_producto = pro.codproducto WHERE temp.id_usuario = ?");
        $consult->execute([$id_user]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sumaVentaTemporal($id_user)
    {
        $consult = $this->pdo->prepare("SELECT SUM(cantidad * precio) as total FROM temp_ventas WHERE id_usuario = ?");
        $consult->execute([$id_user]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCantidad($cantidad, $id)
    {
        $consult = $this->pdo->prepare("UPDATE temp_ventas SET cantidad = ? WHERE id = ?");
        return $consult->execute([$cantidad, $id]);
    }

    public function updatePrecio($precio, $id)
    {
        $consult = $this->pdo->prepare("UPDATE temp_ventas SET precio = ? WHERE id = ?");
        return $consult->execute([$precio, $id]);
    }

    public function getTemp($id_product, $id_user)
    {
        $consult = $this->pdo->prepare("SELECT * FROM temp_ventas WHERE id_producto = ? AND id_usuario = ?");
        $consult->execute([$id_product, $id_user]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function upadteTemp($cantidad, $id_product, $id_user)
    {
        $consult = $this->pdo->prepare("UPDATE temp_ventas SET cantidad = ? WHERE id_producto = ? AND id_usuario = ?");
        return $consult->execute([$cantidad, $id_product, $id_user]);
    }

    public function getClients()
    {
        $consult = $this->pdo->prepare("SELECT * FROM cliente WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveVenta($id_cliente, $total, $metodo, $fecha, $id_user, $id_sede)
    {
        $consult = $this->pdo->prepare("INSERT INTO ventas (id_cliente, total, metodo, fecha, id_usuario, id_sede) VALUES (?, ?,?,?,?,?)");
        $consult->execute([$id_cliente, $total, $metodo, $fecha, $id_user, $id_sede]);
        return $this->pdo->lastInsertId();
    }

    public function saveDetalle($id_producto, $id_venta, $cantidad, $precio)
    {
        $consult = $this->pdo->prepare("INSERT INTO detalle_ventas (id_producto, id_venta, cantidad, precio) VALUES (?,?,?,?)");
        return $consult->execute([$id_producto, $id_venta, $cantidad, $precio]);
    }

    public function deleteTemp($id_user)
    {
        $consult = $this->pdo->prepare("DELETE FROM temp_ventas WHERE id_usuario = ?");
        return $consult->execute([$id_user]);
    }

    public function getSales($sede)
    {
        $consult = $this->pdo->prepare("SELECT v.*, c.nombre FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente where v.id_sede = ? ");
        $consult->execute([$sede]);
        return $consult->fetchAll();
    }

    public function getSalesCaja($desde, $hasta, $sede)
    {
        $consult = $this->pdo->prepare("SELECT v.*, c.nombre, s.nombre as nameSede FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente INNER JOIN sede s ON s.sede_id = v.id_sede where v.id_sede = ? AND v.fecha BETWEEN ? AND ? ");
        $consult->execute([$sede, $desde, $hasta]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsVenta($id_venta)
    {
        $consult = $this->pdo->prepare("SELECT d.*, p.nombre FROM detalle_ventas d INNER JOIN ventas v ON d.id_venta = v.id INNER JOIN producto p ON d.id_producto = p.codproducto WHERE v.id = ?");
        $consult->execute([$id_venta]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBarcode($barcode)
    {
        $consult = $this->pdo->prepare("SELECT * FROM producto WHERE codigo = ?");
        $consult->execute([$barcode]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProducto($idTemp)
    {
        $consult = $this->pdo->prepare("DELETE FROM temp_ventas WHERE id = ?");
        return $consult->execute([$idTemp]);
    }
    public function updateStock($stock, $id_producto)
    {
        $consult = $this->pdo->prepare("UPDATE producto SET existencia = ? WHERE codproducto = ?");
        return $consult->execute([$stock, $id_producto]);
    }

    public function deleteVenta($idVenta)
   {
        $consult = $this->pdo->prepare("DELETE FROM ventas WHERE id = ?");
        return $consult->execute([$idVenta]);
   }
}

?>