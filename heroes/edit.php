<?php
require_once 'hero.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/SerializationFileHandler.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../FileHandler/CSVFileHandler.php';
require_once '../FileHandler/LogHandler.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';
require_once 'ServiceFile.php';

$isRoot= false;
$prefijo = ($isRoot) ? "heroes/" : "";
$directory = "{$prefijo}data";
$filename = "log";
$log = new LogHandler($directory,$filename);

$layout = new Layout();
$service = new ServiceFile();
$utilities = new Utilities();

$hero = null;

if (isset($_GET["id"])) {

    $hero = $service->GetById($_GET["id"]);
}


if(isset($_POST["heroId"],$_POST["TranFecha"]) && isset($_POST["TranMonto"]) && isset($_POST["TranDescripcion"])){

   
    $hero = new Hero($_POST["heroId"], $_POST["TranFecha"], $_POST["TranMonto"], $_POST["TranDescripcion"]);

    $service->Edit($hero);

    $tiempo = date('d-m-Y H:i:s');

    $loglista = $log->ReadFile();
    $listareal = $service->GetList(); //Tener lista del mismo service
    $Idlog2 = $utilities->getLastElement($listareal); //Pasand el id de la lista

    $escritura = 'Se edito una transaccion en la fecha de ' . $tiempo . ',el cual el ID es ' . $hero->Id . PHP_EOL;

    if ($loglista !== FALSE) {

        $loglista .=  $escritura;

        $log->SaveFile($loglista);
    } else {
        $log->SaveFile($escritura);
    }

    header("Location: ../index.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo $layout->printHeader() ?>

    <?php if ($hero == null) : ?>
        <h2>No existe esta transaccion</h2>
    <?php else : ?>

        <form action="edit.php" method="POST">

        <input type="hidden" name="heroId" value="<?= $hero->Id ?>">
                    <div class="mb-3">
                        <label for="tran-fecha" class="form-label">Fecha de la transaccion</label>
                        <input name="TranFecha" value="<?php echo $hero->TranFecha ?>" type="text" class="form-control" id="tran-fecha">

                    </div>
                    <div class="mb-3">
                        <label for="tran-monto" class="form-label">Monto</label>
                        <input name="TranMonto" value="<?php echo $hero->TranMonto ?>" type="text" class="form-control" id="tran-monto">
                    </div>
                    <div class="mb-3">
                        <label for="tran-descripcion" class="form-label">Descripcion</label>
                        <input name="TranDescripcion" value="<?php echo $hero->TranDescripcion ?>" type="text" class="form-control" id="tran-descripcion">                      
                    </div>
         
            <a href="../index.php" class="btn btn-warning">Volver atras </a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    <?php endif; ?>




    <?php echo $layout->printFooter() ?>

</body>

</html>