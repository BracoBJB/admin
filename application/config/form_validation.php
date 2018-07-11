<?php

$config['error_prefix'] = '<span class="badge badge-pill badge-danger">Error</span>';
$config['error_suffix'] = '<br>';
$config['blog/validar'] = array(
    array(
        'field' => 'titulo',
        'label' => 'Titulo del Post',
        'rules' => 'trim|required|strip_tags|callback_check_titulo'
    )
    ,array(
        'field' => 'tema',
        'label' => 'Tema',
        'rules' => 'trim|required|strip_tags'
    )
    ,array(
        'field' => 'docente',
        'label' => 'Nombre de docente',
        'rules' => 'required'
    )
    ,array(
        'field' => 'semestre',
        'label' => 'Semestre',
        'rules' => 'required'
    )
);