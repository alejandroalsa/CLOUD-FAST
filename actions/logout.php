<?php
    session_start();
    session_destroy();
    header("Location: http://cloudfast.diwes.es:8080/login.php");
?>