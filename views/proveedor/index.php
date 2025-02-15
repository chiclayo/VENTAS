<form id="frmProveedor" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_proveedor" name="id_proveedor">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nombre /Razón Social <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Ruc <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="number" class="form-control" id="ruc" name="ruc" placeholder="Numero Documento">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Teléfono <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
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
        <div class="card-footer text-right">
            <button type="button" class="btn btn-outline-success" id="btn-nuevo"> <i class="fas fa-plus"></i>Nuevo</button>
            <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_proveedores">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ruc</th>
                        <th scope="col">teléfono</th>
                        <th scope="col">Dirección</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>