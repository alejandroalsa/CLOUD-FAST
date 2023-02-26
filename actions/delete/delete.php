<?php

    require "../conection_db/db-conection.php";

    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: ../../login.php");
        return;
    }

    if (isset($_GET['file']) && isset($_GET['id']) && isset($_GET['table'])) {
        $file_path = realpath($_GET['file']);
        $file_id = ($_GET['id']);
        $file_table = ($_GET['table']);

        if (file_exists($file_path)) {
            unlink($file_path);
            $con->prepare("DELETE FROM $file_table WHERE id = :id")->execute([":id" => $file_id]); 
            $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "El archivo ha sido eliminado correctamente", "title" => "ELIMINADO"];
        } else {
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Ha ocurrido algo inesperado y no se ha podido eliminar el archivo", "title" => "ERROR"];
        }
    }

    header("Location: ../../index.php");
    return;
?>
