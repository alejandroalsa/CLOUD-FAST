<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require "../conection_db/db-conection.php";

    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: ../../login.php");
        return;
    }

    $url = $_SERVER['HTTP_REFERER'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_GET['id']) || empty($_GET['user_username']) || empty($_POST['user_username_new']) || empty($_POST['user_email_new'])) {
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Por favor, rellene todos los campos", "title" => "ERROR"];
            header("Location: $url");
            return; 
        }

            $user_id = $_GET['id'];
            $user_username = $_GET['user_username'];
            $user_username_new = $_POST['user_username_new'];
            $user_email_new =  $_POST['user_email_new'];

            $edit_storage_directory_multimedia = $con->prepare("UPDATE multimedia SET storage_directory = REPLACE(storage_directory, '/cloud-fast/uploads/{$user_username}', '/cloud-fast/uploads/{$user_username_new}') WHERE storage_directory LIKE '/cloud-fast/uploads/{$user_username}%'");            
            $edit_storage_directory_multimedia->execute();

            $edit_storage_directory_documents = $con->prepare("UPDATE documents  SET storage_directory = REPLACE(storage_directory, '/cloud-fast/uploads/{$user_username}', '/cloud-fast/uploads/{$user_username_new}') WHERE storage_directory LIKE '/cloud-fast/uploads/{$user_username}%'");            
            $edit_storage_directory_documents ->execute();

            $edit_storage_directory_files = $con->prepare("UPDATE files  SET storage_directory = REPLACE(storage_directory, '/cloud-fast/uploads/{$user_username}', '/cloud-fast/uploads/{$user_username_new}') WHERE storage_directory LIKE '/cloud-fast/uploads/{$user_username}%'");            
            $edit_storage_directory_files ->execute();

            $edit_user = $con->prepare("UPDATE users SET user_username = :user_surname, user_email = :user_email WHERE id = :id");            
            $edit_user->execute([
                ":id" => $user_id,
                ":user_surname" => $user_username_new,
                ":user_email" => $user_email_new,
            ]);

            $directorio_antiguo = "/cloud-fast/uploads/{$user_username}";

            $directorio_nuevo = "/cloud-fast/uploads/{$user_username_new}";

            !rename($directorio_antiguo, $directorio_nuevo);

            $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "Datos de usuario actualizados", "title" => "EXITO"];
            header("Location: $url");
            return;
        }
?>
