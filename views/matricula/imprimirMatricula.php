<?php 
//print_r($this->especialidadEstudiante);
//die;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <!Bootstrap Normal>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap335.min.css">
        
        <link rel="stylesheet" href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css">
    </head>
<body>
  <div class="container">
    <div class="row" id="docPrint"> 
      <!Linea#1>
      <div class="col-xs-2">
        <img src="<?php echo URL; ?>public/img/logomep.png" alt="Logo Mep" class="img-rounded pull-left" width="80" height="71">
      </div>
      <div class="col-xs-8 text-center">
        COLEGIO TÉCNICO PROFESIONAL DE CARRIZAL<br>
        DIRECCIÓN REGIONAL DE ALAJUELA CIRCUITO -01-<br>
        TELFAX 2483-0055
      </div>
      <div class="col-xs-2">
        <img src="<?php echo URL; ?>public/img/logoctpcarrizal.png" alt="Logo CTP Carrizal" class="img-rounded pull-right" width="80" height="79">
      </div> 
      <!Linea#2>
      <div class="col-xs-4">
        Curso Lectivo <?php echo $this->anio; ?>
      </div>
      <div class="col-xs-4">
      </div>
      <div class="col-xs-4 text-right">
        ID: <?php echo $this->consultaDatosEstudiante[0]['cedula']; ?>
      </div> 
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#3>
      <div class="col-xs-4 text-right">
      Nombre del estudiante:
      </div>
      <div class="col-xs-2 text-center">
      <?php echo $this->consultaDatosEstudiante[0]['apellido1']; ?>
      </div>
      <div class="col-xs-3 text-center">
      <?php echo $this->consultaDatosEstudiante[0]['apellido2']; ?>
      </div>
      <div class="col-xs-3 text-center">
      <?php echo $this->consultaDatosEstudiante[0]['nombre']; ?>
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
      <div class="col-xs-4 text-right">
      Fecha de nacimiento:
      </div>
      <div class="col-xs-2 text-center">
      <?php echo substr($this->consultaDatosEstudiante[0]['fechaNacimiento'],8,2); ?>
      </div>
      <div class="col-xs-2 text-center">
      <?php echo substr($this->consultaDatosEstudiante[0]['fechaNacimiento'],5,2); ?>
      </div>
      <div class="col-xs-2 text-center">
      <?php echo substr($this->consultaDatosEstudiante[0]['fechaNacimiento'],0,4); ?>
      </div>
      <div class="col-xs-2 text-center">
      <?php echo $this->anio - (date(substr($this->consultaDatosEstudiante[0]['fechaNacimiento'], 0, 4))); ?>
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
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#5>
      <div class="col-xs-4 text-right">
      Tel. Cel:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['telefonoCelular']; ?>&nbsp;
      </div>
      <div class="col-xs-2 text-right">
      Email:&nbsp;
      </div>
      <div class="col-xs- text-left">
      <?php echo $this->consultaDatosEstudiante[0]['email']; ?>&nbsp;
      </div>
      <!Linea#6>
      <div class="col-xs-4 text-right">
      Domicilio:&nbsp;
      </div>
      <div class="col-xs-8 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['domicilio']; ?>
      </div>
      <!Linea#7>
      <div class="col-xs-4 text-right">
      Distrito:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['Distrito']; ?>
      </div>
      <div class="col-xs-1 text-right">
      Cantón:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['Canton']; ?>
      </div>
      <div class="col-xs-1 text-right">
      Provincia:&nbsp;
      </div>
      <div class="col-xs-2 text-center">
      <?php echo $this->consultaDatosEstudiante[0]['nombreProvincia']; ?>
      </div>
      <!Linea#8>
      <div class="col-xs-4 text-right">
      Primaria:&nbsp;
      </div>
      <div class="col-xs-8 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['escuela_procedencia']; ?>
      </div>
      <!Linea#9>
      <div class="col-xs-4 text-right">
      ¿Padece alguna enfermedad?&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php if($this->enfermedadEstudiante != null) {echo 'Si';} else {echo 'No';} ?>
      </div>
      <div class="col-xs-6 text-left">
      <?php if($this->enfermedadEstudiante != null) echo $this->enfermedadEstudiante[0]['descripcion']; ?>
      </div>
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#10>
      <div class="col-xs-12 text-center">
          DATOS DEL HOGAR
      </div>
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#11>
      <div class="col-xs-4 text-right">
      Nombre del encargado legal:&nbsp;
      </div>
      <div class="col-xs-1 text-center">
      <?php echo $this->encargadoLegal[0]['apellido1_encargado']; ?>
      </div>
      <div class="col-xs-2 text-center">
      <?php echo $this->encargadoLegal[0]['apellido2_encargado']; ?>
      </div>
      <div class="col-xs-2 text-center">
      <?php echo $this->encargadoLegal[0]['nombre_encargado']; ?>
      </div>
      <div class="col-xs-1 text-center">
      Cédula#
      </div>
      <div class="col-xs-2 text-left">
      <?php echo $this->encargadoLegal[0]['ced_encargado']; ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#12>
      <div class="col-xs-4 text-right">
      Teléfono habitación:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php if($this->encargadoLegal[0]['telefonoCasaEncargado']!=null){echo $this->encargadoLegal[0]['telefonoCasaEncargado'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-right">
      Celular:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
      <?php if($this->encargadoLegal[0]['telefonoCelularEncargado']!=null){echo $this->encargadoLegal[0]['telefonoCelularEncargado'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#13>
      <div class="col-xs-4 text-right">
      Ocupación:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php echo $this->encargadoLegal[0]['ocupacionEncargado']; ?>
      </div>
      <div class="col-xs-2 text-right">
      Email:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
      <?php if($this->encargadoLegal[0]['emailEncargado']!=null){echo $this->encargadoLegal[0]['emailEncargado'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#14>
      <div class="col-xs-4 text-right">
      Nombre de la madre:&nbsp;
      </div>
      <div class="col-xs-1 text-center">
          <?php if($this->madreEstudiante[0]['apellido1_madre']!=null){echo $this->madreEstudiante[0]['apellido1_madre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->madreEstudiante[0]['apellido2_madre']!=null){echo $this->madreEstudiante[0]['apellido2_madre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->madreEstudiante[0]['nombre_madre']!=null){echo $this->madreEstudiante[0]['nombre_madre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-1 text-center">
      Cédula#
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->madreEstudiante[0]['ced_madre']!=null){echo $this->madreEstudiante[0]['ced_madre'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#15>
      <div class="col-xs-4 text-right">
      Celular:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->madreEstudiante[0]['telefonoCasaMadre'] != 0){echo $this->madreEstudiante[0]['telefonoCasaMadre'];}else{echo '&nbsp;';}?>
      </div>
      <div class="col-xs-2 text-right">
      Ocupación:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
          <?php if($this->madreEstudiante[0]['ocupacionMadre']!=null){echo $this->madreEstudiante[0]['ocupacionMadre'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#16>
      <div class="col-xs-4 text-right">
      Nombre del padre:&nbsp;
      </div>
      <div class="col-xs-1 text-center">
          <?php if($this->padreEstudiante[0]['apellido1_padre']!=null){echo $this->padreEstudiante[0]['apellido1_padre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->padreEstudiante[0]['apellido2_padre']!=null){echo $this->padreEstudiante[0]['apellido2_padre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->padreEstudiante[0]['nombre_padre']!=null){echo $this->padreEstudiante[0]['nombre_padre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-1 text-center">
      Cédula#
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->padreEstudiante[0]['ced_padre']!=null){echo $this->padreEstudiante[0]['ced_padre'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#17>
      <div class="col-xs-4 text-right">
      Celular:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->padreEstudiante[0]['telefonoCasaPadre']!=0){echo $this->padreEstudiante[0]['telefonoCasaPadre'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-right">
      Ocupación:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
          <?php if($this->padreEstudiante[0]['ocupacionPadre']!=null){echo $this->padreEstudiante[0]['ocupacionPadre'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#18>
      <div class="col-xs-4 text-right">
      En caso de emergencia llamar a:&nbsp;
      </div>
      <div class="col-xs-1 text-center">
          <?php if($this->personaEmergenciaEstudiante[0]['apellido1_personaEmergencia']!=null){echo $this->personaEmergenciaEstudiante[0]['apellido1_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->personaEmergenciaEstudiante[0]['apellido2_personaEmergencia']!=null){echo $this->personaEmergenciaEstudiante[0]['apellido2_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-center">
          <?php if($this->personaEmergenciaEstudiante[0]['nombre_personaEmergencia']!=null){echo $this->personaEmergenciaEstudiante[0]['nombre_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-1 text-center">
      Cédula#
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->personaEmergenciaEstudiante[0]['ced_personaEmergencia']!=null){echo $this->personaEmergenciaEstudiante[0]['ced_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
<!--      <div class="col-xs-12">
          <br>
      </div>-->
      <!Linea#19>
      <div class="col-xs-4 text-right">
      Teléfono habitación:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
          <?php if($this->personaEmergenciaEstudiante[0]['telefonoCasaPersonaEmergencia']!=0){echo $this->personaEmergenciaEstudiante[0]['apellido1_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-2 text-right">
      Celular:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
          <?php if($this->personaEmergenciaEstudiante[0]['telefonoCelularPersonaEmergencia']!=0){echo $this->personaEmergenciaEstudiante[0]['apellido1_personaEmergencia'];}else{echo '&nbsp;';} ?>
      </div>
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#20>
      <div class="col-xs-12 text-center">
          DATOS DE LA INSTITUCIÓN
      </div>
      <div class="col-xs-12">
          <br>
      </div>
      <!Linea#21>
      <div class="col-xs-3 text-right">
      Nivel a matricular:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['nivel'] . '°'; ?>
      </div>
      <div class="col-xs-2 text-right">
      Condición:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
      <?php echo $this->consultaDatosEstudiante[0]['condicion']; ?>
      </div>
      <div class="col-xs-3 text-right">
      Adecuación curricular:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php if($this->adecuacionEstudiante != null) {echo $this->adecuacionEstudiante[0]['adecuacion'];}else{echo 'No';} ?>
      </div>
      <!Linea#22>
      <div class="col-xs-3 text-right">
      Adelanta:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
          <?php if($this->infoAdelanta != null) {echo 'Si';} else {echo 'No';} ?>
      </div>
      <?php if($this->infoAdelanta != null) {?>
      <div class="col-xs-1 text-right">
      Nivel:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
      <?php echo $this->infoAdelanta[0]['nivel_adelanta'];?>
      </div>
      <?php }else{?>
      <div class="col-xs-2">
          &nbsp;
      </div>
      <?php }?>
      <div class="col-xs-2 text-right">
      Especialidad:&nbsp;
      </div>
      <div class="col-xs-4 text-left">
      <?php echo $this->especialidadEstudiante[0]['nombreEspecialidad']; ?>
      </div>
      <!Linea#23>
      <div class="col-xs-3 text-right">
      Beca Avancemos:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
      <?php if ($this->becasEstudiante != null && $this->becasEstudiante[0]['becaAvancemos']==1) {echo 'Si';}else{echo 'No';}?>
      </div>
      <div class="col-xs-2 text-right">
      Beca Comedor:&nbsp;
      </div>
      <div class="col-xs-1 text-left">
      <?php if ($this->becasEstudiante != null && $this->becasEstudiante[0]['becaComedor']==1) {echo 'Si';}else{echo 'No';} ?>
      </div>
      <div class="col-xs-2 text-right">
      Beca Transporte:&nbsp;
      </div>
      <div class="col-xs-2 text-left">
      <?php if ($this->becasEstudiante != null && $this->becasEstudiante[0]['becaTransporte']==1) {echo 'Si';}else{echo 'No';} ?>
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
  <!-- Bootstrap Modificado -->
  <script>
  $("#btn1").click(function() {
    $("#docPrint").printMe({ "path": "<?php echo URL; ?>public/css/bootstrap335modif.min.css"});
  });
  </script>
</body>
</html>
<?php
print_r("");
?>
