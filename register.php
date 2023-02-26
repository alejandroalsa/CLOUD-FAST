<?php
  require('actions/register.php');
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLOUD~FAST | Register</title>
    <link rel="shortcut icon" href="assets/brand/cloud_fast-logo.svg" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      .highlight {
      background-color: yellow;
      font-weight: bold;
      }
      .highlight {
      background-color: yellow;
      font-weight: bold;
      }
    </style>

  <link href="assets/dist/css/login&register.css" rel="stylesheet">
  </head>
  <body class="text-center">


    <main class="m-auto">
    <?php if ($error): ?>
      <div class=" fixed-top alert alert-danger bg-danger text-light alert-dismissible" role="alert" style="border: 0;border-radius: 0;">
        <?= $error ?>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
      <form  method="POST" action="register.php">
        <img class="mb-4" src="assets/brand/cloud_fast-logo.svg" alt="CLOUD~FAST LOGO" width="100" height="100">
        <h1 class="h3 mb-3 fw-normal">REGISTRARSE</h1>
        <div class="form-floating mt-2">
          <input type="text" class="form-control" id="user" name="user" placeholder="cloudfast" required>
          <label for="user">Usuario</label>
        </div>
        <div class="form-floating mt-2">
          <input type="email" class="form-control" id="email" name="email" placeholder="cloudfast@cloudfast.es">
          <label for="email">Email</label>
        </div>
        <div class="form-floating mt-2">
          <input type="password" class="form-control" id="password" name="password" placeholder="....." required>
          <label for="password">Contraseña</label>
        </div>
        <div class="checkbox mb-3 mt-3">
        <div class="form-check">
          <input type="checkbox" value="Aceptada" id="policy_terms " name="policy_terms" required > Acepto la <a href="#">Política de privacidad</a>
          <label class="form-check-label" for="policy_terms"></label>
          <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
        <p class="mt-5 mb-5 text-muted">&copy; Todos los derechos reservados |  CLOUD~FAST | <a href="https://diwes.es">DIWES</a> | 2023-2023</p>
      </form>
    </main>    
  </body>
</html>

