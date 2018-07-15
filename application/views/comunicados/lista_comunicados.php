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
                        <div class="card-header">
                            <strong class="card-title">Lista de Comunicados</strong>
                        </div>
                        <div class="card-body">
                          <table id="lista_avisos" class="table table-striped table-bordered " cellpadding="0" cellspacing="0" border="0" >
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Contenido</th>
        						<th>Imagen</th>
                                <th>Población</th>
        						<th>Activo</th>
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
<script >
function get_lista() {
    $.post(baseurl+"Comunicados/get_lista",
        {   
            
        }, 
        function(data){
            $('#listado').html(data);
            $("#lista_avisos").DataTable();
        });
}
function del_comunicado(id_aviso) {
    $.post(baseurl+"Comunicados/del_comunicado",
        {   
            id:id_aviso,
        }, 
        function(data){
            get_lista();
        });
}
function edit_comunicado(id_aviso) {

    $(location).attr('href',baseurl+"Comunicados/edit_comunicado/"+id_aviso);
    // $.post(baseurl+"Comunicados/edit_comunicado",
    //     {   
    //         id:id_aviso,
    //     }, 
    //     function(data){
    //         get_lista();
    //     });
}

</script>