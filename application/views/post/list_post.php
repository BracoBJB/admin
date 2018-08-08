<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Publicaciones</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <a class="btn btn-primary"  href="<?= base_url()?>blog/post"><i class="fa fa-plus"></i> Agregar Publicación</a>
                </ol>
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
            <table id="list_post_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Titulo</th>
                <th>Tema</th>
                <th>Autor(es)</th>
                <th>Carrera</th>
                <th>Poblacion</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Activo</th>
                <th>Permite Comentarios</th>
                <th>Opciones</th>
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

<div class="modal fade show" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                <input type="hidden" id="id_post_sel" >
                <input type="hidden" id="title_post_sel" >
                <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_eliminar" class="btn btn-primary" onclick="del_comunicado()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<script>
function get_list_post() {
    $.post(baseurl+"blog/get_lista_post",{}, 
        function(data){
            $('#list_post').html(data);
            
            $("#list_post_table").DataTable({
                'paging':true,
                'info':false,
                'filter':true,
                'order': [6, 'desc' ]
            });
        });
}

function seguro_del(id_aviso,titulo) {
    $('#id_post_sel').val(id_aviso);    
    $('#title_post_sel').val(titulo);    
    mensajes('seguro_del',id_aviso,titulo);
}

function del_comunicado() {
    id_post=$('#id_post_sel').val();
    $("#btn_eliminar").prop('disabled',true);
    $("#btn_eliminar").html('<span class="fa fa-spinner fa-pulse fa-1x fa-fw" ></span>')
    $.post(baseurl+"blog/eliminar",
        {   
            id_post:id_post,
        }, 
        function(data){
            if(data=='exito')
            {
                mensajes('exito',id_post,$('#title_post_sel').val());
                get_list_post();
            }
            else
                mensajes('no_exito',id_post,$('#title_post_sel').val());
        });
}

function mensajes(tipo, id_post, titulo_post) {
    $("#btn_eliminar").prop('disabled',false);
    $("#btn_eliminar").hide();
    $("#btn_eliminar").html('Eliminar')
    if(tipo=='exito')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito);
                $('#modalTitle').html('Eliminación exitosa');
                $('#id_post2').html(id_post);
                $('#title_post2').html(titulo_post);
                
    }
    if(tipo=='seguro_del')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(mensage.seguro_del);
                $('#modalTitle').html('Está seguro de eliminar?');
                $('#id_post').html(id_post);
                $('#title_post').html(titulo_post);
                $("#btn_eliminar").show();
    }
    if(tipo=='no_exito')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.no_exito);
                $('#modalTitle').html('Error al eliminar');
                $('#id_post3').html(id_post);
                $('#title_post3').html(titulo_post);
                
    }
 }

 mensage = {    
    seguro_del: '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Está seguro de querer eliminar el Post: <strong id="title_post"></strong> con ID: <strong id="id_post"></strong>?</span>',
    exito     : '<h1><span class="fa fa-check"></span></h1><span class="text-left"> El Post: <strong id="title_post2"></strong> con ID: <strong id="id_post2"></strong> se eliminó correctamente.</span>',
    no_exito  : '<h1><span class="fa fa-times"></span></h1><span class="text-left"> No se pudo eliminar el Post: <strong id="title_post3"></strong> con ID: <strong id="id_post3"></strong>. Comuníquese con el Administrador del sistema.</span>',
    };
/*
$(document).ready(function() {
    $('#list_post_table').DataTable({
        "order": [ 6, 'desc' ]
    });
} );
*/
</script>