<?php
  session_start();
  if (!empty($_SESSION['correo'])) {

  }else {
    header('location:loginForm.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="icon" type="image/png" href="img/cash_40532.png" />
    <title></title>
  </head>
  <body>
    <div class="content">
      <a style="text-decoration: none;" href="index.php">
      <div class="header">
        <h2>CAJA PILI</h2>
        <p>Servicios de Atencion</p>
        <img src="img/cajera.jpg" alt="" align="right">
      </div></a>
      <div class="session">
        <?php
          $texto1=$_SESSION['correo'];
          $texto2="Cerrar Session";
          $link1="";
          $link2="cerrar_session.php";
         ?>
         <ul>
           <li class="titulo2"><a style="color:#000;" href="<?php echo $link1; ?>"><?php echo $texto1; ?></a></li>
           <li class="subtitulo"><a href="<?php echo $link2; ?>"><?php echo $texto2; ?></a></li>
         </ul>
      </div>
      <div class="consulta">
        <form class="" action="" method="post">
          <input id="texto" class="input" type="text" name="buscar" onkeyup="showUser(this.value)" placeholder="Buscar...">
          <input class="btn" type="submit" name="btn" value="BUSCAR">
        </form>
      </div>
      <div class="enlaces">
        <a href="vistaVentasServ.php">Ver Reporte 1</a>
        <a href="vistaVentasServ2.php">Ver Reporte 2</a>
        <a href="editar.php">Editar Ventas</a>
        <a href="ConsultaInforme.php">Ver Informe</a>
        <a href="insertar.php">Nuevo Servicio</a>
      </div>
      <div class="" id="resultado">
        <?php
        include ('bd/conexion.php');
          if (isset($_POST['btn'])) {
            if (!empty($_POST['buscar'])) {
              $consulta=mysqli_query($conexion,"SELECT * FROM servicios WHERE DESCRIPCION LIKE '%$_POST[buscar]%'")or die(mysqli_error($conexion));
              if (mysqli_num_rows($consulta) > 0) {
                ?>
                <table border="1">
                  <tr>
                    <th>DESCRIPCION</th><th>PRECIO</th>
                  </tr>
                  <?php while ($reg=mysqli_fetch_array($consulta)) {
                   ?>
                  <tr>
                    <td><?php echo $reg['DESCRIPCION']; ?></td><td class="precio"><?php echo  "S/ ".number_format($reg['PRECIO'],2,".","."); ?></td>
                    <td><a href=" <?php echo 'caja.php?id='.$reg["ID"]; ?> "><img src="img/cashier.svg" alt=""></a></td>
                  </tr>
                  <?php } ?>
                </table>
                <?php
            }else {
              echo "<script>
              alert('No se encontraron resultados')
              </script>";
            }
          }else {
            echo "<script>
            alert('Ingrese un valor valido')
            </script>";
          }
          }
         ?>
      </div>
    </div>
  </body>
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("resultado").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("resultado").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","consulta.php?q="+str,true);
        //alert('VALOR SELECCIONADO: ' +str);
        xmlhttp.send();
    }
}
</script>
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/mayusculassintildes.js"></script>
  <script type="text/javascript">
       $(document).ready(function() {
           $("#texto").mayusculassintildes();
       });
  </script>
</html>
