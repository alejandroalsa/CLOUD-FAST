<?php


  require "../actions/conection_db/db-conection.php";

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  session_start();

  if (!isset($_SESSION["user"])) {
      header("Location: ../login.php");
      return;
  }

    $records = $con->query("SELECT * FROM users WHERE id = {$_SESSION['user']['id']}");
    $user = $records->fetch(PDO::FETCH_ASSOC);

?>


<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLOUD~FAST</title>
    <link rel="shortcut icon" href="../assets/brand/cloud_fast-logo.svg" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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

    
    <!-- Custom styles for this template -->
    <link href="../assets/dist/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">CLOUD~FAST | CUENTA</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
      <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Buscar..." aria-label="Search" id="search-input">
      <button type="button" id="search-button" class="d-none"></button>
      <script>

        function search() {
          var searchInput = document.getElementById('search-input');
          var searchTerm = searchInput.value.toLowerCase();

          var elements = document.getElementsByTagName('p');

          for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            var elementText = element.textContent.toLowerCase();
            var index = elementText.indexOf(searchTerm);

            if (index >= 0) {
              var highlightedText = elementText.substring(index, index + searchTerm.length);
              var beforeText = elementText.substring(0, index);
              var afterText = elementText.substring(index + searchTerm.length);

              element.innerHTML = beforeText + '<span class="highlight">' + highlightedText + '</span>' + afterText;
            } else {
              element.innerHTML = elementText;
            }
          }

          var searchResults = document.getElementById('search-results');
          searchResults.innerHTML = '';

          for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            var elementText = element.textContent.toLowerCase();
            var index = elementText.indexOf(searchTerm);

            if (index >= 0) {
              var result = document.createElement('div');
              result.innerHTML = 'Encontrado en: ' + elementText.substring(Math.max(index - 20, 0), index + searchTerm.length + 20);
              searchResults.appendChild(result);
            }
          }
        }

        var searchButton = document.getElementById('search-button');
        searchButton.addEventListener('click', search);
        var searchInput = document.getElementById('search-input');
        searchInput.addEventListener('keydown', function(event) {
          if (event.keyCode === 13) {
            event.preventDefault();
            search();
          }
        });
      </script>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Cerrar Sesión</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="../index.php" style="font-size: 16px;">
              <i class="bi bi-archive-fill"></i>
              Todo
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="archive.php" style="font-size: 16px;">
              <i class="bi bi-file-earmark-zip-fill fa-x5"></i>
              Archivos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="text.php" style="font-size: 16px;">
              <i class="bi bi-filetype-txt"></i>
              Textos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="multimedia.php" style="font-size: 16px;">
              <i class="bi bi-file-image"></i>
              Multimedia
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documents.php" style="font-size: 16px;">
              <i class="bi bi-filetype-doc"></i>
              Documentos
             </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Cuenta</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="account.php" style="font-size: 16px;">
              <i class="bi bi-person-lines-fill"></i>
              Cuenta -> <?= $user['user_username']?>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../actions/logout.php" style="font-size: 16px;">
              <i class="bi bi-box-arrow-in-left"></i>
              Cerrar Sesión
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>APP Web</span>
        </h6>
        <ul class="nav flex-column mb-2">

          <li class="nav-item">
            <a class="nav-link" href="privacy-policy.php" style="font-size: 16px;">
              <i class="bi bi-journal-bookmark-fill"></i>
              Política de Privacidad
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="version.php" style="font-size: 16px;">
              <i class="bi bi-git"></i>
              Versión 1.0
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="status.php" style="font-size: 16px;">
              <i class="bi bi-server"></i>
              Estado de los Servicios <i class="bi bi-circle-fill" style="color: green;"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

          <section class="section Perfil mt-5">
            <div class="row">
            <?php if (isset($_SESSION["alert"])): ?>
                <div class="alert alert-<?= $_SESSION["alert"]["estilo"]?> d-flex  alert-dismissible mt-3" role="alert">
                  <i class="<?= $_SESSION["alert"]["icono"]?> me-1"></i>
                  <div>
                    <strong><?= $_SESSION["alert"]["title"]?></strong> <?= $_SESSION["alert"]["msg"]?>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION["alert"]) ?>
            <?php endif ?>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
      
                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#Perfil-overview"><h6>Cuenta</h6></button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Perfil-edit"><h6>Editar Cuenta</h6></button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Perfil-change-password"><h6>Cambia Contraseña</h6></button>
                      </li>
      
                    </ul>
                    <div class="tab-content pt-2">
      
                      <div class="tab-pane fade show active Perfil-overview" id="Perfil-overview">
                          <div class="mb-3">
                            <h6 for="formGroupExampleInput" class="form-label">Nombre de Usuario</h6>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?= $user["user_username"]?>" value="<?= $user["user_username"]?>" disabled>
                          </div>
                          <div class="mb-3">
                            <h6 for="formGroupExampleInput2" class="form-label">Correo Electronico</h6>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="<?= $user["user_email"]?>" value="<?= $user["user_email"]?>" disabled>
                          </div>
                      </div>
      
                      <div class="tab-pane fade Perfil-edit pt-3" id="Perfil-edit">
      
                          <form method="POST" action="../../actions/users/edit-user.php?id=<?= $user["id"]?>&user_username=<?= $user["user_username"]?>">
                          <div class="tab-pane fade show active Perfil-overview" id="Perfil-overview">
                            <div class="mb-3">
                              <h6 for="formGroupExampleInput" class="form-label">Nombre de Usuario</h6>
                              <input type="text" class="form-control" id="user_username_new" name="user_username_new" placeholder="<?= $user["user_username"]?>" value="<?= $user["user_username"]?>">
                            </div>
                            <div class="mb-3">
                              <h6 for="formGroupExampleInput2" class="form-label">Correo Electronico</h6>
                              <input type="text" class="form-control" id="user_email_new" name="user_email_new" placeholder="<?= $user["user_email"]?>" value="<?= $user["user_email"]?>">
                            </div>
                          </div>
      
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                            </div>
                          </form>
                      </div>
      
                      <div class="tab-pane fade pt-3" id="Perfil-change-password">
                        <!-- Change Password Form -->
                        <form method="POST" action="../../actions/users/edit-user-password.php?id=<?= $user["id"]?>">
      
                          <div class="tab-pane fade show active Perfil-overview" id="Perfil-overview">
                            <div class="mb-3">
                              <h6 for="formGroupExampleInput" class="form-label">Contraseña Actual</h6>
                              <input type="password" class="form-control" id="current_password" name="current_password" placeholder="**********">
                            </div>
                            <div class="mb-3">
                              <h6 for="formGroupExampleInput2" class="form-label">Contraseña Nueva</h6>
                              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="**********">
                            </div>
                          </div>
      
                          <!-- <div class="row mb-3">
                            <label for="user_password_new" class="col-md-4 col-lg-3 col-form-label">Repetir contraseña</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                            </div>
                          </div> -->
      
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <div class=" d-flex align-items-center">
            <img src="../assets/brand/cloud_fast-logo.svg" alt="CLOUD~FAST LOGO" width="35" height="35">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1"></a>
            <span class="mb-3 mb-md-0 text-muted">&copy; Todos los derechos reservados |  CLOUD~FAST | <a href="https://diwes.es">DIWES</a> | 2023-2023</span>
          </div>
      
          <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-github ms-3" style="font-size: 20px;"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-twitter ms-3" style="font-size: 20px;"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-instagram ms-3" style="font-size: 20px;"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-youtube ms-3" style="font-size: 20px;"></i></a></li>
          </ul>
        </footer>
      </div>       
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="###"></script>
  </body>
</html>

















