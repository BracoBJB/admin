 <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1><?php if ( isset($titulo)) echo $titulo; ?></h1>
            </div>
        </div>
    </div>
    
</div>
<div class="content mt-3">
            <!-- <div class="animated fadeIn"> -->
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <form action="" method="post" action="<?= base_url() ?>master/login">
                           <div class="form-group">
                                <label for="carrera" class=" form-control-label">Carrera</label>
                                <select class="form-control" id="cod_carrera" name="carrera">
                                    <?php
                                        if($carreras!=null)
                                        {   $carrera_aux='';
                                            if ( isset($get_aviso))
                                                 $carrera_aux=$get_aviso->row()->carrera;
                                            foreach ($carreras -> result() as $fila) 
                                            {
                                                if($carrera_aux==$fila->cod_carrera)
                                                    echo '<option value="'.$fila->cod_carrera.'" selected="true">'.$fila->nombre_carrera.' </option>';
                                                else
                                                    echo '<option value="'.$fila->cod_carrera.'" >'.$fila->nombre_carrera.' </option>';
                                            }
                                        }
                                    ?>                                  
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="select_poblacion" class=" form-control-label">Tipo de Población</label>
                                <select name="select_poblacion" id="select_poblacion" class="form-control">
                                    <?php
                                        if($tipo_poblacion!=null)
                                        {   
                                            $tipo_pob_aux='';
                                            if ( isset($get_aviso))
                                                 $tipo_pob_aux=$get_aviso->row()->id_poblacion;
                                            foreach ($tipo_poblacion -> result() as $fila) 
                                            {   
                                                if($tipo_pob_aux==$fila->id_poblacion)
                                                    echo '<option value="'.$fila->id_poblacion.'" selected="true">'.$fila->nombre.'</option>';  
                                                else  
                                                    echo '<option value="'.$fila->id_poblacion.'" >'.$fila->nombre.'</option>';  
                                            }
                                        }
                                    ?>   
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label" id="label_opcion">Selecciono todos los estudiantes</label>

                                <select data-placeholder="Elija una opción..." multiple class="standardSelect form-control" id="grupo_sel" name="grupo_sel">
                                    <?php if ( isset($var_modific)) echo $var_modific; else echo '<option value="Todos" selected="selected">Todos</option>';?>    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label"  for="fecha_ini">Fecha publicación</label>
                                <div class="" id="sandbox-container">
                                    <div class="input-daterange form-group input-group" id="datepicker" style="margin-left: 1px;">
                                        <span class="input-group-addon" style="background-color: white;">Fecha Inicial:</span><input type="text" class="form-control" name="start" id="fecha_ini" readonly placeholder="Fecha inicial" value="<?php if ( isset($get_aviso)) 
                                            {
                                                $fecha_nueva= explode("-", $get_aviso->row()->fecha_ini);
                                                echo $fecha_nueva[2].'/'.$fecha_nueva[1].'/'.$fecha_nueva[0];
                                            }
                                        else echo date('d/m/Y'); ?>">
                                        <span class="input-group-addon" style="background-color: white;">Fecha Final:</span>
                                        <input type="text" class="form-control" name="end" id="fecha_fin" readonly placeholder="Fecha final" value="<?php if ( isset($get_aviso)) 
                                            {
                                                $fecha_nueva= explode("-", $get_aviso->row()->fecha_fin);
                                                echo $fecha_nueva[2].'/'.$fecha_nueva[1].'/'.$fecha_nueva[0];
                                            }
                                        else echo date('d/m/Y'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prioridad" class=" form-control-label">Prioridad</label>
                                <select data-placeholder="Elija una opción..." class="form-control" id="prioridad" name="prioridad">
                                    <?php
                                        if($prioridad!=null)
                                        {   
                                            $id_prio_aux='';
                                            if ( isset($get_aviso))
                                                 $id_prio_aux=$get_aviso->row()->prioridad;
                                            foreach ($prioridad -> result() as $fila) 
                                            {   
                                                if($id_prio_aux==$fila->id_prioridad)
                                                    echo '<option value="'.$fila->id_prioridad.'" selected="true">'.$fila->nombre.'</option>';  
                                                else  
                                                    echo '<option value="'.$fila->id_prioridad.'" >'.$fila->nombre.'</option>';  
                                            }
                                        }
                                    ?>     
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo<span  class="fa fa-spinner fa-spin " id="spinner" style="display:none;"></span ></label>
                                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del comunicado" class="form-control" value="<?php if ( isset($get_aviso)) echo $get_aviso->row()->titulo; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                <?php if ( isset($get_aviso)) echo $get_aviso->row()->descripcion; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="habilitado" class=" form-control-label">Habilitado </label>
                                    <label class="switch switch-3d switch-info"><input type="checkbox" class="switch-input" id="habilitado" <?php if ( isset($get_aviso)) 
                                    {if($get_aviso->row()->habilitado=='t') echo 'checked';} 
                                    else echo 'checked';
                                     ?>>
                                     <span class="switch-label"></span><span class="switch-handle"></span></label>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <?php if ( isset($var_modific)) 
                                echo '<button type="submit" class="btn btn-primary btn-sm" id="modificar"><i class="fa fa-edit"></i> Modificar </button>';
                            else
                                echo '<button type="submit" class="btn btn-primary btn-sm" id="registrar"><i class="fa fa-check"></i> Registrar </button>';
                         ?>
                        
                        
                        <button type="reset" class="btn btn-success btn-sm" id="btn_limpiar">
                            <i class="fa fa-refresh"></i> Limpiar
                        </button>
                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#modalMensajes" id="btn_mensaje" style="display: none;"> <!-- no quitareste botón -->
                          Small
                      </button>
                    </div>

                </div>
                </div>
                    
                </div>
                  
            </div><!-- .animated -->
        </div> 
        
        <div class="modal fade show" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                        <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_continuar" class="btn btn-primary" data-dismiss="modal">Agregar Otro</button>
                        <button type="button" id="btn_ver_lista" class="btn btn-primary" data-dismiss="modal">Ver Lista</button>
                    </div>
                </div>
            </div>
        </div>
<script >

var titulo_existe=false;
var id_sel="<?php if(isset($id_sel)) echo $id_sel; else echo '';?>";

$('#titulo').blur(function () {
    rectificar_('titulo');
    if($('#titulo').val().length>0)
    {
        $('#titulo').prop('disabled', true);
        $('#spinner').show();
        $.post(baseurl+"Comunicados/verificar_titulo",
        {   
            titulo:$('#titulo').val(),
            cod_carrera:$('#cod_carrera').val(),
        }, 
        function(data){
            if(data=='0')
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

$('#select_poblacion').change(function () {
    get_poblacion_sel();
});
function get_poblacion_sel() {
    if($('select[name="select_poblacion"] option:selected').text()=='Grupo')
        $('#label_opcion').html('Seleccione Grupo(s)');
    if($('select[name="select_poblacion"] option:selected').text()=='Semestre')
        $('#label_opcion').html('Seleccione semestre(s)');
    if($('select[name="select_poblacion"] option:selected').text()=='Todos')
    {
        $('#label_opcion').html('Selecciono todos los estudiantes');
        $('#grupo_sel').html('<option value="Todos">Todos</option>');
        $(".standardSelect").trigger("chosen:updated");          
    }
    else
    {
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
}
function limpiar_errores() {
    $("#titulo" ).removeClass("is-invalid");
    $("#label_opcion").css("color", "");
}
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
    if($(".search-choice").length<=0)
    {
        $("#label_opcion").css("color", "red");
        alerta+=mensage.seleccion;
        control=false;
    }
    if(CKEDITOR.instances['editor1'].getData().length<=0)
    {
        alerta+=mensage.contenido;
        control=false;
    }
    if(!control)
        mensajes('alerta_error',alerta+mensage.pie);
   return control;
}
$('#registrar').click(function () {
    
    if(validar())
        registrar_comunicado();
});

function registrar_comunicado() {
    $.post(baseurl+"Comunicados/registrar",
    {   
        titulo:$('#titulo').val(),
        carrera:$('#cod_carrera').val(),
        select_poblacion:$('#select_poblacion').val(),
        grupo_sel:$(".standardSelect").chosen().val(),
        fecha_ini:$('#fecha_ini').val(),
        fecha_fin:$('#fecha_fin').val(),
        contenido:CKEDITOR.instances['editor1'].getData(),
        habilitado:$('#habilitado').prop('checked'),
        prioridad:$('#prioridad').val(),
    }, 
    function(data){
        if(data=='exito')
        {
            mensajes('exito');
        }
        else
            mensajes('no_exito');                     
    });    
}
$('#modificar').click(function () {
    
    if(validar())
        modificar_comunicado();
});
function modificar_comunicado() {
    $.post(baseurl+"Comunicados/modificar",
    {   
        titulo:$('#titulo').val(),
        carrera:$('#cod_carrera').val(),
        select_poblacion:$('#select_poblacion').val(),
        grupo_sel:$(".standardSelect").chosen().val(),
        fecha_ini:$('#fecha_ini').val(),
        fecha_fin:$('#fecha_fin').val(),
        contenido:CKEDITOR.instances['editor1'].getData(),
        habilitado:$('#habilitado').prop('checked'),
        id:id_sel,
        prioridad:$('#prioridad').val(),
    }, 
    function(data){
        if(data=='exito')
        {
            mensajes('exito');
        }
        else
            mensajes('no_exito');                     
    });    
}
 var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();


$('#sandbox-container input').datepicker({
    clearBtn: true,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    daysOfWeekHighlighted: "0",
            minDate: '0' ,
});

$('#sandbox-container .input-daterange').datepicker({
            minDate: '0' ,
});

$('#btn_ver_lista').click(function () {
    $(location).attr('href',baseurl+'/comunicados/lista');
});
$('#btn_continuar').click(function () {
    $(location).attr('href',baseurl+'/comunicados/nuevo');
});
$('#btn_limpiar').click(function () {
    $(location).attr('href',baseurl+'/comunicados/nuevo');
});
function limpiar_campos() {
}
mensage = {
    cabecera    :'<h1><span class="fa fa-exclamation-triangle"></span></h1><span> <strong>¡Cuidado!</strong> Los siguientes campos se encuentran incompletos:</span><ul class="text-left" style="padding-left: 15px;">',
    pie         :'</ul> No podrá proseguir si no corrige estos errores.',
    titulo      : '<li> Debe introducir un título para el Comunicado.</li>',
    titulo_existe      : '<li> EL título introducido ya existe para la carrera seleccionada.</li>',
    seleccion   : '<li> Seleccione a qué población irá destinado el Comunicado.</li>',
    contenido   : '<li> Introduzca un contenido para el Comunicado.</li>',
    exito       : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Se registró correctamente el Comunicado.</span>',
    no_exito  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> No se pudo registrar el Comunicado. Comuníquese con el Administrador del sistema.</span>',
    alerta_existe_titulo  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> El título <strong id="titulo_intro"></strong> ya existe registrado en la carrera: <strong>'+$('#cod_carrera option:selected').text()+'</strong>, verifique sus datos.</span>',
    };
function mensajes(tipo, data) {
    $("#btn_cancelar").hide();
    $("#btn_continuar").hide();
    $("#btn_ver_lista").hide();    
    if(tipo=='alerta_error')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(data);
                $('#modalTitle').html('Faltan Datos');
                $("#btn_cancelar").show();
    }
    if(tipo=='exito')
    {
        $("#contenido_mensages").attr("class","alert alert-success text-center");
        $('#contenido_mensages').html(mensage.exito);
                $('#modalTitle').html('Registro exitoso');
                $("#btn_cancelar").hide();
                $("#btn_continuar").show();
                $("#btn_ver_lista").show();    
    
    }
    if(tipo=='no_exito')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.no_exito);
                $('#modalTitle').html('Error al registrar');
                $("#btn_cancelar").show();
    }
    if(tipo=='alerta_existe_titulo')
    {
        $("#contenido_mensages").attr("class","alert alert-danger text-center");
        $('#contenido_mensages').html(mensage.alerta_existe_titulo);
                $('#modalTitle').html('Título existe');
                $('#titulo_intro').html(data);
                $("#btn_cancelar").show();
    }
    $('#btn_mensaje').click();    
 }
</script>