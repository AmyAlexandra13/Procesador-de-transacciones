<?php
require_once 'heroes/hero.php';
require_once 'FileHandler/IFileHandler.php';
require_once 'FileHandler/FileHandlerBase.php';
require_once 'FileHandler/SerializationFileHandler.php';
require_once 'FileHandler/JsonFileHandler.php';
require_once 'FileHandler/CSVFileHandler.php';
require_once 'helpers/utilities.php';
require_once 'heroes/serviceSession.php';
require_once 'heroes/ServiceCookies.php';
require_once 'heroes/ServiceFile.php';
require_once 'layout/layout.php';

$layout = new Layout(true);
$service = new ServiceFile(true);
$utilities = new Utilities();

$heroes = $service->GetList();


?>

<?php echo $layout->printHeader(); ?>

<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevo-heroe-modal">
           Nueva transaccion
        </button>

<div style="align: left">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevo-tran-modal">
          Subir archivo
        </button>
        </div>

    </div>
</div>

<div class="row">

    <?php if (count($heroes) == 0) : ?>

        <h2>No hay transferencias registradas </h2>

    <?php else : ?>

        <?php foreach ($heroes as $key => $hero) : ?>

            <div class="col-md-10">

            <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Fecha y hora</th>
      <th scope="col">Monto</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?= $hero->Id ?></th>
      <td><?= $hero->TranFecha?></td>
      <td><?= $hero->TranMonto?></td>
      <td><?= $hero->TranDescripcion?></td>
     

      
  <td>    <a href="heroes/edit.php?id=<?= $hero->Id ?>" class="btn btn-primary">Editar</a>
 <a href="#" data-id="<?= $hero->Id ?>" class="btn btn-danger btn-delete">Eliminar</a> </td>
    </tr>
    
  </tbody>
</table>

            </div>

        <?php endforeach; ?>



    <?php endif; ?>



</div>

<div class="modal fade" id="nuevo-heroe-modal" tabindex="-1" aria-labelledby="nuevoHeroeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoHeroeLabel">Nueva transaccion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="heroes/add.php" method="POST">
                    <div class="mb-3">
                   <?php $time = date('d-m-Y H:i:s'); ?>   
                        <label for="tran-fecha" class="form-label">Fecha de la transaccion</label>
                        <input name="TranFecha" value="<?php echo $time ?>" type="text" class="form-control" id="tran-fecha">

                    </div>
                    <div class="mb-3">
                        <label for="tran-monto" class="form-label">Monto</label>
                        <input name="TranMonto" type="text" class="form-control" id="tran-monto">
                    </div>
                    <div class="mb-3">
                        <label for="tran-descripcion" class="form-label">Descripcion</label>
                        <input name="TranDescripcion" type="text" class="form-control" id="tran-descripcion">                      
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="nuevo-tran-modal" tabindex="-1" aria-labelledby="nuevotranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevotranLabel">Nueva transaccion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form enctype="multipart/form-data">
                    <div class="mb-3">
                    <div class="form-group">
                <label for="archivo">Subir archivo</label>
                <input type ="file" class="form-control" id="archivo" name="archivo">
               
            </div>
            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $layout->printFooter(); ?>

<script src="assets/js/site/index/index.js"></script>

