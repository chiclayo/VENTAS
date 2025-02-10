<form id="frmProductos" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_product" name="id_product">
            <div class="row">
                <div class="col-md-2">
                    <label for="">Categoria <span class="text-danger">*</span></label>
                    <div class="input-group mb-2">
                        <select id="categoria" name="categoria" class="form-control">
                                
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Producto <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre....">
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="">Descripción <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion.....">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Precio <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="0.00">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="button" class="btn btn-success" id="btn-nuevo">Nuevo</button>
            <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <select name="sede_id" id="sede_id" class="form-control"></select>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_productos">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Descrpcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>