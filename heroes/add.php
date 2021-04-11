<?php
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
require_once 'hero.php';


$isRoot= false;
$prefijo = ($isRoot) ? "heroes/" : "";
$directory = "{$prefijo}data";
$filename = "log";
$log = new LogHandler($directory,$filename);


/*/
 $directory = "heroes/data";
 $filename = "logprueba";

  

$log = new LogHandler($directory,$filename);
 /*/

$service = new ServiceFile();
$utilities = new Utilities();
    if(isset($_POST["TranFecha"]) && isset($_POST["TranMonto"]) && isset($_POST["TranDescripcion"])){

        $hero = new Hero(0,$_POST["TranFecha"],$_POST["TranMonto"],$_POST["TranDescripcion"],true);
        $service->Add($hero);     

        $tiempo = date('d-m-Y H:i:s');

        $loglista = $log->ReadFile();
        $listareal = $service->GetList(); //Tener lista del mismo service
        $Idlog2 = $utilities->getLastElement($listareal); //Pasand el id de la lista

        $escritura = 'Se agrego una transaccion en la fecha de ' . $tiempo . ',el cual el ID es ' . $hero->Id . PHP_EOL;

        if ($loglista !== FALSE) {

            $loglista .=  $escritura;
    
            $log->SaveFile($loglista);
        } else {
            $log->SaveFile($escritura);
        }

 
        header("Location: ../index.php");
        exit();
    }

?>