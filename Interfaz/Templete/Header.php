<?php
    session_start();
    if (empty($_SESSION['Usuario'])) {
        header('location:Login.php');
    } else {
    }
?>

<!doctype html>
<html  lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Auditorias | CORAH</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- chosen CSS
	    ============================================ -->
    <link rel="stylesheet" href="../css/bootstrap-chosen.css">

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
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="../css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="../css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="../css/morris.css">
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

    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="../css/modals.css">

    <!-- forms CSS
	============================================ -->
    <link rel="stylesheet" href="../css/all-type-forms.css">

    <!-- x-editor CSS para las tablas
		============================================ -->
    <link rel="stylesheet" href="../css/select2.css">
    <link rel="stylesheet" href="../css/datetimepicker.css">
    <link rel="stylesheet" href="../css/bootstrap-editablee.css">
    <link rel="stylesheet" href="../css/x-editor-style.css">
    <!-- normalize CSS para la tabla
		============================================ -->
    <link rel="stylesheet" href="../css/bootstrap-table.css">
    <link rel="stylesheet" href="../css/bootstrap-editable.css">

    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="../js/modernizr-2.8.3.min.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>

</head>

<body>
    <!-- Start Left menu area -->
    <?php
if (!empty($_SESSION['Perfil'] == 1)) {?>
    <!-- Session Administrador -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a data-toggle="tooltip" title="Ir al inicio" href="../Interfaz/Index.php"><img class="main-logo"
                        src="../img/corah.png" alt="" /></a>
                <strong><a href="#"><img src="../img/corah.png" alt="" /></a></strong>
            </div><br>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="nav metismenu" id="menu1">
                        <li>
                            <a class="has-arrow" href="#">
                                <span class="educate-icon educate-event icon-wrap"></span>
                                <span class="mini-click-non">Auditar</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li>
                                    <a data-toggle="tooltip" title="Articulos Almacen"
                                        href="../Interfaz/Articulos_Almacen.php">
                                        <span class="mini-sub-pro external">Almacén</span>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tooltip" title="Articulos Sucursal"
                                        href="../Interfaz/Articulos_Sucursal.php">
                                        <span class="mini-sub-pro external">Sucursal</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="removable">
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <span class="educate-icon educate-professor icon-wrap"></span>
                                <span class="mini-click-non external">Auditores</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li>
                                    <a data-toggle="tooltip" title="Auditores" href="../Interfaz/Usuario.php">
                                        <span class="mini-sub-pro external">Lista de Auditores</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <?php } else if (!empty($_SESSION['Perfil'] == 2)) {?>
    <!-- Session Auditor -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a data-toggle="tooltip" title="Ir al nicio" href="../Interfaz/Index.php"><img class="main-logo external"
                        src="../img/corah.png" alt="" /></a>
                <strong><a href="#"><img src="../img/corah.png" alt="" /></a></strong>
            </div>
            <br>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <br>
                        <li>
                            <a data-toggle="tooltip" title="Auditar" class="has-arrow" href="#" aria-expanded="false">
                                <span class="educate-icon educate-event icon-wrap"></span>
                                <span class="mini-click-non">Auditar</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li>
                                    <a data-toggle="tooltip" tile="Articulos Almacen"
                                        href="../Interfaz/Articulos_Almacen.php">
                                        <span class="mini-sub-pro external">Almacén</span>
                                    </a>
                                    <a data-toggle="tooltip" tile="Articulos Sucursal"
                                        href="../Interfaz/Articulos_Sucursal.php">
                                        <span class="mini-sub-pro external">Sucursal</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <?php }?>

    <!-- End Left menu area -->

    <!-- Start Welcome area -->
    <div class="all-content-wrapper" id="Usuario">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="#"><img class="main-logo" src="../img/logo2.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" title="Ocultar"
                                                class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Menu superior -->
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item">
                                                    <a href="../Interfaz/Index.php" class="nav-link external">
                                                        Inicio
                                                    </a>
                                                </li>
                                                <li class="nav-item dropdown res-dis-nn">
                                                    <a href="#" data-toggle="dropdown" role="button"
                                                        aria-expanded="false" class="nav-link dropdown-toggle">
                                                        Inventario
                                                        <span class="angle-down-topmenu"><i
                                                                class="fa fa-angle-down"></i></span></a>
                                                    <div role="menu" class="dropdown-menu animated zoomIn">
                                                        <a href="../Interfaz/Inventario_Almacen.php"
                                                            class="dropdown-item external">Almacen</a>
                                                        <a href="../Interfaz/Inventario_Sucursal.php"
                                                            class="dropdown-item external">Sucursal</a>
                                                    </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item dropdown res-dis-nn">
                                                    <a href="#" data-toggle="dropdown" role="button"
                                                        aria-expanded="false" class="nav-link dropdown-toggle">
                                                        Ventas
                                                        <span class="angle-down-topmenu"><i
                                                                class="fa fa-angle-down"></i></span></a>
                                                    <div role="menu" class="dropdown-menu animated zoomIn">
                                                        <a href="../Interfaz/Ventas_Almacen.php"
                                                            class="dropdown-item external">Almacen</a>
                                                        <a href="../Interfaz/Ventas_Sucursal.php"
                                                            class="dropdown-item external">Sucursal</a>
                                                    </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="../Interfaz/Excel.php" class="nav-link external">
                                                        Subir Archivos
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Info Usuario -->
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <?php if (!empty($_SESSION['Usuario'])) {?>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button"
                                                        aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <span
                                                            class="admin-name"><?php echo $_SESSION['Usuario']; ?></span>
                                                        <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                    </a>
                                                    <ul role="menu"
                                                        class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#WarningModalalert">
                                                                <span class="edu-icon edu-locked author-log-ic"></span>
                                                                Cerrar Sesión
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Cerrar Session -->

            <div id="WarningModalalert" class="modal modal-edu-general default-popup-PrimaryModal PrimaryModal-bgcolor fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                        <div class="modal-body">
                            <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                            <h2>Cerrar Sesión!</h2>
                            <p>¿Está seguro que desea cerrar sesión?</p>
                        </div>
                        <div class="modal-footer footer-modal-admin">
                            <a data-dismiss="modal" href="#">Cancelar</a>
                            <a href="../SQLServer/Log_out.php">Aceptar</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Mobile Menu start -->
            <?php
            if (!empty($_SESSION['Perfil'] == 1)) {?>
            <!-- Session Administardor -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <br>
                                        <li>
                                            <a data-toggle="collapse" data-target="#demoevent" href="#">Auditar
                                                <span class="admin-project-icon edu-icon edu-down-arrow"></span>
                                            </a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li>
                                                    <a data-toggle="tooltip" tile="Articulos Almacen"
                                                        href="../Interfaz/Articulos_Almacen.php">Almacén</a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tooltip" tile="Articulos Sucursal"
                                                        href="../Interfaz/Articulos_Sucursal.php">Sucursal</a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li>
                                        <li>
                                            <a data-toggle="collapse" data-target="#demoevent" href="#">Auditores
                                                <span class="admin-project-icon edu-icon edu-down-arrow"></span>
                                            </a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li>
                                                    <a data-toggle="tooltip" tile="Auditores"
                                                        href="../Interfaz/Usuario.php">Lista de Auditores</a>
                                                </li>
                                            </ul>
                                        </li>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } elseif (!empty($_SESSION['Perfil'] == 2)) {?>
            <!-- Session Auditor -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <br>
                                        <li>
                                            <a data-toggle="collapse" data-target="#demoevent" href="#">Auditar
                                                <span class="admin-project-icon edu-icon edu-down-arrow"></span>
                                            </a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li>
                                                    <a data-toggle="tooltip" tile="Articulos Almacen"
                                                        href="../Interfaz/Articulos_Almacen.php">Almacén</a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tooltip" tile="Articulos Sucursal"
                                                        href="../Interfaz/Articulos_Sucursal.php">Sucursal</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- Mobile Menu end -->
            <br>
        </div>


<script type="text/javascript">

    $(document).ready(function(){
        $("a.external").click(function() {
            url = $(this).attr("href");
            window.open(url,'_blank');
            return false;
        });
        
        $("a.external").off('click');

    });
</script>

