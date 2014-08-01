</div>
    <div id ="footer">
        <p>&copy; Copyright 2013. All rights reserved.</p> 
    </div>
</div>
<script type="text/javascript">
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    var f = new Date();
    document.getElementById("fechaactual").innerHTML = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
  
</script>
</body>
</html>