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
                                <label for="docente" id="label_docente" class=" form-control-label">Seleccione un docente</label>
                                <select class="standardSelect form-control" id="docente" name="docente" data-placeholder="Elija autor(es)...">
                                <?php if ( isset($docentes))
                                {
                                        echo '<option value="0" >Seleccione un docente </option>';

                                    foreach($docentes  -> result() as $doc)
                                    {
                                        echo '<option value="'.$doc->cod_docente.'" >'.$doc->name.' </option>';
                                    }
                                }
                                else
                                        echo '<option value="0" >No existen docentes habilitados en este momento</option>';                                    
                                ?>
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label for="materias" id="label_materia" class=" form-control-label">Seleccione una materia</label>
                                <select class="standardSelect form-control" id="materias" name="materias" data-placeholder="Elija una materia...">
                                    <option value="0" >No hay materias </option>  
                                
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label for="grupo" id="label_grupo" class=" form-control-label">Seleccione grupo(s)</label>
                                <select class="standardSelect form-control" multiple id="grupo" name="grupo[]" data-placeholder="Elija un grupo(s)...">
                                    <option value="0" >No hay grupos </option> 
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo<span  class="fa fa-spinner fa-spin " id="spinner" style="display:none;"></span ></label>
                                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del comunicado" class="form-control" value="<?php if ( isset($get_aviso)) echo $get_aviso->row()->titulo; ?>">
                            </div>
                            <div class="form-group">
                                <label class="switch switch-3d switch-info mr-3"><input type="checkbox" class="switch-input" checked="true" id="archivo"> <span class="switch-label"></span> <span class="switch-handle"></span></label><label class="control-label col-sm-4" for="archivo"> Incluir archivo</label>
                            </div>
                            <div class="input-group">
                               <label class="input-group-prepend ">
                                    <span id="btn_archivo" class="input-group-btn btn btn-primary ">
                                        Seleccione un archivo&hellip; <input type="file" name="file" id="file" style="display: none;">
                                    </span>
                                </label>
                                <input type="text" class="form-control" id="leyenda_files" readonly style="height: 38px" >
                            </div>
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="4" cols="80">
                                <?php if ( isset($get_aviso)) echo $get_aviso->row()->descripcion; ?>
                                </textarea>
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

                        <div class="card-body" id="progres_bar" style="display: none;">
                            <p class="muted">Cargando archivo:</p>
                          <div class="progress mb-2">
                              <div id="barra" class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                          </div>                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_continuar" class="btn btn-primary" data-dismiss="modal">Agregar Otro</button>
                        <button type="button" id="btn_registrar" class="btn btn-primary">Registrar</button>
                        <button type="button" id="btn_ver_lista" class="btn btn-primary" data-dismiss="modal">Ver Lista</button>
                    </div>
                </div>
            </div>
        </div>
<script >
// para la carga de archivos
    function crearPeticion () {
      var peticion = null;
      try {
        peticion = new XMLHttpRequest();
      }catch (IntentarMs) {
        try{
          peticion = new ActiveXObject("Msxml2.XMLHTTP");
        }catch (OtroMs){
          try{
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (fallo) {
            peticion = null;
          }
        }
      }
      return peticion;
    }
    


var titulo_existe=false;
var id_sel="<?php if(isset($id_sel)) echo $id_sel; else echo '';?>";
$('#docente').change(function () {
    get_materias();
})
function get_materias() {
   $.post(baseurl+"material/material/get_materias",
    {  
        cod_pensum:$("#cod_carrera").val(),       
        cod_docente:$("#docente").val(),       
    }, 
    function(data){
       $('#materias').html(data);          
       $('#materias').trigger("chosen:updated");
        get_grupo();
    });
}
$('#materias').change(function () {
    get_grupo();
})
function get_grupo() {
    $.post(baseurl+"material/material/get_grupo",
    {  
        cod_pensum:$("#cod_carrera").val(),       
        cod_docente:$("#docente").val(),       
        sigla_materia:$("#materias").val(),       
    }, 
    function(data){        
        $('#grupo').html(data);          
        $('#grupo').trigger("chosen:updated");
    });
}
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#leyenda_files').val(input.files[0].name);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#archivo").change(function () {
    if($('#archivo').is(':checked'))
    {
        $("#btn_archivo" ).removeClass("btn-secondary").addClass("btn-primary");
        $("#file").attr('disabled',false);
    }
    else
    {
        $("#btn_archivo" ).removeClass("btn-primary").addClass("btn-secondary");
        $("#file").attr('disabled',true);
    }

});
$("#file").change(function () {
    filePreview(this);
});

