<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CETA Admin - Administrador de Contenidos</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/gif" href="<?=base_url()?>plantillas/img/favicon.ico">

    <!-- <link rel="stylesheet" href="<?= base_url()?>plantillas/css/normalize.css"> -->
    <link rel="stylesheet" href="<?= base_url()?>plantillas/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>plantillas/scss/style.css">

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                        <img class="align-content" src="<?= base_url()?>plantillas/img/logo.png" alt="">
                </div>
                <?php                
                    if(($n_user!='')&&($habilitado==''))
                    {
                        echo '<div class="alert alert-danger">Nombre de usuario o contraseña incorrectos...</div>';
                    }
                    if(($n_user!='')&&($habilitado=='false'))
                    {
                        echo '<div class="alert alert-danger">Su cuenta se encuentra deshabilitada. Por favor comuníquese con el Administrador para poder habilitarle su cuenta.</div>';
                    }if(($n_user!='')&&($habilitado=='validado'))
                    {
                        echo '<div class="alert alert-danger">'.form_error('n_user').'</div>';
                    }
                ?>
                <div class="login-form">
                        <?php echo form_open("",array("id" =>"login_form")); ?>
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" id="n_user" name="n_user" class="form-control"  autofocus placeholder="Escribe aqui tu ID usuario" value="<?= set_value('n_user') ?>" required>
                        </div>
                        <div class="form-group">
                           <label>Contraseña</label>
                            <input type="password" id="contrasenia" name="contrasenia" class="form-control" placeholder="Escribe aqui tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Iniciar Sesión</button>
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url()?>plantillas/js/vendor/jquery-2.1.4.min.js"></script>
</body>
</html>
