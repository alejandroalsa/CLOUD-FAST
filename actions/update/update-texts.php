<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../conection_db/db-conection.php";

    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: ../../login.php");
        return;
    }

    $error = null;

    $data=date("Y-m-d H:i:s");

    $url = "../../sections/text.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_GET["id"]) || empty($_POST["textTitle"]) || empty($_POST["textArea"])) {
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "El texto no se ha podido actualizar", "title" => "ERROR"];
            header("Location: $url");
            return;  
        }

        $text_edit = $con->prepare("UPDATE texts SET texts_title = :texts_title, texts = :texts WHERE id = :id");
        $text_edit->execute([
                ":id" => $_GET['id'],
                ":texts_title" => $_POST['textTitle'],
                ":texts" => $_POST['textArea'],
            ],

        );

        $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "El texto se ha actualizado", "title" => "EXITO"];
        header("Location: $url");
        return; 
        }
?>
