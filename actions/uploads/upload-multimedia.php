
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

        $file_size = filesize($_FILES['multimedia']['tmp_name']);
        $file_size_gb = round($file_size / 1024 / 1024 / 1024, 20);

        $allowed = array(".jpg", ".jpeg", ".png", ".gif",".bmp", ".tiff", ".mp3", ".wav", ".aac", ".flac", ".m4a", ".mp4", ".avi", ".mkv", ".flv", ".mov", ".wmv", ".gif", ".midi", ".aiff", ".dvd", ".bluray", ".srt", ".svg");

        $filename = $_FILES["multimedia"]["name"];
        $ext = strtolower(substr($filename, strrpos($filename, '.')));
        if (!in_array($ext, $allowed)) {
            $permit = implode(', ', $allowed);
            $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "Solo se permite contenido multimedia con las siguientes extensiones: $permit", "title" => "ERROR"];
            header("Location: $url");
            return;           
        }

        if(isset($_FILES['multimedia'])) {
            $user_storage_directory = $user['storage_directory_user'];
            $ruta = "$user_storage_directory/multimedia/" . $_FILES['multimedia']['name'];

            if(move_uploaded_file($_FILES['multimedia']['tmp_name'], $ruta)) {
                $_SESSION["alert"] = ["estilo" => "success", "icono" => "bi bi-check-circle-fill", "msg" => "El archivo multimedia se ha guardado correctamente", "title" => "EXITO"];
            } else {
                $_SESSION["alert"] = ["estilo" => "danger", "icono" => "bi bi-exclamation-triangle-fill", "msg" => "El archivo multimedia no se ha podido procesar correctamente y no ha sido guardado", "title" => "ERROR"];
            }
        }
        $user_id = $con->query("SELECT * FROM users WHERE id = {$_SESSION['user']['id']}");
        $user_id->execute();
        $user = $user_id->fetch(PDO::FETCH_ASSOC);

        $statement = $con->prepare("INSERT INTO multimedia (storage_directory, size, user_id, upload_date) VALUES (:storage_directory, :size, :user_id, :upload_date)");
        $statement->execute([
            ":user_id" => $_SESSION['user']['id'],
            ":storage_directory" => $ruta,
            ":size" => $file_size_gb,
            ":upload_date" => $data,
        ]);
        header("Location: $url");
        return;  
    }
?>
