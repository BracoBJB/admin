<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Post</h1>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Formulario de Creación</strong>
                    </div>
                    <form method="post" id="form_registro" action="<?= base_url() ?>blog/registrar">
                    <input type="hidden" id="id_post_modificado"  name="id_post_modificado" value="<?= isset($post)?$post->id_post:'0'; ?>">
                    <div class="card-body card-block">
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo<span  class="fa fa-spinner fa-spin " id="spinner" style="display:none;"></span ></label>
                                <input type="text" id="titulo" name="titulo" autofocus placeholder="Ingrese el título del post" class="form-control" value="<?= isset($post)? $post->titulo : set_value('titulo') ; ?>">
                                <?= form_error('titulo') ?>
                                <span id="msgTitulo"></span>
                            </div>
                            <div class="form-group">
                                <label for="tema" class=" form-control-label">Tema</label>
                                <input type="text" id="tema" name="tema" placeholder="Ingrese el tema" class="form-control" value="<?= isset($post) ? $post->tema :set_value('tema'); ?>">
                                <?= form_error('tema') ?>
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label">Seleccione los autor(es)</label>
                                <select class="standardSelect form-control" multiple id="docente" name="docente[]" data-placeholder="Elija autor(es)...">
                                    <?php if ( isset($docentes))  : ?>
                                        <?php foreach($docentes as $doc): ?>
                                            <option value="<?= $doc->cod_docente ?>" <?=isset($autores)?docente_es_autor($doc->cod_docente,$autores):set_select('docente[]',$doc->cod_docente); ?> ><?= $doc->name ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?= form_error('docente[]') ?>
                            </div>
                            <div class="form-group">
                                <label for="carrera" class=" form-control-label">Carrera</label>
                                <select class="form-control" id="carrera" name="carrera">
                                <?php
                                if($carreras!=null)
                                {   
                                foreach($carreras->result() as $fila): ?>
                                    <option value="<?= $fila->cod_carrera ?>" <?=isset($post)?($fila->cod_carrera == $post->carrera?'selected="selected"':''):set_select('carrera',$fila->cod_carrera); ?> ><?= $fila->nombre_carrera ?></option>
                                <?php 
                                endforeach; 
                                }?>
                                </select>
                                <?= form_error('carrera') ?>
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
                                <?= form_error('select_poblacion') ?>
                            </div>
                            <div class="form-group" id="grupo-sel-container"> 
                                <label for="grupo_sel" class="form-control-label" id="label_opcion"><?= isset($label_poblacion_sel)?$label_poblacion_sel:'Selecciono todos los estudiantes' ?></label>

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
                                <?= form_error('grupo_sel[]') ?>
                            </div>
                            
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                <?=isset($post)?$post->contenido:set_value('editor1');?>
                                </textarea>
                                <?= form_error('editor1') ?>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">Descripción de la publicación</label>
                                <textarea name="descripcion" id="descripcion" rows="10" cols="80" class="form-control"><?=isset($post)?$post->descripcion:set_value('descripcion');?></textarea>
                                <?= form_error('descripcion') ?>
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

                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#modalMensajes" id="btn_mensaje" style="display: none;"> <!-- no quitareste botón -->
                    </div>
                    </form>
                </div>
            </div>

        </div> <!-- .content -->
                        
        <div class="modal fade show" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                        <button type="button" id="btn_modal_aceptar" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                        <button type="button" id="btn_modal_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_modal_nuevo" class="btn btn-primary" data-dismiss="modal">Nuevo Post</button>
                        <button type="button" id="btn_modal_ver_lista" class="btn btn-primary" data-dismiss="modal">Ver Lista</button>
                    </div>
                </div>
            </div>
        </div>

<script >


$('#btn_cancelar').click(function () {
    $(location).attr('href',baseurl+'blog/lista');
});

$('#btn_limpiar').click(function () {
    $(location).attr('href',baseurl+'blog/post<?= isset($post)?'/'.$post->id_post:''; ?>');
});
$("#btn_modal_nuevo").click(function () {
    $(location).attr('href',baseurl+'blog/post');
});

$("#btn_modal_ver_lista").click(function () {
    $(location).attr('href',baseurl+'blog/lista');
});


