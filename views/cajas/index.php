<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ingresos - Módulo Caja</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Reporte de Ingresos por Sede</h2>

        <input type="hidden" id="idperfil" value="<?= $_SESSION['idperfil'] ?>">
        <input type="hidden" id="idsede" value="<?= $_SESSION['idsede'] ?>">
        <!-- Formulario de Filtro -->
        <form id="filterForm">
            <div class="row">
                <div class="col-md-3">
                    <label for="fecha_inicio">Fecha Inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                </div>
                     <div class="col-md-3">
                          <label for="fecha_fin">Fecha Fin</label>
                          <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                      </div>
                 <div class="col-md-3 mb-6">
                     <label for="sede" class="form-label">Selecciona una sede:</label>
                         <select id="sede_id" class="form-control" name= "sede_id" required>
                  
                         </select>
                 </div>
                        <button type="submit" class="btn btn-outline-primary mt-4">Generar Reporte</button>
            </div>  

        </form>

        <hr>

        <!-- Tabla para mostrar los resultados -->
        <h4>Resultados</h4>
        <table id="ingresosTable" class="table table-bordered table-striped text-dark">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Sede</th>
                    <th>Método de Pago</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <!-- Aquí se llenarán los resultados de la consulta -->
            </tbody>
        </table>
    </div>