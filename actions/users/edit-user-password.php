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

        if (empty($_GET['id']) || empty($_POST['new_password']) || empty($_POST['current_password'])) {
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Por favor, rellene todos los campos", "title" => "ERROR"];
            header("Location: $url");
            return; 
        }

            $user_id = $_GET['id'];
            $new_password = $_POST['new_password'];
            $current_password =  $_POST['current_password'];

            // Obtenemos la contraseña del usuario con su ID asociado
            $statement = $con->prepare("SELECT user_password FROM users WHERE id = :id LIMIT 1");
            $statement->execute([":id" => $user_id]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            // En este paso comprobamos que la contraseña introducida por el usuario corresponda a su contraseña actual
            if (!password_verify($current_password, $user["user_password"])) {
                $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Contraseña actual incorrecta", "title" => "ERROR"];
                header("Location: $url");
                return; 
            } else {
            
            // Ejecutamos las consultas SQL, en ellas definimos que por defecto los valores a enviar sean los validados.
            $statement = $con->prepare("UPDATE users SET user_password = :user_password WHERE id = :id");
            $statement->execute([
                    ":user_password" => password_hash($new_password, PASSWORD_BCRYPT),
                    ":id" => $user_id,
                ]
            );

            $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "Datos de usuario actualizados", "title" => "EXITO"];
            header("Location: $url");
            return;
            }
        }
?>
