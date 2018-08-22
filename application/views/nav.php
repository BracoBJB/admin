</head>
<body <?=$onLoad?>>
    <?php
    if(!$this->session->userdata('username'))
    {
        redirect(base_url().'admin');
    }
    ?>

        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?= base_url()?>/main"><img src="<?= base_url()?>plantillas/img/logo1.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="<?= base_url()?>/main"><img src="<?= base_url()?>plantillas/img/logo2.png" alt="Logo"></a> 
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li> -->
                    <h3 class="menu-title">Material Académico</h3><!-- /.menu-title -->
                    <li>
                        <a href="<?= base_url()?>/material/material/nuevo"> <i class="menu-icon fa fa-file-text-o"></i>Nuevo </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>/material/material/lista"> <i class="menu-icon fa fa-files-o"></i>Listado</a>
                    </li>

                    <h3 class="menu-title">Comunicados</h3><!-- /.menu-title -->

                    <li>
                        <a href="<?= base_url()?>/comunicados/nuevo"> <i class="menu-icon ti-write"></i>Nuevo </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>/comunicados/lista"> <i class="menu-icon fa fa-list-alt"></i>Listado</a>
                    </li> 
                    <h3 class="menu-title">Post</h3><!-- /.menu-title -->
                    <li>
                        <a href="<?= base_url()?>blog/post"> <i class="menu-icon fa fa-pencil-square"></i>Nuevo </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>blog/lista"> <i class="menu-icon fa fa-th-list"></i>Listado</a>
                    </li> 
                    <li>
                        <a href="<?= base_url()?>blog/comentarios"> <i class="menu-icon fa fa-comments"></i>Moderar comentarios</a>
                    </li> 
                    <li>
                        <a href="<?= base_url()?>blog/lista_blocked"> <i class="menu-icon fa fa-ban"></i>Bloqueados</a>
                    </li> 
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <!-- <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        
                    </div> -->
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?= base_url()?>plantillas/img/admin.jpg" alt="User Avatar">
                            <i class="fa fa-user"></i><?=$user?><i class="fa fa-caret-down"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                                <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                                <a class="nav-link" href="<?=site_url('index/logout')?>"><i class="fa fa-power -off"></i>Desconectarse</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
