<?php
session_start();
// require_once "../SQLServer/Conexion.1.php";
// if (isset($_SESSION['Usuario'])) {
// }else{
// }

?>

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
  <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">
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
        <h3>Inicio de Sesión </h3>
        <p>Por favor ingrese su usuario y contraseña.</p>
      </div> <br>
      <div class="content-error">
        <div class="hpanel">
          <div class="panel-body"> <br>
            <!-- Formulario -->
            <form action="../SQLServer/Login.php" method="Post" id="loginForm">
              <div class="form-group">
                <!-- Select Empresa -->
                <?php 
                    // $sqle= $pdo->prepare("SELECT ClaveEmpresa, Nombre FROM Empresa ORDER BY Nombre");
                    // $sqle->execute();
                    // $resultadoe=$sqle->fetchALL(PDO::FETCH_ASSOC);
                  ?>
                <div class="form-group">
                  <label class="login2">Selecione Empresa</label>
                  <select name="Empresa" id="Empresa" class="form-control" required>
                    <option selected disabled>Seleccione...</option>
                    <option value="Valsi4500v4">Valsi4500v4</option>
                    <option value="Auditoria" >Auditoria</option>
                    <?php
                    // foreach ($resultadoe as $date) { ?>
                    <!-- 
                      <option value="<?php //echo $date['ClaveEmpresa']; ?>"><?php //echo $date['Nombre']; ?></option>
                       -->
                    <?php
                    // }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="username">Usuario</label>
                <input type="text" placeholder="Ejemplo: MAvila" title="Por favor, ingrese su nombre de usuario"
                   value="" name="Usuario" id="Usuario" class="form-control">
                <!-- <span class="help-block small">Tu nombre de usuario único para ingresar</span> -->
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Contraseña</label>
                <div class="input-group custom-go-button">
                  <input type="password" name="Contrasenia" id="Contrasenia" class="form-control" placeholder="******"
                     value="" maxlength="40">
                  <span class="input-group-btn">
                    <button class="btn btn-primary " type="button" onclick="mostrarContrasena()"><span
                        class="glyphicon glyphicon-eye-close icon"></span>
                    </button>
                  </span>
                </div>
                <!-- <span class="help-block small">Ingresa tu contraseña de manera correcta</span> -->
              </div>
              <!-- Alert error -->
              <?php
                if(isset($_GET["Error"]) && $_GET["Error"] == 'true'){
                echo '<div class="alert alert-danger alert-mg-b" role="alert">
                    <strong>Error al Iniciar!</strong>   Usuario y/o Contraseña Incorrectas.
                    </div>';
                }
              ?>
              <br>
              <button id="basicErrorNoSound" class="btn btn-success btn-block loginbtn">Iniciar
                Sesión</button>
            </form> <br>
          </div>
        </div>
      </div><br> <br>
      <div class="text-center login-footer">
        <p> <a href="#">CORAH | Corporativo de Aluminios y Herrajes</a></p>
      </div>
    </div>
  </div>

  <!-- Funcion para mostrar la contraseña -->
  <script>
    function mostrarContrasena() {
      var tipo = document.getElementById("Contrasenia");
      if (tipo.type == "password") {
        tipo.type = "text";
        $('.icon').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
      } else {
        tipo.type = "password";
        $('.icon').removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
      }
    }
  </script>

  

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

<script>
  $(document).ready(function () {
    $("#Empresa").change(function (e) { 
      e.preventDefault();
      var Empresa= $('#Empresa option:selected').html();
      $("#Base").val(Empresa);
      // alert(Empresa); 
      $.ajax({
        type: "Post",
        url: "../SQLServer/SesionBD.php",
        data: {Empresa : Empresa},
        dataType: "dataType",
        success: function (response) {
          // alert(response);
        }
      });
    });
    return false;
  });
</script>
</html>