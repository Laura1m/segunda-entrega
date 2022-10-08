<?php
include("config/funtions.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />

<title> CITAS </title>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div>
<h1><text-center> CITAS DE ATENCION</text-center></h1>

    </div>
    <form action="">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1"> SOLICITUD </label>
              <input type="text" class="form-control" id="solicitud" aria-describedby="emailHelp" placeholder="CORTO - LARGO ">
              <small id="emailHelp" class="form-text text-muted">PUEDES INCLUIR OTRA INFORMACIÓN SI QUIERES.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">TINTURADO O NATURAL </label>
              <input type="text" class="" id="tipo" placeholder="TINTURADO O NATURAL ">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1"> UTILIZAS HERRAMIENTAS DE CALOR  </label>
              <input type="text" class="" id="herramientas" placeholder="SI O NO ">
            </div>
            

              <div class="form-group">
                <label for="exampleFormControlInput1">APLICAS ALGUN TIPO DE TRATAMIENTO </label>
                <input type="" class="" id="tratamiento" placeholder="DESCRIBENOS">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1"> CON QUE FRECUENCIA CORTAS TU CABELLO * MESES </label>
                <select class="form-control" id="frecuencia">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6 O MAS</option>
                </select>
            </div>
            


            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Autorizo el uso de esta información</label>
            </div>
            <button type="submit" class="btn btn-primary">ENVIAR </button>
          </form>
        
        </form>
    
</body>







</html>