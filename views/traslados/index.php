<form id="frmtraslado" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_traslado" name="id_traslado">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Sede Origen <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <select id="origen_id" name="origen_id" class="form-control">
                            <option value="MOYOBAMBA">MOYOBAMBA</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Sede Destino <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <select id="traslado_id" name="traslado_id" class="form-control">
                            
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="">Buscar Producto</label>
                    <input type="text" class="form-control" id="search" name="Buscar producto" placeholder="Escribe el nombre del producto">
                    <div id="suggestions"></div>
                </div>
            
            </div>
        
        </div>
            
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_traslados">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Stock Actual</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>