
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Lista de Articulos</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Titulo</th>
                        <th>Tema</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Editar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach($entradas as $item):
                        $url = 'blog/editar_entrada/' . $item->id_entrada;
                      ?>
                      <tr>
                        <td><?= $item->titulo; ?></td>
                        <td><?= $item->tema; ?></td>
                        <td><?= $item->cod_docente; ?></td>
                        <td><?= $item->fecha; ?></td>
                        <td><?= anchor($url,'editar');?></td>
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