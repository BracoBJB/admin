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
                            <li class="active">Crear Post</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-sm-12 d-none">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div> 

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Formulario de Creación</strong>
                        <!--
                            <small> Form</small>
                        -->
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" action="<?= base_url() ?>master/login">
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del post" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label">Seleccionar un docente</label>

                                <select data-placeholder="Elija un docente..." multiple class="standardSelect form-control" id="doc" name="doc">
                                    <option value=""></option>
                                    <?php if ( isset($docentes))  : ?>
                                        <?php foreach($docentes as $doc): ?>
                                        <option value="<?= $doc['cod_docente'] ?>"><?= $doc['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                Por favor escriba aquí el contenido del post
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="semestre" class=" form-control-label">Semestre</label>
                                <input type="text" id="semestre" placeholder="Ingrese el semestre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tema" class=" form-control-label">Tema</label>
                                <input type="text" id="tema" placeholder="Ingrese el tema" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="country" class=" form-control-label">Comentarios</label>

                                <label class="switch switch-default switch-success ml-5">
                                    <input type="checkbox" class="switch-input" checked="true"> 
                                    <span class="switch-label"></span> 
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>

                </div>
            </div>

        </div> <!-- .content -->