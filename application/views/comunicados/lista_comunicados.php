 <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Comunicados</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <a class="btn btn-primary"  href="<?= base_url()?>/comunicados/nuevo"><i class="fa fa-plus"></i> Agregar Comunicados</a>
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
                          <table id="lista_avisos" class="table table-striped table-bordered " cellpadding="0" cellspacing="0" border="0" >
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Contenido</th>
                                <th>Población</th>
                                <th>Carrera</th>
                                <th>Prioridad</th>
        						<th>Habilitado</th>
        						<th></th>
                              </tr>
                            </thead>
                            <tbody id="listado">
                        	
                              
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>

                </div>
            </div><!-- .animated -->
        </div>    
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
                <input type="hidden" id="id_comunicado_sel" >
                <input type="hidden" id="title_comunicado_sel" >
                <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_eliminar" class="btn btn-primary" onclick="del_comunicado()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<script >
function get_lista() {
    $.post(baseurl+"Comunicados/get_lista",
        {   
            
        }, 
        function(data){
            $('#listado').html(data);
            $("#lista_avisos").DataTable({
                "language": {
                    "url": baseurl +"plantillas/js/spanish.json"
                },
    "order": [ 2, 'desc' ]
});
        });
}
function del_comunicado() {
    id_aviso=$('#id_comunicado_sel').val();
    $("#btn_eliminar").prop('disabled',true);
    $("#btn_eliminar").html('<span class="fa fa-spinner fa-pulse fa-1x fa-fw" ></span>')
    $.post(baseurl+"Comunicados/del_comunicado",
        {   
            id:id_aviso,
        }, 
        function(data){
            if(data=='exito')
            {
                mensajes('exito',id_aviso,$('#title_comunicado_sel').val());
                get_lista();
            }
            else
                mensajes('no_exito',id_aviso,$('#title_comunicado_sel').val());
        });
}
function seguro_del(id_aviso,titulo) {
    $('#id_comunicado_sel').val(id_aviso);    
    $('#title_comunicado_sel').val(titulo);    
    mensajes('seguro_del',id_aviso,titulo);
}
function edit_comunicado(id_aviso) {

    $(location).attr('href',baseurl+"Comunicados/edit_comunicado/"+id_aviso);    
}

mensage = {    
    seguro_del: '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Está seguro de querer eliminar el comunicado: <strong id="title_comunicado"></strong> con ID: <strong id="id_comunicado"></strong>?</span>',
    exito     : '<h1><span class="fa fa-check"></span></h1><span class="text-left"> El Comunicado: <strong id="title_comunicado2"></strong> con ID: <strong id="id_comunicado2"></strong> se eliminó correctamente.</span>',
    no_exito  : '<h1><span class="fa fa-times"></span></h1><span class="text-left"> No se pudo eliminar el Comunicado: <strong id="title_comunicado3"></strong> con ID: <strong id="id_comunicado3"></strong>. Comuníquese con el Administrador del sistema.</span>',
    };
function mensajes(tipo, data1, data2) {
    $("#btn_eliminar").prop('disabled',false);
    $("#btn_eliminar").hide();
    $("#btn_eliminar").html('Eliminar')
    if(tipo=='exito')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito);
                $('#id_comunicado2').html(data1);
                $('#title_comunicado2').html(data2);
                $('#modalTitle').html('Eliminación exitosa');
    }
    if(tipo=='seguro_del')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(mensage.seguro_del);
                $('#modalTitle').html('Está seguro de borrar?');
                $('#title_comunicado').html(data2);
                $('#id_comunicado').html(data1);
                $("#btn_eliminar").show();
    }
    if(tipo=='no_exito')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.no_exito);
                $('#id_comunicado3').html(data1);
                $('#title_comunicado3').html(data2);
                $('#modalTitle').html('Error al eliminar');
    }
    
 }
</script>