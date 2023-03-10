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

    $records_multimedia = $con->query("SELECT * FROM multimedia WHERE user_id = {$_SESSION['user']['id']}");
    $user_multimedia = $records_multimedia->fetchAll(PDO::FETCH_ASSOC);
    foreach ($user_multimedia as &$user_multimedia_file) {
      $user_multimedia_file['table_name'] = 'multimedia';
    }

    
    $all_user_records = array_merge($user_multimedia);
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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">CLOUD~FAST | MULTIMEDIA</a>
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
      <a class="nav-link px-3" href="../actions/logout.php">Cerrar Sesi??n</a>
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
            <a class="nav-link active" aria-current="page" href="multimedia.php" style="font-size: 16px;">
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
            <a class="nav-link" href="account.php" style="font-size: 16px;">
              <i class="bi bi-person-lines-fill"></i>
              Cuenta -> <?= $user['user_username']?>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../actions/logout.php" style="font-size: 16px;">
              <i class="bi bi-box-arrow-in-left"></i>
              Cerrar Sesi??n
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
              Pol??tica de Privacidad
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="version.php" style="font-size: 16px;">
              <i class="bi bi-git"></i>
              Versi??n 1.0
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
          <button type="button" class="btn btn-outline-success mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#contenido_multimedia"><i class="bi bi-cloud-upload-fill"></i> MULTIMEDIA</button>

          <div class="modal fade" id="contenido_multimedia" tabindex="-1" aria-labelledby="contenido_multimedia" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="contenido_multimedia">Subir Multimedia</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="contenido_multimedia" action="../actions/uploads/upload-multimedia.php?id=<?= $_SESSION['user']['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="d-flex flex-column align-items-center p-5 bg-light border-success border-2 dropzoneMultimedia" style="border: dashed;">
                  <div class="dropzoneMultimedia">Arrastra y suelta multimedia aqu??</div>
                    <div id="filePreviewMultimedia"></div>
                      <label class="btn btn-success mt-3">
                        <span id="fileCounterMultimedia">Seleccionar Multimedia</span>
                        <input type="file" id="fileInputMultimedia" name="multimedia" style="display: none;" accept=".txt, .zip, .rar, .html, .css, .js, .php, .py, .c, .cpp, .java, .rb, .pl, .go, .d, .xml, .yml, .json, .md">
                      </label>
                      <script>
                        const dropzoneMultimedia = document.querySelector('.dropzoneMultimedia');
                        const filePreviewMultimedia = document.querySelector('#filePreviewMultimedia');
                        const fileCounterMultimedia = document.querySelector('#fileCounterMultimedia');
                        const fileInputMultimedia = document.querySelector('#fileInputMultimedia');

                        dropzoneMultimedia.addEventListener('drop', function(e) {
                          e.preventDefault();
                          e.stopPropagation();
                          fileInputMultimedia.files = e.dataTransfer.files;
                          fileInputMultimedia.dispatchEvent(new Event("change"));
                        });
                        let multimedia;
                        dropzoneMultimedia.addEventListener('dragover', function(e) {
                          e.preventDefault();
                          e.stopPropagation();
                        });
                        dropzoneMultimedia.addEventListener('drop', function(e) {
                          e.preventDefault();
                          e.stopPropagation();
                          multimedia = e.dataTransfer.files[0];
                          renderPreviewAndCounterMultimedia();
                        });
                        fileInputMultimedia.addEventListener('change', function(e) {
                          multimedia = e.target.files[0];
                          renderPreviewAndCounterMultimedia();
                        });
                        function renderPreviewAndCounterMultimedia() {
                          filePreviewMultimedia.innerHTML = '';
                          if (multimedia) {
                            const filePreviewElementMultimedia = document.createElement('div');
                            filePreviewElementMultimedia.innerHTML = `Nombre: ${multimedia.name} - Tama??o: ${(multimedia.size / 1024 / 1024).toFixed(5)} MB`;
                            filePreviewMultimedia.appendChild(filePreviewElementMultimedia);
                            fileCounterMultimedia.innerHTML = `Seleccionar otro archivo`;
                          } else {
                            fileCounterMultimedia.innerHTML = `Seleccionar Archivo`;
                          }
                        }

                      </script>
                    </div>
                    <br>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success  ">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
        </div>
   

        <?php foreach ($all_user_records as $user_record) : ?>
          <?php $file_path = $user_record['storage_directory'];?>
          <?php $file_id = $user_record['id'];?>
          <?php $filename = basename($user_record['storage_directory']);?>

          <div class="col-sm-2 mt-2  text-center">
                <div class="card">
                  <div class="card-body">
                  <?php
                    $path_info = pathinfo($user_record["storage_directory"]);
                    $extension = strtolower($path_info["extension"]);

                    $document_extensions = array("doc", "docx", "rtf", "pdf", "xls", "xlsx", "csv", "ppt", "pptx", "pps", "gdoc", "gsheet", "gslides", "odt", "ods", "odp");

                    $archive_extensions = array("txt", "zip", "rar", "html", "css", "js", "php", "py", "c", "cpp", "java", "rb", "pl", "go", "d", "xml", "yml", "json", "md", "exe", "deb", "rpm", "iso", "vhd", "bin", "jar", "msi", "pfx");

                    $multimedia_extensions = array("jpg", "jpeg", "png", "gif","bmp", "tiff", "mp3", "wav", "aac", "flac", "m4a", "mp4", "avi", "mkv", "flv", "mov", "wmv", "gif", "midi", "aiff", "dvd", "bluray", "srt", "svg");

                    switch ($extension) {
                        case in_array($extension, $document_extensions):
                            $icon = "bi bi-filetype-doc";
                            break;
                        case in_array($extension, $archive_extensions):
                            $icon = "bi bi-file-earmark-zip-fill fa-x5";
                            break;
                        case in_array($extension, $multimedia_extensions):
                            $icon = "bi bi-file-image";
                            break;
                        default:
                            $icon = "bi bi-file-earmark-zip-fill fa-x5";
                            break;
                    }

                    ?>
                    <i class="<?=$icon?>" style="font-size: 50px;"></i>
                    <p><?= $filename ?></p>
                    <a href="../actions/download/download.php?file=<?=$file_path?>"><button type="button" class="btn btn-success btn-sm mb-1"><i class="bi bi-cloud-download-fill"></i></button></a>
                    <a href="../actions/delete/delete.php?file=<?=$file_path?>&id=<?=$user_record['id']?>&table=<?=$user_record["table_name"]?>"><button type="button" class="btn btn-danger btn-sm mb-1"><i class="bi bi-trash3-fill"></i></i></button></a>
                    <button type="button" class="btn btn-info btn-sm mb-1"><i class="bi bi-info-circle-fill" type="button" data-bs-toggle="popover" data-bs-placement="right" data-bs-custom-class="custom-popover" data-bs-title="Informacion del Archivo" data-bs-content="Tama??o: <?= $user_record["size"]?> Fecha: <?= $user_record["upload_date"] ?>"></i></button>
                  </div>
                </div>
              </div>
          <?php endforeach ?>


      </div>
      <div class="container">
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
