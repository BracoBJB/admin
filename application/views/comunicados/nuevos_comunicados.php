 <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Nuevo Comunicado</h1>
            </div>
        </div>
    </div>
    
</div>
<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Formulario de Creación</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" action="<?= base_url() ?>master/login">
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del comunicado" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="carrera" class=" form-control-label">Carrera</label>
                                <select class="form-control" id="cod_carrera" name="carrera">
                                    <?php
                                        if($carreras!=null)
                                        {   foreach ($carreras -> result() as $fila) 
                                            echo '<option value="'.$fila->cod_carrera.'" >'.$fila->nombre_carrera.' </option>';
                                        }
                                    ?>                                  
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="select_poblacion" class=" form-control-label">Tipo de Población</label>
                                <select name="select_poblacion" id="select_poblacion" class="form-control">
                                    <?php
                                        if($tipo_poblacion!=null)
                                        {   foreach ($tipo_poblacion -> result() as $fila) 
                                                echo '<option value="'.$fila->id_poblacion.'" >'.$fila->nombre.'</option>';     
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label" id="label_opcion">Selecciono todos los estudiantes</label>

                                <select data-placeholder="Elija una opción..." multiple class="standardSelect form-control" id="grupo_sel" name="grupo_sel">
                                    
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="fecha_ini" class=" form-control-label" id="label_opcion">Fecha Inicio</label>

                                <input type="text" id="fecha_ini" name="fecha_ini" placeholder="dd/mm/aaaa" class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="fecha_fin" class=" form-control-label" id="label_opcion">Fecha Fin</label>

                                <input type="text" id="fecha_fin" name="fecha_fin" placeholder="dd/mm/aaaa" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                Por favor escriba aquí el contenido del post
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="activo" class=" form-control-label">Activo</label>

                                <label class="switch switch-3d switch-success ml-5">
                                    <input type="checkbox" class="switch-input" id="activo" checked="true"> 
                                    <span class="switch-label"></span> 
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" id="registrar">
                            <i class="fa fa-dot-circle-o"></i> Registrar
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Limpiar
                        </button>
                    </div>

                </div>
            </div>

                </div>
            </div><!-- .animated -->
        </div>    
<script >

$('#select_poblacion').change(function () {
    get_poblacion_sel();
});
function get_poblacion_sel() {
    if($('select[name="select_poblacion"] option:selected').text()=='Todos')
        $('#label_opcion').html('Selecciono todos los estudiantes');
    if($('select[name="select_poblacion"] option:selected').text()=='Semestre')
        $('#label_opcion').html('Seleccione semestre(s)');
    if($('select[name="select_poblacion"] option:selected').text()=='Grupo')
        $('#label_opcion').html('Seleccione Grupo(s)');
    $.post(baseurl+"Comunicados/get_poblacion_sel",
        {   
            tipo_sel:$('#select_poblacion').val(),
            carrera:$('#cod_carrera').val(),
        }, 
        function(data){
            $('#grupo_sel').html(data);
            $(".standardSelect").trigger("chosen:updated");            
        });
}
$('#registrar').click(function () {
    var content = CKEDITOR.instances['editor1'].getData();
   alert(content); 
   // alert($(".standardSelect").chosen().val()); 
    registrar_comunicaco();
});
function registrar_comunicaco() {
    $.post(baseurl+"Comunicados/registrar",
    {   
        titulo:$('#titulo').val(),
        carrera:$('#cod_carrera').val(),
        select_poblacion:$('#select_poblacion').val(),
        grupo_sel:$(".standardSelect").chosen().val(),
        fecha_ini:$('#fecha_ini').val(),
        fecha_fin:$('#fecha_fin').val(),
        contenido:CKEDITOR.instances['editor1'].getData(),
        activo:$('#activo').val(),
    }, 
    function(data){
        // $('#grupo_sel').html(data);
        // $(".standardSelect").trigger("chosen:updated");            
    });
}

</script>