/*
    //lismpiar tabla
    $('#tbl_coments').html(`
        <tr>
            <th>ID</th>
            <th>Post</th>
            <th>Estudiante</th>
            <th>Contenido</th>
            <th>Fecha</th>
            <th>Respuesta</th>
            <th>Verificado</th>
            <th>Action</th>
        </tr>
    `);
*/
    /*
   $.post(baseurl+"blog/get_comentarios",
   {
       tipo:1
   },
   function (data) {
       //alert(data);
       var c = JSON.parse(data);
        $.each(c,function(i,item){
            $('#tbl_coments tbody').append(`
            <tr>
                <th>`+item.id_comentario+`</th>
                <th>`+item.titulo+`</th>
                <th>`+item.nombre+`</th>
                <th>`+item.contenido+`</th>
                <th>`+item.fecha+`</th>
                <th>`+item.es_respuesta+`</th>
                <th>`+item.verificado+`</th>
                <th></th>
            </tr>
            `);
        });
        
        $('#tbl_coments').DataTable({
            "order": [ 4, 'desc' ]
        });
   });*/
   
   var table = $('#tbl_coments').DataTable({
    "language": {
        "url": baseurl +"plantillas/js/spanish.json"
    },
    //'dom':'<"toolbar col-md-6">frtip',
    'lengthMenu':[[10,25,50,-1],[10,25,50,"Todo"]],
    'pagingType': "full_numbers",
    'paging':true,
    'info': true,
    'filter':true,
    'stateSave':true,
    'processing':true,
    'serverSide':true,
    'ajax' : {
        'url': baseurl+"blog/get_comentarios_sp",
        'dataType': "json",
        'type': "POST",
        'data': function ( d ) {
            d.tipo = $('#slc_aprobado').val();
            d.denuncia = $('#slc_denuncia').val();
        }
        // {
        //     tipo:$('#slc_aprobado').val(),
        //     denuncia:$('#slc_denuncia').val()
        // }
    },
    'columns':[
        {data: 'id_comentario'},
        {data: 'titulo'},
        {data: 'cod_ceta'},
        {data: 'nombre'},
        {data: 'contenido'},
        {data: 'fecha'},
        {data: 'es_respuesta'},
        {data: 'verificado'},
        {data: 'denuncia'},
        {"orderable":false,
             render:function(data,type,row) {
                var addHtml = `
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Accion
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">`;

                if(row.verificado == 'Pendiente') {
                    addHtml+='<a class="dropdown-item" style="color:green;" href="#" data-toggle="modal" data-target="#mdl_confirm" onClick="aprobarComentario(\''+row.id_comentario+'\')" ><i class="fa fa-check"></i> &nbsp;Aprobar</a>'
                } else {
                    addHtml+='<a class="dropdown-item" style="color:red;" href="#" data-toggle="modal" data-target="#mdl_confirm" onClick="desaprobarComentario(\''+row.id_comentario+'\')" ><i class="fa fa-times"></i> &nbsp;Desaprobar</a>'
                }

                addHtml+=`<a class="dropdown-item" style="color:red;" href="#" data-toggle="modal" data-target="#mdl_confirm" onClick="eliminarComentario('`+row.id_comentario+`','`+row.contenido+`')" ><i class="fa fa-times"></i> &nbsp;Eliminar Comentario</a>
                <a class="dropdown-item" style="color:red;" href="#" data-toggle="modal" data-target="#mdl_confirm" onClick="bannearEstudiante('`+row.cod_ceta+`','`+row.nombre+`')"><i class="fa fa-ban"></i> &nbsp;Banear Usuario</a>
             </div>
           </div>`;


                 return addHtml;
             }
        }
    ],
    'columnDefs': [
        {
            'targets': [8],
            'data': "denuncia",
            'render': function(data,type,row) {
                if(data == 'Si') {
                    return "<h1><span class='badge badge-danger'>"+data+"</span></h1>";
                } else {
                    return data;
                }
            }
        },
        {
            'targets': [7],
            'data': "verificado",
            'render': function(data,type,row) {
                if(data == 'Pendiente') {
                    return "<span style='color:red;'><i class='fa fa-times'></i> &nbsp;"+data+"</span>";
                } else {
                    return "<span style='color:green;'><i class='fa fa-check'></i> &nbsp;"+data+"</span>";
                }
            }
        },
        {
            'targets': [6],
            'data': "es_respuesta",
            'render': function(data,type,row) {
                return data;
                
            }
        },
        {
            'targets': [3],
            'data': "nombre",
            'render': function(data,type,row) {
                return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
            }
            
        },
        {
            'targets': [2],
            'visible': false,
            'searchable':false
        }

    ],
    "order": [[ 0, "desc" ]]
});