var titulo_existe=false;
$('#titulo').blur(function () {
    rectificar_('titulo');
    if($('#titulo').val().length>0)
    {
        $('#titulo').prop('disabled', true);
        $('#spinner').show();
        $.post(baseurl+"blog/comprobar_titulo_ajax",
        {   
            titulo:$('#titulo').val(),
            id_post_modificado:$('#id_post_modificado').val(),
            cod_carrera:$('#carrera').val(),
        }, 
        function(data){
            console.log("comprobar titulo ajax es: "+data);
            if(data=='<div style="display:none">1</div>')
            {
                $("#titulo" ).removeClass("is-invalid");
                titulo_existe=false;
            }
            else
            {
                $("#titulo" ).addClass("is-invalid");
                mensajes('alerta_existe_titulo',$('#titulo').val());
                titulo_existe=true;
            }
            $('#titulo').prop('disabled', false);
            $('#spinner').hide();
        });
    }
})

function rectificar_(cadena_nombre) {
    cadena= $('#'+cadena_nombre).val().trim().split(' ');
    corregido='';
    for (i=0;i< cadena.length; i++)
    {
        if(cadena[i].length>0)
        {   
                corregido=corregido+' '+cadena[i];
        }
    }
    $('#'+cadena_nombre).val(corregido.trim());
}

function mensajes(tipo, data) {
    $("#btn_modal_aceptar").hide();
    $("#btn_modal_cancelar").hide();
    $("#btn_modal_nuevo").hide();
    $("#btn_modal_ver_lista").hide();
       
    if(tipo=='alerta_error')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(data);
                $('#modalTitle').html('Faltan Datos');
                $("#btn_modal_aceptar").show();
    }
    if(tipo=='exito')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito);
                $('#modalTitle').html('Registro exitoso');
                $("#btn_cancelar").hide();
                $("#btn_modal_nuevo").show();
                $("#btn_modal_ver_lista").show();    
    
    }
    if(tipo=='exito_modificacion')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito_modificacion);
                $('#modalTitle').html('Modificación exitosa');
                $("#btn_cancelar").hide();
                $("#btn_modal_nuevo").show();
                $("#btn_modal_ver_lista").show();    
    
    }
    if(tipo=='no_exito')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.no_exito);
                $('#modalTitle').html('Error al registrar');
                $("#btn_modal_cancelar").show();
    }
    if(tipo=='alerta_existe_titulo')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.alerta_existe_titulo);
                $('#modalTitle').html('Título existe');
                $('#titulo_intro').html(data);
                $("#btn_modal_aceptar").show();
    }

    $('#btn_mensaje').click();    
 }
    
//Cuando cambia el selecte de tipo de poblacion actualiza la poblacion a seleccionar
$('#select_poblacion').change(function () {
    if($('select[name="select_poblacion"] option:selected').text()=='Todos') {
        $('#label_opcion').html('Selecciono todos los estudiantes');
        $('#grupo-sel-container').hide();
    }   
    if($('select[name="select_poblacion"] option:selected').text()=='Semestre') {
        $('#label_opcion').html('Seleccione semestre(s)');
        $('#grupo-sel-container').show();
    }
    if($('select[name="select_poblacion"] option:selected').text()=='Grupo') {
        $('#label_opcion').html('Seleccione Grupo(s)');
        $('#grupo-sel-container').show();
    }
        
    $.post(baseurl+"Comunicados/get_poblacion_sel",
        {   
            tipo_sel:$('#select_poblacion').val(),
            carrera:$('#carrera').val(),
        }, 
        function(data){
            $('#grupo_sel').html(data);
            $(".standardSelect").trigger("chosen:updated");            
        });
});

jQuery(document).ready(function() {
    jQuery(".standardSelect").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, no se encontró ningún resultado!",
        width: "100%"
    });
});

