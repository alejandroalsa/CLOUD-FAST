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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">CLOUD~FAST | POL??TICA PRIVACIDAD</a>
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
      <a class="nav-link px-3" href="#">Cerrar Sesi??n</a>
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
            <a class="nav-link active" aria-current="page" href="privacy-policy.php" style="font-size: 16px;">
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

        <div class="mt-5">
            <h2>Pol??tica de Privacidad</h2>
        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Pol??tica de privacidad 
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>El sitio web <a href="https://apps.alejandroalsa.es/proyectos/CLOUD-FAST">https://apps.alejandroalsa.es/proyectos/CLOUD-FAST</a> es propiedad de CLOUD~FAST, que es un controlador de datos de tus datos personales.</p>
                  <p>Hemos adoptado esta Pol??tica de privacidad, que determina c??mo procesamos la informaci??n recopilada por <a href="https://apps.alejandroalsa.es/proyectos/CLOUD-FAST">https://apps.alejandroalsa.es/proyectos/CLOUD-FAST</a>, que tambi??n proporciona las razones por las que debemos recopilar ciertos datos personales sobre ti. Por lo tanto, debes leer esta Pol??tica de privacidad antes de usar el sitio web de <a href="https://apps.alejandroalsa.es/proyectos/CLOUD-FAST">https://apps.alejandroalsa.es/proyectos/CLOUD-FAST</a>.</p>
                  <p>Cuidamos tus datos personales y nos comprometemos a garantizar su confidencialidad y seguridad.</p>
                </di>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Informaci??n personal que recopilamos
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p> Cuando visitas <a href="https://apps.alejandroalsa.es/proyectos/CLOUD-FAST">https://apps.alejandroalsa.es/proyectos/CLOUD-FAST</a>, recopilamos autom??ticamente cierta informaci??n sobre tu dispositivo, incluida informaci??n sobre tu navegador web, direcci??n IP, zona horaria y algunas de las cookies instaladas en tu dispositivo. Adem??s, a medida que navegas, recopilamos informaci??n sobre las p??ginas web individuales o los productos que ves, qu?? sitios web o t??rminos de b??squeda te remitieron a la web y c??mo interact??as. Nos referimos a esta informaci??n recopilada autom??ticamente como "Informaci??n del dispositivo". Adem??s, podemos recopilar los datos personales que nos proporcionas (incluidos, entre otros, nombre, apellido, direcci??n, informaci??n de pago, etc.) durante el registro para poder cumplir con el acuerdo. </p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  ??Por qu?? procesamos tus datos?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p> Nuestra m??xima prioridad es la seguridad de los datos del cliente y, como tal, podemos procesar solo los datos m??nimos del usuario, solo en la medida en que sea absolutamente necesario para mantener el sitio web. La informaci??n recopilada autom??ticamente se utiliza solo para identificar casos potenciales de abuso y establecer informaci??n estad??stica sobre el uso del sitio web. Esta informaci??n estad??stica no se agrega de tal manera que identifique a ning??n usuario en particular del sistema.</p>
                  <p> Puedes visitar la web sin decirnos qui??n eres ni revelar ninguna informaci??n por la cual alguien pueda identificarte como una persona espec??fica. Sin embargo, si deseas utilizar algunas de las funciones del sitio web, o deseas recibir nuestro bolet??n informativo o proporcionar otros detalles al completar un formulario, puedes proporcionarnos datos personales, como tu correo electr??nico, nombre, apellido, ciudad de residencia, organizaci??n y n??mero de tel??fono. Puedes optar por no proporcionar tus datos personales, pero es posible que no puedas aprovechar algunas de las funciones del sitio web. Por ejemplo, no podr??s recibir nuestro bolet??n ni contactarnos directamente desde el sitio web. Los usuarios que no est??n seguros de qu?? informaci??n es obligatoria pueden ponerse en contacto con nosotros a trav??s de alejandro@alejandroalsa.es. </p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Tus derechos
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Si eres residente europeo, tienes los siguientes derechos relacionados con tus datos personales:</p>
                  <ul>
                    <li>El derecho a ser informado.</li>
                    <li>El derecho de acceso.</li>
                    <li>El derecho a la rectificaci??n.</li>
                    <li>El derecho a borrar.</li>
                    <li>El derecho a restringir el procesamiento.</li>
                    <li>El derecho a la portabilidad de datos.</li>
                    <li>El derecho a oponerte.</li>
                    <li>Derechos en relaci??n con la toma de decisiones automatizada y la elaboraci??n de perfiles.</li>
                  </ul>
                  <p>Si deseas ejercer este derecho, comun??cate con nosotros a trav??s de la informaci??n de contacto a continuaci??n.</p>
                  <p>Adem??s, si eres residente europeo, destacamos que estamos procesando tu informaci??n para cumplir con los contratos que podr??amos tener contigo (por ejemplo, si realizas un pedido a trav??s de la web), o de otra manera para seguir nuestros intereses comerciales leg??timos enumerados anteriormente. Adem??s, ten en cuenta que tu informaci??n puede transferirse fuera de Europa, incluidos Canad?? y Estados Unidos.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  Enlaces a otros sitios web
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Nuestra web puede contener enlaces a otros sitios web que no son de nuestra propiedad ni est??n controlados por nosotros. Ten en cuenta que no somos responsables de dichos sitios web ni de las pr??cticas de privacidad de terceros. Te recomendamos que est??s atento cuando abandones nuestro sitio web y leas las declaraciones de privacidad de cada web que pueda recopilar informaci??n personal.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  Informaci??n de contacto
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Si deseas comunicarte con nosotros para comprender m??s sobre esta Pol??tica o deseas comunicarte con nosotros en relaci??n con cualquier asunto sobre los derechos individuales y tu informaci??n personal, puedes enviarnos un correo electr??nico a <a href="mailto:alejandro@alejandroalsa.es">alejandro@alejandroalsa.es</a>.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                  Seguridad de la informaci??n
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p> Aseguramos la informaci??n que proporcionas en servidores inform??ticos en un entorno controlado y seguro, protegido del acceso, uso o divulgaci??n no autorizados. Mantenemos medidas de seguridad administrativas, t??cnicas y f??sicas razonables para proteger contra el acceso no autorizado, el uso, la modificaci??n y la divulgaci??n de datos personales bajo su control y custodia. Sin embargo, no se puede garantizar la transmisi??n de datos a trav??s de Internet o redes inal??mbricas.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                  Divulgaci??n legal
                </button>
              </h2>
              <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Divulgaremos cualquier informaci??n que recopilemos, usemos o recibamos si as?? lo requiere o lo permite la ley, como para cumplir con una citaci??n o un proceso legal similar, y cuando creemos de buena fe que la divulgaci??n es necesaria para proteger nuestros derechos, proteger tu seguridad o la seguridad de los dem??s, investigar el fraude o responder a una solicitud del gobierno.</p>
                </div>
              </div>
            </div>
          </div>
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
