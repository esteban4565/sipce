<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title><?= (isset($this->title)) ? $this->title : ''; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo URL; ?>public/css/smoothness/jquery-ui-1.8.24.custom.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo URL; ?>public/css/jQueryValidationEngine/validationEngine.jquery.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo URL; ?>public/css/jQueryValidationEngine/template.css">

        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-ui-1.8.24.custom.min.js"></script>        
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jQueryValidationEngine/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jQueryValidationEngine/languages/jquery.validationEngine-es.js"></script>

<!--<script src="<?php echo URL; ?>public/js/jquery-1.11.1.js"></script>-->
        <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="<?php echo URL; ?>public/js/hora.js"></script>
        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
            }
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                //validar campos       
                jQuery("#MyForm").validationEngine();
                //mostrar mensaje    
                //$(".mensajes").show();
                //$('#datetime').jTime();
            });
            //para cargar imagen de foto
            $(window).load(function() {
                $(function() {
                    $('#imagen').change(function(e) {
                        addImage(e);
                    });
                    function addImage(e) {
                        var file = e.target.files[0],
                                imageType = /image.*/;
                        /*Si es una imagen y ademas menor a 1MB*/
                        if (file.type.match(imageType) && file.size <= 1000000) {
                            var reader = new FileReader();
                            reader.onload = fileOnload;
                            reader.readAsDataURL(file);
                        } else {
                            alert("Lo Sentimos debe seleccionar un formato de imagen y un tamaño menor a 1 MB !!!");
                            return;
                        }
                    }
                    function fileOnload(e) {
                        var result = e.target.result;
                        $('#imgSalida').attr("src", result);
                    }
                });
            });

        </script> 
    </head>
    <body onload="fechaHora();">
<?php Session::init(); ?>
        <div class="container">
            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-lg-1">
                    <img src="<?php echo URL; ?>public/img/logosipce.png" alt="Logo Sipce" class="img-rounded pull-left">
                </div>
                <div class="col-lg-10 text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Sistema de Informacón para Centros Educativos</h1>
                            <h4><p class="text-success">Colegio Ténico Profesional de Carrizal, Dirección Regional de Alajuela Circuito -01-</p></h4>
                            <h4><p class="text-succes">Telefax: 2483-0055</p></h4>
                            <!--<label id="datetime" size="50"></label>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <img src="<?php echo URL; ?>public/img/logoctpcarrizal.png" alt="Logo CTPC" class="img-rounded pull-right">
                </div>
            </div>
            <br/>
            <!--Si esta logeded-->
            <!--Menu-->
<?php if (Session::get('loggedIn') == true): ?> 
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="<?php echo URL; ?>index/index">Inicio</a>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                                    <ul class="nav navbar-nav">
                                        <li><a href="#">Registro</a></li>
                                        <li><a href="<?php echo URL; ?>horario/index">Horario</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Docentes <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo URL; ?>persona/buscarDocente">Agregar docente</a></li>
                                                <li><a href="#">Modificar Docentes</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Buscar Docentes</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Lista Docentes</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Eliminar Docentes</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Lista Docentes</a></li>
                                                <li class="divider"></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrador <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo URL; ?>actualizarestudiantes/index">Actualizar Cedulas BD</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <!--Secciones-->
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Secciones <b class="caret"></b></a>
                                            <ul class="dropdown-menu">

                                                <li><a href="<?php echo URL; ?>seccion/index">Index</a></li>
                                                <li class="divider"></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <!--Estudiantes-->
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estudiantes <b class="caret"></b></a>
                                            <ul class="dropdown-menu">

                                                <li><a href="<?php echo URL; ?>persona/buscarDocente">Agregar Estudiante</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Modificar Estudiante</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Buscar Estudiante</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo URL; ?>persona/listaEstudiantes">Lista Estudiante</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Eliminar Estudiante</a></li>
                                                <li class="divider"></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matricula <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo URL; ?>matricula/ratificar">Ratificar</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo URL; ?>matricula/nuevoIngreso">Nuevo Ingreso</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo URL; ?>matricula/adelanto">Adelanto-Arraste</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo URL; ?>matricula/estudiantesMatriculados">Matriculados</a></li>
                                                
                                            </ul>
                                        </li>
                                        <form class="navbar-form navbar-left" role="search">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" placeholder="Buscar">
                                            </div>
                                            <button type="submit" class="btn btn-default btn-sm">Buscar</button>
                                        </form>
                                    </ul>
                                    <!--Barra derecha-->
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $_SESSION['nombre']; ?> <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Editar perfil</a></li>
                                                <li><a href="<?php echo URL; ?>dashboard/logout">Salir</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
                <!--Si no esta loged-->
<?php else: ?>
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="#">Inicio</a>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?php echo URL; ?>login">Iniciar Sesión</a></li>
                                </div>
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
<?php endif; ?>
            <!--Contenido para mostrar todas las paginas-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="jumbotron">


