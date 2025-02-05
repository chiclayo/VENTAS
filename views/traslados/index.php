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
            <div class="col-md-2">
                    <label for="">Fecha Creación <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="date" class="form-control" id="creacion_id" name="creacion_id" placeholder="">
                    </div>
                </div> 
                <div class="col-md-2">
                    <label for="">Fecha Aceptación <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="date" class="form-control" id="aceptacion_id" name="aceptacion_id" placeholder="">
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
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 100%;" id="table_traslados">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Sede Origen</th>
                        <th scope="col">Sede Destino</th>    
                        <th scope="col">Fecha Creación</th> 
                        <th scope="col">Fecha Aceptación</th>                   
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>