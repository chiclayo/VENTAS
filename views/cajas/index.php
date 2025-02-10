<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ingresos - Módulo Caja</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Reporte de Ingresos por Sede</h2>

        <!-- Formulario de Filtro -->
        <form id="filterForm">
            <div class="row">
                <div class="col-md-3">
                    <label for="fecha_inicio">Fecha Inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin">Fecha Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="sede">Sede</label>
                    <select id="sede" name="sede" class="form-control">
                         <option value="">Seleccione...</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="metodo_pago">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" class="form-control">
                        <option value="">Seleccione un método</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="yape">Yape</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Generar Reporte</button>
        </form>

        <hr>

        <!-- Tabla para mostrar los resultados -->
        <h4>Resultados</h4>
        <table id="ingresosTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Sede</th>
                    <th>Método de Pago</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los resultados de la consulta -->
            </tbody>
        </table>
    </div>