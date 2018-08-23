 <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Material Académico publicado</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <a class="btn btn-primary"  href="<?= base_url()?>/material/material/nuevo"><i class="fa fa-plus"></i> Agregar Material Académico</a>
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
                          <table id="lista_material" class="table table-striped table-bordered " cellpadding="0" cellspacing="0" border="0" >
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Gestion Carrera</th>
                                <th>Contenido</th>
                                <th>Materia Grupos</th>
        						<th>Archivo</th>
        						<th>Opciones</th>
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
                <input type="hidden" id="id_material_sel" >
                <input type="hidden" id="title_material_sel" >
                <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_eliminar" class="btn btn-primary" onclick="del_material()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<script >


$(document).ready(function(){
    //$('[data-toggle="tooltip"]').tooltip(); 
    

    // $("#ttt span").tooltip({

    //     title: 'It works in absence of title attribute.'

    // });
    /*
    $("span").tooltip({
        container:'body',
        delay: { "show": 3000, "hide": 2000 }
        });
        */
    /*$('[data-toggle="tooltip"]').tooltip({
        container: 'body'

        });*/
});
var baseurl="<?=base_url();?>";
var table = $('#lista_material').DataTable({
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip({
        container:'body'});
        //$('[data-toggle="tooltip2"]').tooltip();
        // add a    s many tooltips you want
    },/*
    "initComplete": function( settings, json ) {
        $('[data-toggle="tooltip"]').tooltip({container:'body'}); 
    },*/
    "language": {
        "url": baseurl +"plantillas/js/spanish.json"
    },
    'lengthMenu':[[10,25,50,-1],[10,25,50,"Todo"]],
    'pagingType': "full_numbers",
    'paging':true,
    'info': true,
    'filter':true,
    'stateSave':false,
    'ajax' : {
        'url': baseurl+"material/material/get_lista",
        'type': "POST",
        'data': {
        },
        dataSrc:''
    },
    'columns':[
        {data: 'id_material'},
        {data: 'titulo'},
        {data: 'gestion'},
        {data: 'contenido'},
        {data: 'cod_materia'},
        {data: 'nom_archivo'},
        {"orderable":false,          
             render:function(data,type,row) {
                return `<a class="btn btn-success btn-sm" href="<?= base_url() ?>material/material/edit_material/`+row.id_material+`" role="button">
                <i class="fa fa-pencil"></i>
                </a>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalMensajes" role="button" onclick="seguro_del('`+row.id_material+`','`+row.titulo+`')" ><i class="fa fa-times"></i>
                </button>`;
             }
        },
    ],
    'columnDefs': [
        {
            'targets': [1],
            'data': "titulo",
            'render': function(data,type,row) {
                return "<span id='ttt' data-toggle='tooltip' title='Some text'><i class='fa fa-bookmark-o'></i> &nbsp;"+row.titulo+"</span>"+
                        "<br><span data-toggle='tooltip' title='Disabled tooltip'><i class='fa fa-calendar'></i> &nbsp;"+new_date(row.fecha)+"</span>"+
                        "<br><span data-toggle='tooltip' data-placement='top' title='Docente'><i class='fa fa-user'></i> &nbsp;"+row.nom_docente+"</span>";
            }
        },
        {
            'targets': [2],
            'data': "carrera",
            'render': function(data,type,row) {
                return "<span data-toggle='tooltip' data-placement='top' title='Gestión'><i class='fa fa-cog'></i> &nbsp;"+row.gestion+"</span>"+
                        "<br><span data-toggle='tooltip' data-placement='top' title='Carrera'><i class='fa fa-suitcase'></i> &nbsp;"+row.carrera+"</span>";
            }
        },
        {
            'targets': [3],
            "visible": true,
            "searchable": false
        },
        {
            'targets': [4],
            'data': "carrera",
            'render': function(data,type,row) {
                return "<span data-toggle='tooltip' data-placement='top' title='Materia'><i class='fa fa-book'></i> &nbsp;"+row.cod_materia+" "+row.nom_materia+"</span>"+
                        "<br><span data-toggle='tooltip' data-placement='top' title='Grupos'><i class='fa fa-users'></i> &nbsp;"+row.poblacion+"</span>";
            }
        },
       {
            'targets': [5],
            "visible": true,
            "searchable": false
        }
    ],
    "order": [[ 0, 'desc' ]]
});
function new_date(old_date)
{
    res = old_date.split("-");
    return (res[2]+'/'+res[1]+'/'+res[0]);
}

function del_material() {
    id_aviso=$('#id_material_sel').val();
    $("#btn_eliminar").prop('disabled',true);
    $("#btn_eliminar").html('<span class="fa fa-spinner fa-pulse fa-1x fa-fw" ></span>')
    $.post(baseurl+"material/material/del_material",
        {   
            id:id_aviso,
        }, 
        function(data){
            if(data=='exito')
            {
                mensajes('exito',id_aviso,$('#title_material_sel').val());
                table.ajax.reload();
                $('[data-toggle="tooltip"]').tooltip(); 

            }
            else
                mensajes('no_exito',id_aviso,$('#title_material_sel').val());
        });
}
function seguro_del(id_aviso,titulo) {
    $('#id_material_sel').val(id_aviso);    
    $('#title_material_sel').val(titulo);    
    mensajes('seguro_del',id_aviso,titulo);
}
function edit_material(id_aviso) {

    $(location).attr('href',baseurl+"material/material/edit_material/"+id_aviso);    
}

mensage = {    
    seguro_del: '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Está seguro de querer eliminar el Material con título: <strong id="title_material"></strong> con ID: <strong id="id_material"></strong>?</span>',
    exito     : '<h1><span class="fa fa-check"></span></h1><span class="text-left"> El Material: <strong id="title_material2"></strong> con ID: <strong id="id_material2"></strong> se eliminó correctamente.</span>',
    no_exito  : '<h1><span class="fa fa-times"></span></h1><span class="text-left"> No se pudo eliminar el Material: <strong id="title_material3"></strong> con ID: <strong id="id_material3"></strong>. Comuníquese con el Administrador del sistema.</span>',
    };
function mensajes(tipo, data1, data2) {
    $("#btn_eliminar").prop('disabled',false);
    $("#btn_eliminar").hide();
    $("#btn_eliminar").html('Eliminar')
    if(tipo=='exito')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito);
                $('#id_material2').html(data1);
                $('#title_material2').html(data2);
                $('#modalTitle').html('Eliminación exitosa');
    }
    if(tipo=='seguro_del')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(mensage.seguro_del);
                $('#modalTitle').html('Está seguro de borrar?');
                $('#title_material').html(data2);
                $('#id_material').html(data1);
                $("#btn_eliminar").show();
    }
    if(tipo=='no_exito')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.no_exito);
                $('#id_material3').html(data1);
                $('#title_material3').html(data2);
                $('#modalTitle').html('Error al eliminar');
    }
    
 }

</script>