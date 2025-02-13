<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <input type="hidden" id="profile" value="<?= $_SESSION['idperfil'] ?>">
            <?php if($_SESSION['idperfil'] == 1) { ?>
            <div class="form-group">
                <label for="sede">Sede</label>
                <select name="sede" id="sede" class="form-control">

                </select>
            </div>
            <?php } else { ?>
                <input type="hidden" name="sede" id="sede" value="<?= $_SESSION['idsede'] ?>">
            <?php } ?>
            
            <div class="form-group">
                <label for="desde">Desde</label>
                <input id="desde" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="hasta">Hasta</label>
                <input id="hasta" class="form-control" type="text">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_ventas">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Clientes</th>
                        <th scope="col">Metodo</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>