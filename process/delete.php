<?php


if(isset($_GET['delete'])){
    if($_GET['delete'] == "1"){
        if(isset($_GET['note']) && isset($_GET['dir'])){

            $dir = $_GET['dir'];
            $note = $_GET['note'];

            try{
                $file = "..\\archivos\\" . $dir . '\\' . $note;

                if(unlink($file)){
                    header('Location: ../directorio.php?dir=' . $dir);
    
                } else{
                    header('Location: ../index.php');
    
                }

            }catch (Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }



        } else{
            header('Location: ../index.php');
        }

    } else if($_GET['delete'] == "2"){
        if(isset($_GET['dir'])){

            $dir = $_GET['dir'];

            try{
                $file = "..\\archivos\\" . $dir;

                rmdir($file);
                header('Location: ../index.php');


            }catch (Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }



        } else{
            header('Location: ../index.php');
        }
    }
} else{
    header('Location: ../index.php');
}