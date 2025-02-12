<?php
class Plantilla{
    //pagina principal
    public function index()
    {
        include_once 'views/principal.php';
    }
    //pagina clientes
    public function clientes()
    {
        include_once 'views/clientes/index.php';
    }
    //pagina usuarios
    public function usuarios()
    {
        include_once 'views/usuarios/index.php';
    }
    //pagina configuracion
    public function configuracion()
    {
        include_once 'views/usuarios/configuracion.php';
    }
    //pagina ventas
    public function ventas()
    {
        include_once 'views/ventas/index.php';
    }
    //vista reporte ticket
    public function reporte()
    {
        include_once 'views/ventas/reporte.php';
    }
    //historial ventas
    public function historial()
    {
        include_once 'views/ventas/historial.php';
    }
    //##########productos
    public function productos()
    {
        include_once 'views/productos/index.php';
    }

    public function notFound()
    {
        include_once 'views/errors.php';
    }

    public function proveedor()
    {
        include_once 'views/proveedor/index.php';
    }

    ###### compras
    public function compras()
    {
        include_once 'views/compras/index.php';
    }
    //vista reporte ticket
    public function reporte_compra()
    {
        include_once 'views/compras/reporte.php';
    }
    //historial ventas
    public function historial_compras()
    {
        include_once 'views/compras/historial.php';
    }
    public function sedes()
    {
        include_once 'views/sedes/index.php';
    }
    public function categorias()
    {
        include_once 'views/categorias/index.php';
    }   
     public function traslados()
    {
        include_once 'views/traslados/index.php';
    }     
    public function perfiles()
    {
        include_once 'views/perfiles/index.php';
    }     
    public function reportes()
    {
        if($_SESSION['idperfil'] == 1) {
            include_once 'views/reportes/index.php';
        } else {
            include_once 'views/reportes/userSede.php';
        }
        
    }
    public function reportesPdf()
    {
        include_once 'views/productos/reporte.php';
        
    }     
    public function cajas()
    {
        include_once 'views/cajas/index.php';
    }
}
?>
