<?php
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
require_once '../models/ventas.php';
$ventas = new Ventas();
$id_user = $_SESSION['idusuario'];
switch ($option) {
    case 'listar':
        $result = $ventas->getProducts();
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['addcart'] = '<a href="#" class="btn btn-primary btn-sm" onclick="addCart(' . $result[$i]['codproducto'] . ')"><i class="fas fa-cart-plus"></i></a>';
            if ($result[$i]['precio'] > 10) {
                $result[$i]['precio'] = '<span class="badge badge-info">'.$result[$i]['precio'].'</span>';
            } else {
                $result[$i]['precio'] = '<span class="badge badge-warning">'.$result[$i]['precio'].'</span>';
            }           
            
        }
        echo json_encode($result);
        break;
    case 'addcart':
        $cve = $_GET['id'];
        $cant = $_GET['cantidad'];
        $result = $ventas->getProduct($cve);
        $id_product = $result['codproducto'];
        $existencia = $result['precio'];
        $cantidad = 1;
        $precio = $result['precio'];
        $consult = $ventas->getTemp($id_product, $id_user);

        if($existencia <= 0) {
            $res = array('tipo' => 'error', 'mensaje' => 'PRODUCTO NO TIENE STOCK');
            echo json_encode($res);
            exit;
        }

        if (empty($consult)) {
            $temp = $ventas->addTemp($id_user, $id_product, $cantidad, $precio);
            if ($temp) {
                $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO AGREGADO AL CARRITO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
            }
        } else {
            $cantidad = $consult['cantidad'] + 1;

            if($existencia == $cant) {
                $res = array('tipo' => 'error', 'mensaje' => 'YA NO SE PUEDE AGREGAR MAS STCOK');
                echo json_encode($res); exit;
            }

            $temp = $ventas->upadteTemp($cantidad, $id_product, $id_user);
            if ($temp) {
                $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO INCREMENTADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
            }
        }

        echo json_encode($res);
        break;
    case 'sumaVentaTemporal':
        $result = $ventas->sumaVentaTemporal($id_user);
        echo json_encode($result);
        break;
    case 'listarTemp':
        $result = $ventas->getProductsUsers($id_user);
         for ($i = 0; $i < count($result); $i++) {
            $result[$i]['addcart'] = '<a href="#" onclick="addCart(' . $result[$i]['codproducto'] . ')"><i class="fas fa-cart-plus"></i></a>';
         }
        echo json_encode($result);
        break;
    case 'addcantidad':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $idTemp = $array['id'];
        $cantidad = $array['cantidad'];
        $idproducto = $array['producto'];
        $prod = $ventas->getProduct($idproducto);

        $existencia = $prod['existencia'];

        if($cantidad > $existencia) {
            $res = array('tipo' => 'warning', 'mensaje' => 'LA CANTIDAD SUPERA AL STOCK', 'stock' => $existencia);
            echo json_encode($res);
            exit;
        }

        $result = $ventas->updateCantidad($cantidad, $idTemp);
        if ($result) {
            $res = array('tipo' => 'success', 'mensaje' => 'ok');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
        }
        echo json_encode($res);
        break;
    case 'addprecio':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $idTemp = $array['id'];
        $precio = $array['precio'];
        $result = $ventas->updatePrecio($precio, $idTemp);
        if ($result) {
            $res = array('tipo' => 'success', 'mensaje' => 'ok');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
        }
        echo json_encode($res);
        break;
    case 'listar-clientes':
        $result = $ventas->getClients();
        echo json_encode($result);
        break;
    case 'saveventa':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $id_cliente = $array['idCliente'];
        $metodo = $array['metodo'];
        $fecha = date('Y-m-d');
        $consult = $ventas->getProductsUsers($id_user);
        if (empty($consult)) {
            $res = array('tipo' => 'error', 'mensaje' => 'CARRITO VACIO');
        } else {
            $total = 0.00;
            foreach ($consult as $temp) {
                $total += $temp['cantidad'] * $temp['precio'];
            }
            $sale = $ventas->saveVenta($id_cliente, $total, $metodo, $fecha, $id_user);
            if ($sale > 0) {
                foreach ($consult as $temp) {
                    $ventas->saveDetalle($temp['id_producto'], $sale, $temp['cantidad'], $temp['precio']);
                    $producto = $ventas->getProduct($temp['id_producto']);
                    $stock = $producto['existencia'] - $temp['cantidad'];
                    $ventas->updateStock($stock, $temp['id_producto']);
                }
                $ventas->deleteTemp($id_user);
                $res = array('tipo' => 'success', 'mensaje' => 'ok', 'sale' => $sale);
            } else {
                $res = array('tipo' => 'success', 'mensaje' => 'error');
            }
        }
        echo json_encode($res);

        break;
    case 'historial':
        $historial = $ventas->getSales();
        for ($i = 0; $i < count($historial); $i++) {
            $historial[$i]['producto'] = '';
            $productos = $ventas->getProductsVenta($historial[$i]['id']);
            foreach ($productos as $producto) {
                $historial[$i]['producto'] .= '<li>' . $producto['nombre'] . '</li>';
            }
            $historial[$i]['accion'] = '
            <a href="?pagina=reporte&sale=' . $historial[$i]['id'] . '" class="btn btn-primary btn-sm">
                <i class="fas fa-file-pdf"></i> 
            </a>
            <button class="btn btn-danger btn-sm btnEliminar " data-id="' . $historial[$i]['id'] . '">
                <i class="fas fa-trash-alt"></i> 
            </button>';
                    }
        echo json_encode($historial);
        break;
    case 'searchbarcode':
        $barcode = $_GET['barcode'];
        $producto = $ventas->getBarcode($barcode);
        if (empty($producto)) {
            $res = array('tipo' => 'error', 'mensaje' => 'PRODUCTO NO EXISTE');
        } else {
            $consult = $ventas->getTemp($producto['codproducto'], $id_user);
            if (empty($consult)) {
                $cantidad = 1;
                $temp = $ventas->addTemp($id_user, $producto['codproducto'], $cantidad, $producto['precio']);
                if ($temp) {
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO AGREGADO AL CARRITO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $cantidad = $consult['cantidad'] + 1;
                $temp = $ventas->upadteTemp($cantidad, $producto['codproducto'], $id_user);
                if ($temp) {
                    $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO INCREMENTADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            }
        }

        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $temp = $ventas->deleteProducto($id);
        if ($temp) {
            $res = array('tipo' => 'success', 'mensaje' => 'PRODUCTO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;

   case 'delete':
            if (!empty($_GET['id'])) {
                $idVenta = $_GET['id'];
                $result = $ventas->deleteVenta($idVenta);
                
                if ($result) {
                    echo json_encode(['tipo' => 'success', 'mensaje' => 'Venta eliminada']);
                } else {
                    echo json_encode(['tipo' => 'error', 'mensaje' => 'Error al eliminar']);
                }
            }
            break;
    case 'logout':
        session_destroy();
        header('Location: ../');
        break;
    default:
        # code...
        break;
}
