<form id="frmUser" autocomplete="off">
    <div class="card mb-2">
        <div class="card-body">
            <input type="hidden" id="id_user" name="id_user">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Perfil <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                    <select id="perfil" name="perfil" class="form-control">
                                <option value="SELECCIONE">SELECCIONE....</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="DIRECTORA PROYECTOS">DIRECTORA PROYECTOS</option>
                                <option value="ASISTENTE">ASISTENTE</option>
                                <option value="TESORERA">TESORERA</option>
                     </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Sede <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                    <select id="sede_id" name="sede_id" class="form-control">
                            
                     </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Correo <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Contraseña <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="button" class="btn btn-outline-success" id="btn-nuevo"><i class="fas fa-plus"></i>Nuevo</button>
            <button type="submit" class="btn btn-outline-primary" id="btn-save"> <i class="fas fa-save"></i>Guardar</button>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-dark" style="width: 100%;" id="table_users">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Correo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalPermiso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar permisos</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- html permisos -->
                <form id="frmPermiso">
                    
                </form>
            </div>
        </div>
    </div>
</div>