<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Estudiantes Bloqueados</h1>
            </div>
        </div>
    </div>
</div>      
       
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
            <table id="list_blocked_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cod Ceta</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Genero</th>
                    <th>Bloqueado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="modal fade show" id="modalUnblock" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>                       
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" id="contenido_mensages"> 
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="tipo_accion" >
                <input type="hidden" id="cod_ceta_sel" >
                <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_eliminar" class="btn btn-primary" data-dismiss="modal" onclick="realizarAccion()">Aceptar</button>
            </div>
        </div>
    </div>
</div>