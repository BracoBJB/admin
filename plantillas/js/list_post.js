var rowRemove = null;
var table = $('#list_post_table').DataTable({
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
        'url': baseurl+"blog/get_lista_post",
        'type': "POST",
        'data': {
        },
        dataSrc:''
    },
    'columns':[
        {data: 'id_post'},
        {data: 'titulo'},
        {data: 'tema'},
        {data: 'autor'},
        {data: 'carrera'},
        {data: 'poblacion'},
        {data: 'descripcion'},
        {data: 'fecha'},
        {data: 'activo'},
        {data: 'permite_comentario'},
        {"orderable":false,
             render:function(data,type,row) {
                return `<a class="btn btn-success btn-sm" href="`+baseurl+`blog/post/`+row.id_post+`" role="button">
                <i class="fa fa-pencil"></i>
                </a>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalMensajes" role="button" onclick="seguro_del('`+row.id_post+`','`+row.titulo+`')" ><i class="fa fa-times"></i>
                </button>`;
             }
        },
    ],
    'columnDefs': [
        {
            'targets': [1],
            'data': "titulo",
            'render': function(data,type,row) {
                return "<span><i class='fa fa-bookmark-o'></i> &nbsp;"+row.titulo+"</span>"+
                        "<br><span><i class='fa fa-tag'></i> &nbsp;"+row.tema+"</span>"+
                        "<br><span><i class='fa fa-user'></i> &nbsp;"+row.autor+"</span>";
            }
        },
        {
            'targets': [2],
            "visible": false,
            "searchable": false
        },
        {
            'targets': [3],
            "visible": false,
            "searchable": false
        },
        {
            'targets': [4],
            'data': "carrera",
            'render': function(data,type,row) {
                return "<span><i class='fa fa-suitcase'></i> &nbsp;"+row.carrera+"</span>"+
                        "<br><span><i class='fa fa-users'></i> &nbsp;"+row.poblacion+"</span>";
            }
        },
       {
            'targets': [5],
            "visible": false,
            "searchable": false
        },
        {
            'targets': [7],
            'data': "carrera",
            'render': function(data,type,row) {
                
                var result = "<span><i class='fa fa-calendar'></i> &nbsp;"+data+"</span>";

                if(row.activo == 't') {
                    result += "<br><span style='color:green;'><i class='fa fa-check'></i>&nbsp;Activo</span>";
                } else {
                    result += "<br><span style='color:red;'><i class='fa fa-times'></i>&nbsp;No Activo</span>";
                }
                if(row.permite_comentario == 't') {
                    result += "<br><span style='color:green;'><i class='fa fa-comments'></i>&nbsp;Permite</span>";
                } else {
                    result += "<br><span style='color:reed;'><i class='fa fa-comments'></i>&nbsp;No Permite</span>";
                }
                return result;
                
            }
        },
        {
            'targets': [8],
            "visible": false,
            "searchable": false
        },
        {
            'targets': [9],
            "visible": false,
            "searchable": false
        },
    ],
    "order": [[ 0, 'asc' ]]
});

function seguro_del(id_post,titulo) {
    
    $('#id_post_sel').val(id_post);
    $('#title_post_sel').val(titulo);

    $('#modalTitle').html('Está seguro de quitar el bloqueo?');
    $('#contenido_mensages').html(`
    <h1><span class="fa fa-exclamation-triangle"></span></h1>
    <span class="text-left"> El Post: <strong>`+titulo+`</strong><br>con id: <strong>`+id_post+`</strong> se borrara de la base de datos.</span>
    `);
}

function realizarAccion() {
    var id_post = $('#id_post_sel').val();

    $.post(baseurl+"blog/eliminar",
    {
        id_post:id_post
    },
    function (data) {
        console.log('el resultado de eliminar post es :'+data);
        table.ajax.reload();
    });
}