<?php


require __DIR__.'/vendor/autoload.php';

use \App\file\upload;

if(isset($_FILES['arquivo'])){

    //instacia de upload
    $obUpload = new Upload($_FILES['arquivo']);

    //$obUpload->setName('novo-arquivo-alterado');

    //gera um nome aleatorio
    $obUpload->generateNewName();

    //Move o arquivo de upload
    $sucesso = $obUpload->upload(__DIR__.'/files',false);

    if($sucesso){
        echo 'Arquivo <strong>'.$obUpload->getBasename().'</strong> enviado com sucesso';
        exit;
    }else{
        die('problemas ao enviar o arquivo');

    }
}
   

include __DIR__.'/includes/formularios.php';


?>