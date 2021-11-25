<?php
    if(isset($_GET['dir'])){
        $dir = $_GET['dir'];
        $message = "";

        if(isset($_POST['crear-nota'])){
            if($_POST['crear-nota'] == 'create'){
                if(isset($_POST['nombre-nota']) && isset($_POST['valor-nota-1']) && isset($_POST['directorio'])){
    
                    $message = '';
                    $name = $_POST['nombre-nota'];
                    $directorio = $_POST['directorio'];
                    $content = $_POST['valor-nota-1'];
    
                    $my_dir = "archivos/$directorio/$name.txt";

                    if(file_exists($my_dir)){
                        $message = "Ya existe un archivo con el nombre nombre <b>$name</b>";

                    } else{
                        $archivo = fopen($my_dir,'a');
                        fputs($archivo, $content);
                        fclose($archivo);
    
                        header("Location: index.php");
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
    
        unset($_POST['crear-nota']);
        unset($_POST['nombre']);

    }    
    else{
        header("Location: index.php");
    }

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

    <p><b><a href="index.php">Directorios</a> > <?php echo $dir ?></a></b></p>
        <hr>
        <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Crear nota
        </button>
        </p>
        <div class="collapse" id="collapseExample">
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <p><input type="text" name="nombre-nota" placeholder="Nombre" styles="padding: 2px 4px 2px 4px"> .txt</p>
                <textarea name="valor-nota-1" class="valor-nota-1" id="" cols="30" placeholder="Contenido" rows="10"></textarea>
                <br>
                <input type="hidden" name="directorio" value="<?php echo $dir ?>">
                <button type="submit" name="crear-nota" value="create" styles="margin-left: 20px;">Crear</button>
            </form> 
            <br>               
        </div>

        <p><?php echo $message ?></p>

        <div class="row">

            <?php 

                $directorio = "archivos/" . $dir;
                $ficheros1  = scandir($directorio);

                if(count($ficheros1) > 2) {
                    foreach($ficheros1 as $valor){
                        if ('.' !== $valor && '..' !== $valor){

                            $file = "archivos\\" . $dir . '\\' . $valor;
                            $gestor = fopen($file, "r");

                            if(filesize($file) > 0){
                                $contents = fread($gestor, filesize($file));

                                ?>

                                    <div class="col">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $valor ?></h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><?php echo filesize($file) ?> bytes</h6>
                                                <p class="card-text"><i><?php echo substr($contents, 0, 60); ?>...</i></p>
                                                <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link">Ver o editar</a>
                                                <a href="#" class="card-link">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                fclose($gestor);

                            } else{

                                ?>

                                    <div class="col">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $valor ?></h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><?php echo filesize($file) ?> bytes</h6>
                                                <p class="card-text"><b>Sin nada escrito...</b></p>
                                                <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link">Ver o editar</a>
                                                <a href="#" class="card-link">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                fclose($gestor);

                            }
                        }
                    }
                }

            ?>

        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>