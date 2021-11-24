<?php
    $dir = $_GET['dir'];
    $note = $_GET['note']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/css/styles.css" rel="stylesheet" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <?php 

        include_once('partials/navbar.php');

        $file = "archivos\\" . $dir . '\\' . $note;
        $gestor = fopen($file, "r");
        $size = filesize($file);
        if($size > 0){
            $contents = fread($gestor, filesize($file));
        } else {
            $contents = '';
        }
        fclose($gestor);



    ?>

    <div class="container">

        <p><b>Directorios > <?php echo $dir ?> > <?php echo $note ?></b></p>
            <hr>
            <br>

            <form action="process/guardar.php" method="post" name="save">

                <p style='text-align:center'>Toca para editar</p>

                <textarea name="valor-nota" id="" cols="30" rows="10"><?php echo $contents; ?></textarea>
                <input type="hidden" name="directorio" value="<?php echo $dir; ?>">
                <input type="hidden" name="nota" value="<?php echo $note; ?>">

                <br>

                <div class="d-grid gap-2 col-4 mx-auto">
                    <button class="btn btn-primary" type="submit" name="save" value="salvar">Guardar</button>
                </div>

            </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>