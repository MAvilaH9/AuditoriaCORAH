<?php 
session_start();
?>

<!doctype html>
<html class="no-js" lang="en">

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
    if (!empty($_SESSION['Perfil']==1)) { ?>
        <!-- Session Administrador -->
        <div class="left-sidebar-pro">
            <nav id="sidebar" class="">
                <div class="sidebar-header">
                    <a href="#"><img class="main-logo" src="../img/corah.png" alt="" /></a>
                    <strong><a href="#"><img src="../img/corah.png" alt="" /></a></strong>
                </div>

                <div class="left-custom-menu-adp-wrap comment-scrollbar">
                    <nav class="sidebar-nav left-sidebar-menu-pro">
                        <ul class="metismenu" id="menu1">
                            <br>
                            <li>
                                <a title="Auditar" href="Consulta.php" aria-expanded="false">
                                    <span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span>
                                    <span class="mini-click-non">Auditar</span>
                                </a>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap">
                                    </span> <span class="mini-click-non">Auditores</span>
                                </a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Lista de Auditores" href="../Interfaz/Auditor.php"><span class="mini-sub-pro">Lista de Auditores</span></a></li>
                                </ul> 
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    <?php } else if(!empty($_SESSION['Perfil']==2)) { ?>
        <!-- Session Auditor -->
        <div class="left-sidebar-pro">
            <nav id="sidebar" class="">
                <div class="sidebar-header">
                    <a href="#"><img class="main-logo" src="../img/corah.png" alt="" /></a>
                    <strong><a href="#"><img src="../img/corah.png" alt="" /></a></strong>
                </div>

                <div class="left-custom-menu-adp-wrap comment-scrollbar">
                    <nav class="sidebar-nav left-sidebar-menu-pro">
                        <ul class="metismenu" id="menu1">
                            <br>
                            <li>
                                <a title="Auditar" href="Consulta.php" aria-expanded="false">
                                    <span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span>
                                    <span class="mini-click-non">Auditar</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    <?php } ?>

    <!-- End Left menu area -->

    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
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
                                            <button type="button" id="sidebarCollapse"
                                                class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Menu superior -->
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a href="#" class="nav-link">Home</a>
                                                </li>
                                                <li class="nav-item"><a href="#" class="nav-link">About</a>
                                                </li>
                                                <li class="nav-item"><a href="#" class="nav-link">Services</a>
                                                </li>
                                                <li class="nav-item dropdown res-dis-nn">
                                                    <a href="#" data-toggle="dropdown" role="button"
                                                        aria-expanded="false" class="nav-link dropdown-toggle">Project
                                                        <span class="angle-down-topmenu"><i
                                                                class="fa fa-angle-down"></i></span></a>
                                                    <div role="menu" class="dropdown-menu animated zoomIn">
                                                        <a href="#" class="dropdown-item">Documentation</a>
                                                        <a href="#" class="dropdown-item">Expert Backend</a>
                                                        <a href="#" class="dropdown-item">Expert FrontEnd</a>
                                                        <a href="#" class="dropdown-item">Contact Support</a>
                                                    </div>
                                                </li>
                                                <li class="nav-item"><a href="#" class="nav-link">Support</a>
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
                                                        <span class="admin-name"><?php echo $_SESSION['Usuario'];?></span>
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
                                                <?php } ?>
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
            <div id="WarningModalalert" class="modal modal-edu-general Customwidth-popup-WarningModal fade"
                role="dialog">
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
                        <div class="modal-footer warning-md">
                            <a data-dismiss="modal" href="#">Cancelar</a>
                            <a href="../Recursos/Log_out.php">Aceptar</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <br>
                                        <li><a href="Consulta.php">Auditar</a></li>
                                        <!-- <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top"> -->
                                        <!-- <li><a href="all-professors.html">All Professors</a>
                                                </li>
                                                <li><a href="add-professor.html">Add Professor</a>
                                                </li>
                                                <li><a href="edit-professor.html">Edit Professor</a>
                                                </li>
                                                <li><a href="professor-profile.html">Professor Profile</a>
                                                </li> -->
                                    </ul>
                                    </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <br>
            <!-- Buscar
            <div class="breadcome-area">
                    <br>
                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Buscar..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Dashboard V.1</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>