$('#titulo').blur(function () {
    rectificar_('titulo');
    if($('#titulo').val().length>0)
    {
        $('#titulo').prop('disabled', true);
        $('#spinner').show();
        $.post(baseurl+"material/material/verificar_titulo",
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

function limpiar_errores() {
    $("#titulo" ).removeClass("is-invalid");
    $("#label_grupo").css("color", "");
    $("#label_docente").css("color", "");
    $("#label_materia").css("color", "");
}
function validar() {
    var input =$("#file");
    limpiar_errores();
    control=true;
    alerta=mensage.cabecera;
    
    
    if($('#docente').val()=='0')
    {
        $("#label_docente").css("color", "red");
        alerta+=mensage.docente;
        control=false;
    }
    if($('#materias').val()=='0')
    {
        $("#label_materia").css("color", "red");
        alerta+=mensage.materias;
        control=false;
    }
    if($(".search-choice").length<=0)
    {
        $("#label_grupo").css("color", "red");
        alerta+=mensage.seleccion;
        control=false;
    }
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
    if($('#archivo').is(':checked'))
    {
        if ($("#file")[0].files.length == 0)
        {
            alerta+=mensage.archivo;
            control=false;
        }
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
    // console.log('hasta aqui');
});

function registrar_comunicado() {

    mensajes('seguro_registrar');                     

    // $.post(baseurl+"Comunicados/registrar",
    // {   
    //     carrera:$('#cod_carrera').val(),
    //     docente:$('#docente').val(),
    //     materias:$('#materias').val(),
    //     grupo_sel:$(".standardSelect").chosen().val(),
    //     select_poblacion:$('#select_poblacion').val(),
    //     titulo:$('#titulo').val(),
    //     incluir_archivo:$('#archivo').is(':checked'),
    //     fecha_fin:$('#fecha_fin').val(),
    //     contenido:CKEDITOR.instances['editor1'].getData(),
    //     habilitado:$('#habilitado').prop('checked'),
    //     prioridad:$('#prioridad').val(),
    // }, 
    // function(data){
    //     if(data=='exito')
    //     {
    //         mensajes('exito');
    //     }
    //     else
    //         mensajes('no_exito');                     
    // });    
}
$('#btn_registrar').click(function () {
    $("#contenido_mensages").attr("class","alert alert-info text-center");
        $('#contenido_mensages').html(mensage.registrando);
                $('#modalTitle').html('Registrando datos');
                $("#progres_bar").show();    
                $("#btn_registrar").attr('disabled',true);    
                // $("#btn_cancelar").show();
                $('#barra').attr('aria-valuenow', '15%').css('width','15%');
                $('#barra').html('15%');
    var archivo = document.getElementById("file");
    var informacion = new FormData();
      informacion.append("archivo", archivo.files[0]);
      var peticion = crearPeticion();
      if(peticion == null){
        alert("Tu navegaddor no es compatible");
        return;
      }
      peticion.addEventListener("load", function() {
        $("#barra" ).removeClass("bg-info").addClass("bg-success");
        $('#barra').attr('aria-valuenow', '100%').css('width','100%');
        $('#barra').html('100%');
      });
      peticion.upload.addEventListener("progress", function(e) {
        var p = Math.round((e.loaded/e.total)*100);
        $('#barra').attr('aria-valuenow', p+'%').css('width',p+'%');
        $('#barra').html(p+'%');
      });
      peticion.addEventListener("error", function() {
        alert("Error al subir el archivo");
      });
      peticion.addEventListener("abort", function() {
        alert("La subida se aborto, por favor intenta de nuevo");
      });
      peticion.open("POST",baseurl+"material/material/subir");
      peticion.send(informacion);                    
    
    
});
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
$('#btn_ver_lista').click(function () {
    $(location).attr('href',baseurl+'/material/material/lista');
});
$('#btn_continuar').click(function () {
    $(location).attr('href',baseurl+'/material/material/nuevo');
});
$('#btn_limpiar').click(function () {
    $(location).attr('href',baseurl+'/material/material/nuevo');
});
function limpiar_campos() {
}
mensage = {
    cabecera    :'<h1><span class="fa fa-exclamation-triangle"></span></h1><span> <strong>¡Cuidado!</strong> Los siguientes campos se encuentran incompletos:</span><ul class="text-left" style="padding-left: 15px;">',
    pie         :'</ul> No podrá proseguir si no corrige estos errores.',
    titulo      : '<li> Debe introducir un título para el Material.</li>',
    titulo_existe      : '<li> EL título introducido ya existe para la carrera seleccionada.</li>',
    docente     : '<li> Debe seleccionar el Docente que esta solicitando la publicación del Material.</li>',
    materias     : '<li> Debe seleccionar la Materia a la que pertenece el Material.</li>',
    seleccion   : '<li> Seleccione el o los Grupos a los que va destinado este Material.</li>',
    archivo   : '<li> Seleccione un Archivo para publicarlo.</li>',
    contenido   : '<li> Introduzca una descripción del Material a publicar.</li>',
    exito       : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> Se registró correctamente el Material.</span>',
    no_exito  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> No se pudo registrar el Material. Comuníquese con el Administrador del Sistema.</span>',
    alerta_existe_titulo  : '<h1><span class="fa fa-exclamation-triangle"></span></h1><span class="text-left"> El título <strong id="titulo_intro"></strong> ya existe registrado en la carrera: <strong>'+$('#cod_carrera option:selected').text()+'</strong>, verifique sus datos.</span>',
    seguro_registrar  : '<h1><span class="fa fa-question"></span></h1><span class="text-left"> Está seguro de querer registrar este Material Académico?</span>',
    registrando  : '<h1><span class="fa fa-question"></span></h1><span class="text-left"> Espere por favor, se están registrando los datos</span>',
    };
function mensajes(tipo, data) {
    $("#btn_cancelar").hide();
    $("#btn_continuar").hide();
    $("#btn_ver_lista").hide();    
    $("#btn_registrar").hide();    
    $("#progres_bar").hide();    
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
    if(tipo=='seguro_registrar')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(mensage.seguro_registrar);
                $('#modalTitle').html('Esta seguro de registrar');
                $("#btn_registrar").attr('disabled',false);    
                $("#btn_registrar").show();    
                $("#btn_cancelar").show();
    }
    if(tipo=='registrando')
    {
        $("#contenido_mensages").attr("class","alert alert-warning text-center");
        $('#contenido_mensages').html(mensage.registrando);
                $('#modalTitle').html('Registrando datos');
                $("#progres_bar").show();    
                $("#btn_registrar").attr('disabled',true);    
                $("#btn_cancelar").show();
    }
    $('#btn_mensaje').click();    
 }
</script>