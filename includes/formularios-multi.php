<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload de arquivos(multi)</title>
</head>
<body>

    <h1>Upload de arquivos (multi)</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <label>Arquivo</label>
        <input type="file" name="arquivo[]" multiple>

         <br><br>

         <button type="submit"> Enviar</button>

    </form>



</body>
</html>