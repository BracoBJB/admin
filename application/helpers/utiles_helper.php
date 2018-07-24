<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función array_contiene la creamos
if(!function_exists('docente_es_autor'))
{
    //creamos la funcion
    function docente_es_autor($docente,$array_docentes)
    {
        $result = false;
        foreach($array_docentes as $doc) {
            if($doc->cod_docente == $docente) {
                $result = true;
                break;
            }
        }
        if($result) {
            return 'selected="selected"';
        } else {
            return '';
        }
    }
}

if(!function_exists('es_poblacion_seleccionada'))
{
    //creamos la funcion
    function es_poblacion_seleccionada($id_poblacion,$array_poblacion)
    {
        $result = false;
        foreach($array_poblacion as $poblacion) {
            if($poblacion->item == $id_poblacion) {
                $result = true;
                break;
            }
        }
        if($result) {
            return 'selected="selected"';
        } else {
            return '';
        }
    }
}
//end application/helpers/utiles_helper.php