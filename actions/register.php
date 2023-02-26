<?php
    // Llamamos a "db-conection.php" para conectarnos a la Base de Datos
    require "actions/conection_db/db-conection.php";

    // Definimos una variable para imprimir un mensaje en caso de error y otra para guardar la fecha y hora actuales
    $error = null;
    $registration_date_user=date("Y-m-d H:i:s");
    
    // Definimos que para que se ejecuten el resto de instrucciones, el método de solicitud sea "POST"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Comenzamos con el proceso de validación de los tres campos, en esta primera línea validamos que los tres campos estén rellenos
        if (empty($_POST["user"]) || empty($_POST["email"]) || empty($_POST["password"])) {
            $error = "Por favor rellene todos los campos.";

        // En la segunda línea validamos que el campo de Email contenga un @
        } else if (!str_contains($_POST["email"], "@")) {
            $error = "Formato de Email inválido.";

        // Después de pasar los filtros pasamos al último que es la validacion de Email para comprobar que el email introducido no esté ya registrado
        } else {

            // Con la variable "con", realizamos una consulta para comprobar el email en la Base de Datos
            $statement = $con->prepare("SELECT * FROM users WHERE user_email = :user_email");
            $statement->bindParam(":user_email", $_POST["email"]);
            $statement->execute();

            // Declaramos una condición, en dicha condición declaramos que si el email es mayor que 0 lo que significaría que el email ya está registrado, enviara el error.
            if ($statement->rowCount() > 0) {
                $error = "Este email ya está registrado";
            } else{

                //Después de validar que el email introducido no esté ya registrado, comprobamos que el ID de Empresa introducido no esté ya registrado con la variable "con"
                $statement = $con->prepare("SELECT * FROM users WHERE user_username = :user_username");
                $statement->bindParam(":user_username", $_POST["user"]);
                $statement->execute();

                // Declaramos una condición, en dicha condición declaramos que si el ID de Empresa es mayor que 0 lo que significaría que el ID de Empresa ya está registrado, enviara el error.
                if ($statement->rowCount() > 0) {
                    $error = "Este usuario ya está registrado";
                } else{

                    $directory_uploads = '/cloud-fast/uploads';
                    $folder_user_uploads = $_POST["user"];
                    $folders_user_uploads = 'archives documents multimedia texts';

                    $path_uploads = $directory_uploads . '/' . $folder_user_uploads;

                    if (!is_dir($directory_uploads)) {
                        mkdir($directory_uploads, 0777, true);
                    }
                    
                    if (!empty($folder_user_uploads)) {
                        mkdir($path_uploads, 0777, true);
                    }

                    $carpetas = array("$path_uploads/archives", "$path_uploads/documents", "$path_uploads/multimedia", "$path_uploads/texts");
                    
                    foreach ($carpetas as $carpeta) {
                        if (!file_exists($carpeta)) {
                            mkdir($carpeta, 0777, true);
                        }
                    }
                    
                    //Después de validar todos los datos, preparamos la sentencia SQL para introducir los datos enviados por el usuario
                    $con
                    ->prepare("INSERT INTO users (user_username, user_email, user_password, registration_date_user, policy_terms, storage_directory_user) VALUES (:user_username, :user_email, :user_password, :registration_date_user, :policy_terms, :storage_directory_user)")
                    ->execute([ 
                        ":user_username" => $_POST["user"],
                        ":user_email" => $_POST["email"],
                        ":user_password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                        ":registration_date_user" => $registration_date_user,
                        ":policy_terms" => $_POST["policy_terms"],
                        ":storage_directory_user" => $path_uploads,
                    ]);

                    // Definimos una consulta SQL para darle un valor LIMIT al "user_mail" para que así no se pueda repetir y evitar que un usuario introduzca el mismo email
                    $statement = $con->prepare("SELECT * FROM users WHERE user_email = :user_email LIMIT 1");
                    $statement->bindParam(":user_email", $_POST["email"]);
                    $statement->execute();
                    $user = $statement->fetch(PDO::FETCH_ASSOC);

                    $statement = $con->prepare("SELECT * FROM users WHERE user_username = :user_username LIMIT 1");
                    $statement->bindParam(":user_username", $_POST["user"]);
                    $statement->execute();
                    $user = $statement->fetch(PDO::FETCH_ASSOC);

                    // Despues de hacer todas las comprovaciones iniciamos la Sesión y redirigimos a "home.php"
                    session_start();
                    $_SESSION["user"] = $user;
                    header("Location: index.php");
                }
            }
        }
    }
?>