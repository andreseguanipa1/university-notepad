<?php

if(isset($_POST['save'])){
    if($_POST['save'] == "salvar"){
        if(isset($_POST['directorio']) && isset($_POST['nota']) && isset($_POST['valor-nota'])){

            $dir = $_POST['directorio'];
            $note = $_POST['nota'];
            $content = $_POST['valor-nota'];

            try{

                $file = "..\\archivos\\" . $dir . '\\' . $note;
                $gestor = fopen($file, "w");

                //...

                fwrite($gestor, $content);
                fclose($gestor);

                header('Location: ../index.php');

            }catch (Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }


        }else {
            header('Location: ../index.php');
        }
    }else {
        header('Location: ../index.php');
    }
}else {
    header('Location: ../index.php');
}


?>