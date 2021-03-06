<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CETA Admin - <?=$titulo;?></title>
    <meta name="description" content="CETA SGA - Módulo administrador de contenidos">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="icon" type="image/gif" href="<?=base_url()?>plantillas/img/favicon.gif">

    <script src="<?= base_url()?>plantillas/js/vendor/jquery-2.1.4.min.js"></script>
    <!-- <script src="<?= base_url()?>plantillas/js/vendor/jquery.min.js"></script> -->
    <script src="<?= base_url()?>plantillas/js/popper.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/plugins.js"></script>
    <script src="<?= base_url()?>plantillas/js/main.js"></script>

    <script src="<?= base_url()?>plantillas/js/bootstrap.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/datatables.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/jszip.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/pdfmake.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/lib/data-table/datatables-init.js"></script>
    
    <script src="<?=base_url()?>plantillas/js/lib/chosen/chosen.jquery.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/bootstrap-datepicker.min.js"></script>
    
    <!-- <link rel="shortcut icon" href="favicon.ico"> -->

    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/normalize.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url()?>plantillas/css/flag-icon.min.css"> -->
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>plantillas/css/lib/datatable/dataTables.bootstrap.min.css">
    
    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    
    

     <?php
        if(isset($header_links)) {
            $this->load->view($header_links);
        }
    ?>