$('div.toolbar').html('<b> Custom tool bar! Text/images etc.</b>');

$('#slc_aprobado').change(function () {
    //alert('aprobado:'+$('#slc_aprobado').val()+'-dununcia:'+$('#slc_denuncia').val());
    table.draw();
});

$('#slc_denuncia').change(function () {
    table.draw();
});


function aprobarComentario(id_comentario) {
    $.post(baseurl+"blog/aprobarComentario",
    {
        id_comentario:id_comentario,
    },
    function (data) {
        if(data == 'exito') {
            $('#contenido_mensages').addClass('alert-success');
            $('#contenido_mensages').html(`<h1><span class="fa fa-check"></span></h1>
            <span class="text-left"> El Aprobo correctamente el comentario con codigo: <strong>`+id_comentario+`</strong></span>`);
            $('#modalTitle').html('Exito');

        } else {
            $('#contenido_mensages').addClass('alert-danger');
            $('#contenido_mensages').html(`<h1><span class="fa fa-check"></span></h1>
            <span class="text-left"> Hubo un error el comentario con codigo: <strong>`+id_comentario+`</strong></span> intentelo mas tarde`);
            $('#modalTitle').html('UPs, no se puedo aprobar el comentario');
        }
        table.draw();
    });
}

function desaprobarComentario(id_comentario) {
    $.post(baseurl+"blog/desaprobarComentario",
    {
        id_comentario:id_comentario,
    },
    function (data) {
        if(data == 'exito') {
            $('#contenido_mensages').addClass('alert-success');
            $('#contenido_mensages').html(`<h1><span class="fa fa-check"></span></h1>
            <span class="text-left"> El desaprobo el comentario con codigo: <strong>`+id_comentario+`</strong></span>`);
            $('#modalTitle').html('Exito');
        } else {
            $('#contenido_mensages').addClass('alert-danger');
            $('#contenido_mensages').html(`<h1><span class="fa fa-check"></span></h1>
            <span class="text-left"> Hubo un error el comentario con codigo: <strong>`+id_comentario+`</strong></span> intentelo mas tarde`);
            $('#modalTitle').html('UPs, no se puedo aprobar el comentario');
        }
        table.draw();
    });
}

bannearEstudiante = function (cod_ceta,nombre) {
    console.log('debo bannear el usurio:'+cod_ceta);

    $('#type_operation').val('2');
    $('#data_operation').val(cod_ceta);

    //$("#contenido_mensages").attr("class","alert alert-warning text-center");
    $('#contenido_mensages').addClass('alert-danger');
    $('#contenido_mensages').html(`
    <h1><span class="fa fa-exclamation-triangle"></span></h1>
    <span class="text-left"> El Estudiante: <strong>`+nombre+`</strong><br>con codigo: <strong>`+cod_ceta+`</strong> sera banneado.</span>
    `);
    $('#modalTitle').html('Está seguro de bannear?');


}

eliminarComentario = function (id_comentario,contenido) {
    console.log('debo eliminar el comentario:'+id_comentario);

    $('#type_operation').val('1');
    $('#data_operation').val(id_comentario);

    $('#contenido_mensages').addClass('alert-danger');
    $('#contenido_mensages').html(`
    <h1><span class="fa fa-exclamation-triangle"></span></h1>
    <span class="text-left"> El Comentario: <strong>`+contenido+`</strong><br> con ID: <strong>`+id_comentario+`</strong> sera eliminado.</span>
    `);
    $('#modalTitle').html('Está seguro de borrar?');
    //$('#mdl_confirm').show();

  /*
    table.row( $(this).parents('tr') )
        .remove()
        .draw();
  */
 /*
    var row = table.row( $(this).parents('tr') );
    var rowNode = row.node();
    row.remove();
    table2.row.add(rowNode).draw();
 */

 /*
    table.row(':eq(0)').delete({
        title:'Delete first row'
    });
 */

 /*
 table.row(':eq(0)').delete({
        buttons:[
            { label:'Cancel',fn: function() {this.close();}},
            'Delete'
        ]
    });
 */
    
}


function realizarAccion() {
    var operacion = $('#type_operation').val();
    var dato = $('#data_operation').val();
    if(operacion === '1') {
        $.post(baseurl+"blog/eliminarComentario",
        {
            id_comentario:dato
        },
        function (data) {
            console.log('el resultado es :'+data);
            table.draw();
        });
    } else if(operacion === '2') {
        $.post(baseurl+"blog/bloquearEstudiante",
        {
            cod_ceta:dato
        },
        function (data) {
            console.log('el resultado es :'+data);
            table.draw();
        });
    }

}