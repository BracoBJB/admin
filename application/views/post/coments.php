<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Comentarios</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
            <!--
                <ol class="breadcrumb text-right">
                    <a class="btn btn-primary"  href="<?= base_url()?>blog/post"><i class="fa fa-plus"></i> Agregar Publicación</a>
                </ol>
                -->
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

                <!--
                <textarea name="txtArea" id="txtArea" cols="30" class="w-100" rows="10"></textarea>

                <span class='label label-warning'>Pendiente</span>
                -->
                
            <table id="tbl_coments" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width:5%;background-color:#006699;color: white;">ID</th>
                    <th style="width:15%;background-color:#006699;color: white;">Post</th>
                    <th style="width:10%;background-color:#006699;color: white;">Cod Est</th>
                    <th style="width:10%;background-color:#006699;color: white;">Nombre</th>
                    <th style="width:25%;background-color:#006699;color: white;">Contenido</th>
                    <th style="width:15%;background-color:#006699;color: white;">Fecha</th>
                    <th style="width:5%;background-color:#006699;color: white;">Res</th>
                    <th style="width:5%;background-color:#006699;color: white;">Verificado</th>
                    <th style="width:5%;background-color:#006699;color: white;">Den.</th>
                    <th style="width:5%;background-color:#006699;color: white;">Action</th>
                </tr>
            </thead>
            <tbody id="list_post">
            </tbody>
            </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="modal fade" id="mdl_confirm" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>                       
            </div>
            <div class="modal-body">
                <div class="alert text-center" id="contenido_mensages">
                        
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="type_operation" >
                <input type="hidden" id="data_operation" >
                <button type="button" id="btn_modal_aceptar" class="btn btn-success" data-dismiss="modal" onClick="realizarAccion()" >Aceptar</button>
                <button type="button" id="btn_modal_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                
            </div>
        </div>
    </div>
</div>


<script>
/*
$(document).ready(function() {
    $('#tbl_coments').DataTable({
        "order": [ 6, 'desc' ]
    });
});
*/
</script>