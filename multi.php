<?php


require __DIR__.'/vendor/autoload.php';

use \App\file\upload;

if(isset($_FILES['arquivo'])){

    $uploads = Upload::createMultiUpload($_FILES['arquivo']);


    foreach ($uploads as  $obUpload) {
         //Move o arquivo de upload
    $sucesso = $obUpload->upload(__DIR__.'/files',false);

    if($sucesso){

        echo 'Arquivo <strong>'.$obUpload->getBasename().'</strong> enviado com sucesso<br>';
        continue;
    }else{

        echo'problemas ao enviar o arquivo <br>';

    }

        exit;

    }
   
}
   

include __DIR__.'/includes/formularios-multi.php';


?>