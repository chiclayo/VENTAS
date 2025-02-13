<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos por Sede</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h3 class="text-center">Reporte de Productos por Sede</h3>

        <input type="hidden" name="sede" id="sede" value="<?= $_SESSION['idsede'] ?>">

        <!-- Botones de acción -->
        <div class="d-flex justify-content-center mt-3">
            <a id="btnPDF" class="btn btn-danger me-2" target="_blank">
                <i class="fas fa-file-pdf"></i> Generar PDF
            </a>
        </div>

        <!-- Tabla de Vista Previa -->
        <div class="mt-4">
            <table class="table table-bordered text-center" id="tablaReporte">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>CategorÍa</th>
                        <th>ProductoS</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se mostrarán los datos -->
                </tbody>
            </table>
        </div>
    </div>