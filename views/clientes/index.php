<form id="frmCliente" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_cliente" name="id_cliente">
            <div class="row">
                <div class="col-md-4">
                    <label for="" class="fw-bold">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">DNI/RUC <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="number" class="form-control" id="tipo_documento" name="tipo_documento" placeholder="Documento">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Telefono <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Dirección <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="button" class="btn btn-outline-success" id="btn-nuevo"> <i class="fas fa-plus"></i>Nuevo</button>
            <button type="submit" class="btn btn-outline-primary" id="btn-save"> <i class="fas fa-save"></i>Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-dark" style="width: 100%;"    id="table_clientes">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">DNI/RUC</th>
                        <th scope="col">telefono</th>
                        <th scope="col">Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>