jQuery(document).ready(function() {

    if($('select[name="select_poblacion"] option:selected').text()=='Todos') {
        $('#grupo-sel-container').hide();
    } else {
        $('#grupo-sel-container').show();
    }
    $('#docente_chosen ul').addClass("form-control");
    $('#grupo_sel_chosen ul').addClass("form-control");
    
    CKEDITOR.replace('editor1', {
        language: 'es'
    });

    $("#form_registro").submit(function(e){
        e.preventDefault();

        if(validar()) {
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"), 
                data: {
                    titulo:$('#titulo').val()
                    ,tema:$('#tema').val()
                    ,'docente[]':$("#docente.standardSelect").chosen().val()
                    ,carrera:$('#carrera').val()
                    ,select_poblacion:$('#select_poblacion').val()
                    ,'grupo_sel[]':$("#grupo_sel.standardSelect").chosen().val()
                    ,editor1:CKEDITOR.instances['editor1'].getData()
                    ,descripcion:$("#descripcion").val()
                    ,coment:$('#coment').prop('checked')
                    ,activo:$('#activo').prop('checked')
                    ,id_post_modificado:$("#id_post_modificado").val()
                },
                success:function(data){ 
                    console.log("success ajax reg es: "+data+" eso");

                    if(data=='exito') {
                        if($("#id_post_modificado").val() != '0') {
                            mensajes('exito_modificacion');
                        } else {
                            mensajes('exito');
                        }
                    }
                    else {
                        mensajes('no_exito');
                    }
                }
            }); 
            
        }
        
        return false;
    });

});

function limpiar_errores() {
    $("#titulo" ).removeClass("is-invalid");
    $("#tema" ).removeClass("is-invalid");
    $('#docente_chosen ul').removeClass("is-invalid-chosen");
    $('#grupo_sel_chosen ul').removeClass("is-invalid-chosen");
    $('#cke_editor1').removeClass("is-invalid-chosen");
    $('#descripcion').removeClass("is-invalid");
}

mensage = {
    cabecera    :'<h1><span class="fa fa-exclamation-triangle"></span></h1><span> <strong>¡Cuidado!</strong> Los siguientes campos se encuentran incompletos:</span><ul class="text-left" style="padding-left: 15px;">',
    pie         :'</ul> No podrá proseguir si no corrige estos errores.',
    titulo      : '<li> Debe introducir un título para el Post.</li>',
    titulo_existe      : '<li> EL título introducido ya esta registrado en la base de datos.</li>',
    tema        : '<li> Debe introducir el tema para el Post.</li>',
    seleccion_doc   : '<li> Debe seleccionar como minimo un autor.</li>',
    seleccion_grup  : '<li> Debe seleccionar por lo menos un elemento de la población.</li>',
    contenido   : '<li> Debe introducir contenido para el Post.</li>',
    descripcion   : '<li> Debe introducir una descripcion del Post.</li>',
    exito       : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Se registró correctamente el Post.</span>',
    exito_modificacion       : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Se modificó correctamente el Post.</span>',
    no_exito  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> No se pudo registrar el Post. Comuníquese con el Administrador del sistema.</span>',
    alerta_existe_titulo  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> El título <strong id="titulo_intro"></strong> ya existe registrado en la  <strong>Base de Datos</strong>, por favor ingrese otro titulo.</span>',
    };

function validar() {
    limpiar_errores();
    control=true;
    alerta=mensage.cabecera;
    if($('#titulo').val().length<=0)
    {
        $("#titulo" ).addClass("is-invalid");
        alerta+=mensage.titulo;
        control=false;
    }
    if(titulo_existe)
    {
        $("#titulo" ).addClass("is-invalid");
        alerta+=mensage.titulo_existe;
        control=false;
    }
    if($('#tema').val().length<=0)
    {
        $("#tema" ).addClass("is-invalid");
        alerta+=mensage.tema;
        control=false;
    }

    if($("#docente_chosen .search-choice").length<=0)
    {
        $('#docente_chosen ul').addClass("is-invalid-chosen");
        alerta+=mensage.seleccion_doc;
        control=false;
    }

    if($('select[name="select_poblacion"] option:selected').text()!='Todos') {
        if($("#grupo_sel_chosen .search-choice").length<=0)
        {
            $('#grupo_sel_chosen ul').addClass("is-invalid-chosen");
            alerta+=mensage.seleccion_grup;
            control=false;
        }
    }

    if(CKEDITOR.instances['editor1'].getData().length<=0)
    {
        $('#cke_editor1').addClass("is-invalid-chosen");
        alerta+=mensage.contenido;
        control=false;
    }

    if($('#descripcion').val().length<=0)
    {
        $("#descripcion" ).addClass("is-invalid");
        alerta+=mensage.descripcion;
        control=false;
    }

    if(!control)
        mensajes('alerta_error',alerta+mensage.pie);
   return control;
}
</script>