<?php

    require "../conection_db/db-conection.php";

    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: ../../login.php");
        return;
    }

    if (isset($_GET['id'])) {
        $text_id = ($_GET['id']);
        $con->prepare("DELETE FROM texts WHERE id = :id")->execute([":id" => $text_id]); 
        $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "El texto ha sido eliminado correctamente", "title" => "ELIMINADO"];
    } else {
        $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Ha ocurrido algo inesperado y no se ha podido eliminar el texto", "title" => "ERROR"];
    }

    header("Location: ../../index.php");
    return;
?>
