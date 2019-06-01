<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CORAH | Login - Auditoria</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="../css/owl.carousel.css">
  <link rel="stylesheet" href="../css/owl.theme.css">
  <link rel="stylesheet" href="../css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="../css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="../css/normalize.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="../css/main.css">
  <!-- morrisjs CSS
		============================================ -->
  <link rel="stylesheet" href="../css/morrisjs/morris.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
  <!-- metisMenu CSS
		============================================ -->
  <link rel="stylesheet" href="../css/metisMenu.min.css">
  <link rel="stylesheet" href="../css/metisMenu-vertical.css">
  <!-- calendar CSS
		============================================ -->
  <link rel="stylesheet" href="../css/fullcalendar.min.css">
  <link rel="stylesheet" href="../css/fullcalendar.print.min.css">
  <!-- forms CSS
		============================================ -->
  <link rel="stylesheet" href="../css/all-type-forms.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="../css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="../js/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
  <div class="error-pagewrap" style="background-image: url('../img/fondo1.jpg');">
    <div class="error-page-int">
      <div class="text-center m-b-md custom-login">
        <h3>Inicio de Sesión Auditorias</h3>
        <p>Por Favor Ingrese su Usuario y Contraseña</p>
      </div> <br>
      <div class="content-error">
        <div class="hpanel">
          <div class="panel-body"> <br>
            <form action="../Recursos/Login.php" id="loginForm">
              <div class="form-group">
                <label class="control-label" for="username">Usuario</label>
                <input type="text" placeholder="Ejemplo: MAvila" title="Por favor, ingrese su nombre de usuario"
                  required="" value="" name="Usuario" id="Usuario" class="form-control">
                <span class="help-block small">Tu nombre de usuario único para ingresar</span>
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Contraseña</label>
                <input type="password" title="Por favor, ingrese su contraseña" placeholder="******" required=""
                  value="" name="Contrasenia" id="Contrasenia" class="form-control">
                <span class="help-block small">Tú contraseña segura</span>
              </div>
              <?php
                if(isset($_GET["Error"]) && $_GET["Error"] == 'true'){
                  echo '<div class="alert alert-danger alert-mg-b" role="alert">
                          <strong>Error al Iniciar!</strong>   Usuario y/o Contraseña Incorrectas.
                        </div>';
                }
              ?>
              <br>
              <button id="basicErrorNoSound" class="btn btn-success btn-block loginbtn">Iniciar Sesión</button>
            </form> <br>
          </div>
        </div>
      </div><br> <br>
      <div class="text-center login-footer">
        <p> <a href="#">CORAH | Corporativo de Aluminio y Herrajes</a></p>
      </div>
    </div>
  </div>
  <!-- jquery
		============================================ -->
  <script src="../js/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="../js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="../js/jquery-price-slider.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="../js/jquery.meanmenu.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="../js/owl.carousel.min.js"></script>
  <!-- sticky JS
		============================================ -->
  <script src="../js/jquery.sticky.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="../js/jquery.scrollUp.min.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="../js/mCustomScrollbar-active.js"></script>
  <!-- metisMenu JS
		============================================ -->
  <script src="../js/metisMenu.min.js"></script>
  <script src="../js/metisMenu-active.js"></script>
  <!-- tab JS
		============================================ -->
  <script src="../js/tab.js"></script>
  <!-- icheck JS
		============================================ -->
  <script src="../js/icheck.min.js"></script>
  <script src="../js/icheck-active.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="../js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="../js/main.js"></script>
  <!-- tawk chat JS
		============================================ -->
  <!-- <script src="../js/tawk-chat.js"></script> -->
</body>

</html>