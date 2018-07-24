<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Crear Publicación</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-sm-12   ">

                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= validation_errors() ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
            </div> 

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Formulario de Creación</strong>
                    </div>
                    <form method="post" action="<?= base_url() ?><?=isset($post)?'nuevo_post/modificar':'nuevo_post/registrar'; ?>">
                    <div class="card-body card-block">
                            
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" autofocus placeholder="Ingrese el título del post" class="form-control" value="<?= isset($post)? $post->titulo : set_value('titulo') ; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tema" class=" form-control-label">Tema</label>
                                <input type="text" id="tema" name="tema" placeholder="Ingrese el tema" class="form-control" value="<?= isset($post) ? $post->tema :set_value('tema'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label">Seleccione los autor(es)</label>
                                <select class="standardSelect form-control" multiple id="docente" name="docente[]" data-placeholder="Elija autor(es)...">
                                    <?php if ( isset($docentes))  : ?>
                                        <?php foreach($docentes as $doc): ?>
                                            <option value="<?= $doc['cod_docente'] ?>" <?=isset($autores)?docente_es_autor($doc['cod_docente'],$autores):set_select('docente[]',$doc['cod_docente']); ?> ><?= $doc['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="carrera" class=" form-control-label">Carrera</label>
                                <select class="form-control" id="cod_carrera" name="carrera">
                                    <?php
                                    if($carreras!=null)
                                    {   
                                    foreach($carreras->result() as $fila): ?>
                                        <option value="<?= $fila->cod_carrera ?>" <?=isset($post)?($fila->cod_carrera == $post->carrera?'selected="selected"':''):set_select('carrera',$fila->cod_carrera); ?> ><?= $fila->nombre_carrera ?></option>
                                    <?php 
                                    endforeach; 
                                    }?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="select_poblacion" class=" form-control-label">Seleccione a quien va dirigido la publicación</label>
                                <select name="select_poblacion" id="select_poblacion" class="form-control">
                                    <?php
                                    if($tipo_poblacion!=null)
                                    {
                                    foreach($tipo_poblacion->result() as $fila): ?>
                                        <option value="<?= $fila->id_poblacion ?>" <?= isset($id_poblacion)?($fila->id_poblacion == $id_poblacion?'selected="selected"':''):set_select('select_poblacion',$fila->id_poblacion);?> ><?= $fila->nombre ?></option>
                                    <?php 
                                    endforeach; 
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <label for="vat" class=" form-control-label" id="label_opcion"><?= isset($label_poblacion_sel)?$label_poblacion_sel:'Selecciono todos los estudiantes' ?></label>

                                <select data-placeholder="Elija una opción..." multiple class="standardSelect form-control" id="grupo_sel" name="grupo_sel[]">
                                <?php
                                if(isset($p_sel))
                                { 
                                    foreach($p_sel as $p): ?>
                                    <option value="<?= $p->item ?>" <?=isset($p_selected)?es_poblacion_seleccionada($p->item,$p_selected):set_select('grupo_sel[]',$p->item); ?> >
                                    <?= $p->item ?>
                                    </option>
                                <?php
                                    endforeach;
                                } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                <?=isset($post)?$post->contenido:set_value('editor1');?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">Descripción de la publicación</label>
                                <textarea name="descripcion" id="descripcion" rows="10" cols="80" class="form-control">
<?=isset($post)?$post->descripcion:set_value('descripcion');?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="country" class=" form-control-label">Permitir comentarios</label>

                                <label class="switch switch-3d switch-info ml-5">
                                    <input type="checkbox" class="switch-input" id="coment" name="coment" value="Permite" <?= isset($post)? ($post->permite_comentario=='t'?'checked="checked"':''):set_checkbox('coment','Permite',FALSE) ?> >
                                    <span class="switch-label"></span> 
                                    <span class="switch-handle"></span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="activo" class=" form-control-label">Activo </label>

                                <label class="switch switch-3d switch-info">
                                    <input type="checkbox" class="switch-input" id="activo" name="activo" value="Activo" <?= isset($post)? ($post->activo=='t'?'checked="checked"':''):set_checkbox('activo','Activo',TRUE) ?> >
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                    </div>
                    <div class="card-footer">
                    
                        <button class="btn btn-primary btn-sm" id="btn_registrar">
                        <i class="fa fa-edit"></i><?= isset($post)?'Modificar':'Registrar'; ?>
                        </button>

                        <?php 
                        if (isset($post)) {
                            echo '<button type="submit" class="btn btn-danger btn-sm" id="btn_cancelar"><i class="fa fa-edit"></i> Cancelar </button>';
                        }    
                        else
                            echo '<button type="submit" class="btn btn-success btn-sm" id="btn_limpiar"><i class="fa fa-refresh"></i> Limpiar </button>';     
                        ?>
                    </div>
                    </form>
                </div>
            </div>

        </div> <!-- .content -->

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

$('#btn_cancelar').click(function () {
    $(location).attr('href',baseurl+'/lista_post');
});


$('#btn_limpiar').click(function () {
    $(location).attr('href',baseurl+'/nuevo_post');
});


/*
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
*/
jQuery(document).ready(function() {
    jQuery(".standardSelect").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, no se encontró ningún resultado!",
        width: "100%"
    });
});

jQuery(document).ready(function() {
    //alert(jQuery("#error-alert").length);
    if(jQuery("#error-alert").children().length>1) {
        jQuery("#error-alert").show();
    } else {
        jQuery("#error-alert").hide();
    }
});
window.onload = function () {
    CKEDITOR.replace('editor1', {
        language: 'es'
    });
};

</script>