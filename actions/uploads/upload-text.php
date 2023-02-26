
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

    $url = $_SERVER['HTTP_REFERER'];

    $user_data = $con->prepare("SELECT * FROM users WHERE id = {$_SESSION['user']['id']}");
    $user_data->execute();
    $user = $user_data->fetch(PDO::FETCH_ASSOC);


    if ($user_data->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["textTitle"]) || empty($_POST["textArea"])) {
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Por favor rellene todos los campos.", "title" => "ERROR"];
            header("Location: $url");
            return; 
        }else {

            $statement = $con->prepare("INSERT INTO texts (user_id, texts, texts_title, upload_date) VALUES (:user_id, :texts, :texts_title, :upload_date)");
            $statement->execute([
                ":user_id" => $_SESSION['user']['id'],
                ":texts_title" => $_POST["textTitle"],
                ":texts" => $_POST["textArea"],
                ":upload_date" => $data,
            ]);
            $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "El texto se ha guardado correctamente", "title" => "EXITO"];
            header("Location: $url");
            return;  
        }
    }
?>
