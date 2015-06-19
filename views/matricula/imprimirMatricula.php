<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap335.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css">
    </head>
<body>
  <div class="container">
    <div class="row" id="docPrint"> 
      <!Linea#1>
      <div class="col-xs-2">
        <img src="<?php echo URL; ?>public/img/logomep.png" alt="Logo Mep" class="img-rounded pull-left">
      </div>
      <div class="col-xs-8 text-center">
        COLEGIO TÉCNICO PROFESIONAL DE CARRIZAL<br>
        DIRECCIÓN REGIONAL DE ALAJUELA CIRCUITO -01-<br>
        TELFAX 2483-0055
      </div>
      <div class="col-xs-2">
        <img src="<?php echo URL; ?>public/img/logoctpcarrizal.png" alt="Logo CTP Carrizal" class="img-rounded pull-right">
      </div> 
      <!Linea#2>
      <div class="col-xs-4">
        Curso Lectivo 2016
      </div>
      <div class="col-xs-4">
      </div>
      <div class="col-xs-4 text-right">
        ID  2-0820-0696
      </div> 
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#3>
      <div class="col-xs-4">
      Nombre del estudiante:
      </div>
      <div class="col-xs-2 text-center">
      ALVAREZ
      </div>
      <div class="col-xs-3 text-center">
      MONTERO
      </div>
      <div class="col-xs-3 text-center">
      PAULA REBECA
      </div>
      <div class="col-xs-4">
      </div>
      <div class="col-xs-2 text-center">
      (1er apellido)
      </div>
      <div class="col-xs-3 text-center">
      (2er apellido)
      </div>
      <div class="col-xs-3 text-center">
      (Nombre Completo)
      </div>
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#4>
      <div class="col-xs-4">
      Fecha de nacimiento:
      </div>
      <div class="col-xs-2 text-center">
      26
      </div>
      <div class="col-xs-2 text-center">
      8
      </div>
      <div class="col-xs-2 text-center">
      2001
      </div>
      <div class="col-xs-2 text-center">
      14
      </div>
      <div class="col-xs-4">
      </div>
      <div class="col-xs-2 text-center">
      (Día)
      </div>
      <div class="col-xs-2 text-center">
      (Mes)
      </div>
      <div class="col-xs-2 text-center">
      (Año)
      </div>
      <div class="col-xs-2 text-center">
      (Edad)
      </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <button class="btn btn-primary" type="submit" id="btn1">Imprimir</button>
    </div>
  </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>public/js/jquery-printme.js"></script>
  <script>
  $("#btn1").click(function() {
    $("#docPrint").printMe({ "path": "<?php echo URL; ?>public/css/bootstrap335.min.css"});
  });
  </script>
</body>
</html>
<?php
print_r($this->consultaDatos);
?>
