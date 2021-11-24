<?php
    $resp = ''; 

    if(isset($_POST['crear'])){
        if($_POST['crear'] == 'create'){
            if(isset($_POST['nombre'])){

                $name = $_POST['nombre'];
                $message = '';

                $my_dir = "archivos/$name";

                if(!is_dir($my_dir)) {

                    mkdir($my_dir);

                } else {

                    $my_dir = substr($my_dir, 9);
                    $message = "El directorio <b>$my_dir</b> ya existe!";
                }

            } else {
                $message = '';
            }
        } else {
            $message = '';
        }
    } else {
        $message = '';
    }

    unset($_POST['crear']);
    unset($_POST['nombre']);

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

    ?>


    <div class="container">

    <p><b>Directorios</b></p>
        <hr>

        <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Crear directorio
        </button>
        </p>
        <div class="collapse" id="collapseExample">
            <form action="index.php" method="post">
                <input type="text" name="nombre" styles="padding: 2px 4px 2px 4px">
                <button type="submit" name="crear" value="create" styles="margin-left: 20px;">Crear</button>
            </form> 
            <br>               
        </div>

        <p><?php echo $message ?></p>

        <div class="row">

            <?php 

                $directorio = 'archivos';
                $ficheros1  = scandir($directorio);

                foreach($ficheros1 as $valor){
                    if ('.' !== $valor && '..' !== $valor){

            ?>

                <div class="col">
                    <div class="card" style="width: 12rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $valor ?></h5>
                            <a href="directorio.php?dir=<?php echo $valor ?>" class="card-link">Ver</a>
                        </div>
                    </div>
                </div>

            <?php
                    }
                }
            ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>