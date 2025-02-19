<?php
require_once 'config.php';
require_once 'controllers/plantillaController.php';
$plantilla = new Plantilla();
##### PERMISOS #####

require_once 'models/permisos.php';
$id_user = $_SESSION['idusuario'];
$permisos = new PermisosModel();
$configuracion = $permisos->getPermiso(1, $id_user);
$usuarios = $permisos->getPermiso(2, $id_user);
$clientes = $permisos->getPermiso(3, $id_user);
$productos = $permisos->getPermiso(4, $id_user);
$ventas = $permisos->getPermiso(5, $id_user);
$nueva_venta = $permisos->getPermiso(6, $id_user);
$compras = $permisos->getPermiso(7, $id_user);
$nueva_compra = $permisos->getPermiso(8, $id_user);
$proveedor = $permisos->getPermiso(9, $id_user);
$categorias = $permisos->getPermiso(10, $id_user);
$sedes = $permisos->getPermiso(11, $id_user);
$traslados = $permisos->getPermiso(14, $id_user);
$cajas = $permisos->getPermiso(15, $id_user);
$reportes = $permisos->getPermiso(16, $id_user);
$reportesPdf = $permisos->getPermiso(16, $id_user);

##### FIN PERMISOS ####
require_once 'views/includes/header.php';
if (isset($_GET['pagina'])) {
    if (empty($_GET['pagina'])) {
        $plantilla->index();
    }else{
        try {
            $archivo = $_GET['pagina'];
            if ($archivo == 'usuarios' && !empty($usuarios)) {
                $plantilla->usuarios();
            } else if ($archivo == 'configuracion' && !empty($configuracion)) {
                $plantilla->configuracion();
            } else if ($archivo == 'clientes' && !empty($clientes)) {
                $plantilla->clientes();
            } else if ($archivo == 'proveedor' && !empty($proveedor)) {
                $plantilla->proveedor();
            }else if ($archivo == 'productos' && !empty($productos)) {
                $plantilla->productos();
            } else if ($archivo == 'ventas' && !empty($nueva_venta)) {
                $plantilla->ventas();
            } else if ($archivo == 'historial' && !empty($ventas)) {                
                $plantilla->historial();
            } else if ($archivo == 'reporte' && !empty($ventas)) {
                $plantilla->reporte();
            } else if ($archivo == 'compras' && !empty($nueva_compra)) {
                $plantilla->compras();
            } else if ($archivo == 'historial_compras' && !empty($ventas)) {
                $plantilla->historial_compras();
            } else if ($archivo == 'reporte_compra' && !empty($compras)) {
                $plantilla->reporte_compra();
            } else if ($archivo == 'sedes' && !empty($sedes)) {
                $plantilla->sedes();         
            }else if ($archivo == 'categorias' && !empty($categorias)) {
                $plantilla->categorias();
            }else if ($archivo == 'traslados' && !empty($traslados)) {
                $plantilla->traslados();    
            }else if ($archivo == 'perfiles' && !empty($perfiles)) {
                $plantilla->perfiles();   
            }else if ($archivo == 'reportes' && !empty($reportes)) {
                $plantilla->reportes();
            }else if ($archivo == 'reportePdf' && !empty($reportesPdf)) {
                $plantilla->reportesPdf(); 
            }else if ($archivo == 'cajas' && !empty($cajas)) {
                $plantilla->cajas(); 
                
            } else{ 
            
                               
                $plantilla->notFound();
            }          
        } catch (\Throwable $th) {            
            $plantilla->notFound();
        }
    }
}else{
    $plantilla->index(); 
}
require_once 'views/includes/footer.php';
?>