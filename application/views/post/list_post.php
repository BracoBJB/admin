<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Lista de Publicaciones</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <a class="btn btn-primary"  href="<?= base_url()?>nuevo_post"><i class="fa fa-plus"></i> Agregar Publicación</a>
                </ol>
            </div>
        </div>
    </div>
</div>      
       
<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                       
                        <div class="card-body">
                  <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Titulo</th>
                        <th>Tema</th>
                        <th>Autor(es)</th>
                        <th>Carrera</th>
                        <th>Poblacion</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Activo</th>
                        <th>Permite Comentarios</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach($posts as $item):
                        //$url = 'lista_post/editar_entrada/' . $item->id_entrada;
                      ?>
                      <tr>
                        <td><?= $item->titulo; ?></td>
                        <td><?= $item->tema; ?></td>
                        <td><?= $item->autor; ?></td>
                        <td><?= $item->carrera; ?></td>
                        <td><?= $item->poblacion; ?></td>
                        <td><?= $item->descripcion; ?></td>
                        <td><?= $item->fecha; ?></td>
                        <td><?= $item->activo=='t'?'Activo':'No Activo'; ?></td>
                        <td><?= $item->permite_comentario=='t'?'Permite':'No Permite'; ?></td>
                        <td>
                          <a class="btn btn-success btn-sm" href="<?= base_url() ?>nuevo_post/editar/<?= $item->id_post ?>" role="button">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-danger btn-sm" href="<?= base_url() ?>nuevo_post/eliminar/<?= $item->id_post ?>" role="button">
                            <i class="fa fa-times"></i>
                          </a>
                        </td>
                      </tr>
                      <?php
                      endforeach;
                      ?>
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <script>
          $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
        </script>