<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="<?php  echo URL;?>public/images/logoctpcarrizal.png"/>
        <html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml"></html>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= (isset($this->title)) ? $this->title : ''; ?></title>   
        <link rel="stylesheet" type="text/css" href="<?php  echo URL;?>public/default.css" media="all"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php  echo URL;?>public/css/smoothness/jquery-ui-1.8.24.custom.css"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php  echo URL;?>public/css/jQueryValidationEngine/validationEngine.jquery.css"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php  echo URL;?>public/css/jQueryValidationEngine/template.css"></script>
        <script type="text/javascript" src="<?php  echo URL;?>public/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="<?php  echo URL;?>public/js/jquery-ui-1.8.24.custom.min.js"></script>
        <script type="text/javascript" src="<?php  echo URL;?>public/js/jQueryValidationEngine/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php  echo URL;?>public/js/jQueryValidationEngine/languages/jquery.validationEngine-es.js"></script>
        <script type="text/javascript" src="<?php  echo URL;?>public/images/menu"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/default.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/hora.js"></script>
               
        <?php 
        if (isset($this->js)) 
        {
            foreach ($this->js as $js)
            {
                echo '<script type="text/javascript" src="'. URL . 'views/' . $js . '"></script>';
            }
        }
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            //validar campos       
            jQuery("#MyForm").validationEngine();
            //mostrar mensaje    
            $(".mensajes").show();
            
        }); 
        /*Solo mayusculas*/    
        function mayusculas(campo){
            campo.value = campo.value.toUpperCase();
        }
        //para cargar imagen de foto
        $(window).load(function(){

            $(function() {
                $('#imagen').change(function(e) {
                addImage(e); 
            });

            function addImage(e){
                
                var file = e.target.files[0],
                imageType = /image.*/;
                /*Si es una imagen y ademas menor a 1MB*/
                if (file.type.match(imageType) && file.size <= 1000000){
                    var reader = new FileReader();
                    reader.onload = fileOnload;
                    reader.readAsDataURL(file); 
                }else{
                    alert("Lo Sentimos debe seleccionar un formato de imagen y un menor a un tamaño menor 1MB!!!");
                    return;
                }   
            }
            function fileOnload(e) {
                var result=e.target.result;
                $('#imgSalida').attr("src",result);
            }
            });
        });
        /*Para cargar la hora*/
        $(document).ready(function(){
            $('#time').jTime();
            $("#b2").click(function() {
                $("#dialogo2").dialog({
                    width: 590,
                    height: 350,
                    show: "scale",
                    hide: "scale",
                    resizable: "false",
                    position: "center"     
                });
            });
        });
        
        </script>
    </head>
    <body>
               
        <?php Session::init();?>
        <div id="contenedor">
            <div id="header">
                <table width="100%">
                    <tr>
                        <td rowspan="4" width="140">
                            <div id="logo">
                                <img src="<?php echo URL; ?>public/images/logosipce.png" width="140"/>
                            </div>
                        </td>
                        <td>
                            <span class="nombreSitioSipce">SIPCE</span>
                        </td>
                        <td>
                            <div class="loggerusuario">
                                <img src="<?php echo URL;?>public/images/foto.png" width="35" height="35"/></a>
                                <?php echo $_SESSION['nombre'];?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="nombre">
                                <span class="nombreSitioSistema">SISTEMA DE INFORMACION PARA CENTROS EDUCATIVOS</span>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p><span id="fechaactual"></span>, <span id="time"></span></p>
                        </td>
                    </tr>
                </table>    
            </div>
            <div id="menus">
                <ul id="menu">
                    
                    <?php if (Session::get('loggedIn') == true): ?>  
                        <li>
                            <a href="<?php echo URL; ?>index"><img src="<?php echo URL; ?>public/images/botones/home.png" width="25" height="25"/></a>
                        </li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/separator.png"/>
                            <img src="<?php echo URL; ?>public/images/botones/ayuda.png"/>
                            <a href="<?php echo URL; ?>help">Ayuda</a>
                        </li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/separator.png"/>
                            <img src="<?php echo URL; ?>public/images/botones/profesores.png"/>
                            <a href="<?php echo URL; ?>persona/index">Docentes</a>
                            <ul>
                                <li>
                                    <a href="<?php echo URL; ?>persona/buscarDocente">
                                        <img src="<?php echo URL; ?>public/images/botones/new.png" width="25" height="25"/>
                                        Nuevo Docente Arriba</a>
                                </li>
                                <li>
                                    
                                    <a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/update.png" width="25" height="25"/>
                                        Actualizar Datos</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/delete.png" width="25" height="25"/>
                                        Eliminar</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/buscar.png" width="25" height="25"/>
                                        Buscar</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/list.png" width="25" height="25"/>
                                        Listar</a></li>
                            </ul>
                        </li>
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/estudiante.png"/>
                            <a href="<?php echo URL; ?>persona/ListaEstudiantes">Estudiantes</a>
                            <ul>
                                <li>
                                    <a href="<?php echo URL; ?>persona/buscarEstudiante">
                                        <img src="<?php echo URL; ?>public/images/botones/new.png" width="25" height="25"/>
                                        Nuevo</a>
                                </li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/update.png" width="25" height="25"/>
                                        Actualizar</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/delete.png" width="25" height="25"/>
                                        Eliminar</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/buscar.png" width="25" height="25"/>
                                        Buscar</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">
                                        <img src="<?php echo URL; ?>public/images/botones/list.png" width="25" height="25"/>
                                        Listar</a></li>
                            </ul>
                        </li>
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/matricula.png"/>
                            <a href="<?php echo URL; ?>persona/index">Matricula</a>
                            <ul>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">Pre-Matricula</a></li>
                                <li><a href="<?php echo URL; ?>persona/ListaEstudiantes">Matricula</a></li>
                            </ul>
                        </li>
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/contacts.png" width="25" height="25"/>
                            <a href="<?php echo URL; ?>dashboard/logout">Contactenos</a>
                        </li>
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/salir.png"/>
                            <a href="<?php echo URL; ?>dashboard/logout">Salir</a>
                        </li>
                        <img style="float:left;" alt="" src="<?php echo URL; ?>public/images/botones/menu_right2.png"/>
                    <?php else: ?>
                        <li><a href="<?php echo URL; ?>index"><img src="<?php echo URL; ?>public/images/botones/home.png" width="25" height="25"/></a></li>
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/ayuda.png"/>
                            <a href="<?php echo URL; ?>help">Ayuda</a>
                        </li> 
                        <li><img src="<?php echo URL; ?>public/images/botones/separator.png"/></li>
                        <li>
                            <img src="<?php echo URL; ?>public/images/botones/sesion.png"/>
                            <a href="<?php echo URL; ?>login">Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <div id ="content">
        
