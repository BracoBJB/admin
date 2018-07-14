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
                    <form method="post" action="<?= base_url() ?>blog/validar">
                    <div class="card-body card-block">
                        
                            <div class="form-group">
                                <label for="titulo" class=" form-control-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del post" class="form-control" value="<?= set_value('titulo') ?>">
                            </div>
                            <div class="form-group">
                                <label for="tema" class=" form-control-label">Tema</label>
                                <input type="text" id="tema" name="tema" placeholder="Ingrese el tema" class="form-control" value="<?= set_value('tema') ?>">
                            </div>
                            <div class="form-group">
                                <label for="vat" class=" form-control-label">Seleccionar un docente</label>

                                <select class="standardSelect form-control" id="docente" name="docente">
                                    <option value="" selected="true">Seleccione un docente</option>
                                    <?php if ( isset($docentes))  : ?>
                                        <?php foreach($docentes as $doc): ?>
                                        <option value="<?= $doc['cod_docente'] ?>" <?= set_select('docente',$doc['cod_docente']) ?> ><?= $doc['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editor1" class="form-control-label">Contenido</label>
                                <textarea name="editor1" id="editor1" rows="10" cols="80">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="semestre" class=" form-control-label">Semestre</label>
                                <select class="standardSelect form-control" id="semestre" name="semestre">
                                    <option value="" selected="true">Seleccione un semestre</option>
                                    <?php if ( isset($semestres))  : ?>
                                        <?php foreach($semestres as $sem): ?>
                                        <option value="<?= $sem['semestre'] ?>" 
                                        <?= set_select('semestre',$sem['semestre']) ?>>
                                        <?= $sem['semestre'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country" class=" form-control-label">Comentarios</label>

                                <label class="switch switch-default switch-success ml-5">
                                    <input type="checkbox" class="switch-input" id="chk_coment" name="coment" value="Permitir Comentarios" <?= set_checkbox('coment','Permitir Comentarios',FALSE) ?> >
                                    <span class="switch-label"></span> 
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                    </form>
                </div>
            </div>

        </div> <!-- .content -->