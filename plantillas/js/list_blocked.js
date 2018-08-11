var rowRemove = null;
var table = $('#list_blocked_table').DataTable({
    'lengthMenu':[[10,25,50,-1],[10,25,50,"Todo"]],
    'pagingType': "full_numbers",
    'paging':true,
    'info': true,
    'filter':true,
    'stateSave':false,
    'ajax' : {
        'url': baseurl+"blog/get_list_blocked_est",
        'type': "POST",
        'data': {
        },
        dataSrc:''
        //'dataSrc': function(data) {
        //    return data;
        //}
    },
    'columns':[
        {data: 'cod_ceta'},
        {data: 'nombre'},
        {data: 'direccion'},
        {data: 'genero'},
        {data: 'bloqueado'},
        {"orderable":true,
             render:function(data,type,row) {
                if(row.bloqueado == 'f') {
                    return `<button id="btnUnblock" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalUnblock" onClick="agregarBloqueo(`+row.cod_ceta+`,'`+row.nombre+`')">Bloquear</button>`;
                } else {
                    return `<button id="btnUnblock" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUnblock" onClick="quitarBloqueo(`+row.cod_ceta+`,'`+row.nombre+`')">Quitar</button>`;
                }
             }
        },
    ],
    'columnDefs': [
        {
            'targets': [4],
            'data': "bloqueado",
            'render': function(data,type,row) {
                if(data == 'f') {
                    return "<span style='color:green;'><i class='fa fa-times'></i> &nbsp;No</span>";
                } else {
                    return "<span style='color:red;'><i class='fa fa-check'></i> &nbsp;Si</span>";
                }
            }
        },
        {
            'targets': [1],
            'data': "nombre",
            'render': function(data,type,row) {
                return "<span style='color:#006699;'><i class='fa fa-user'></i> &nbsp;"+data+"</span>";
            }
            
        }

    ],
    "order": [[ 0, 'asc' ]]
});

function quitarBloqueo(cod_ceta,nombre) {
    
    $('#tipo_accion').val('1');
    $('#cod_ceta_sel').val(cod_ceta);

    $('#modalTitle').html('Está seguro de quitar el bloqueo?');
    $('#contenido_mensages').html(`
    <h1><span class="fa fa-exclamation-triangle"></span></h1>
    <span class="text-left"> Al Estudiante: <strong>`+nombre+`</strong><br>con codigo: <strong>`+cod_ceta+`</strong> se le quitara el bloqueo.</span>
    `);
}

function agregarBloqueo(cod_ceta,nombre) {
    $('#tipo_accion').val('2');
    $('#cod_ceta_sel').val(cod_ceta);

    $('#modalTitle').html('Está seguro de agregar el bloqueo?');
    $('#contenido_mensages').html(`
    <h1><span class="fa fa-exclamation-triangle"></span></h1>
    <span class="text-left"> Al Estudiante: <strong>`+nombre+`</strong><br>con codigo: <strong>`+cod_ceta+`</strong> se le bloqueara los derechos de comentarios.</span>
    `);
}

function realizarAccion() {
    var operacion = $('#tipo_accion').val();
    var data = $('#cod_ceta_sel').val();

    if(operacion == '1') {
        $.post(baseurl+"blog/desbloquearEstudiante",
        {
            cod_ceta:data
        },
        function (data) {
            console.log('el resultado desbloquearEstudiantes es :'+data);
            table.ajax.reload();
        });
    } else if(operacion == '2') {
        $.post(baseurl+"blog/bloquearEstudiante",
        {
            cod_ceta:data
        },
        function (data) {
            console.log('el resultado bloquearEstudiante es :'+data);
            table.ajax.reload();
        });
    }
    
    
}