<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>

<title>Cargando archivo de alumnos</title>
</head>

<body>
<?php
header("Content-type: text/html; charset=utf8");   
include("conectarse.php");
   
   $link=Conectarse();


//copiamos el archivo a la carpeta temporal
  //    Script Que copia el archivo temporal subido al servidor en un directorio.
$tipo = $_FILES['tablacsv']['type'];

//    Definimos Directorio donde se guarda el archivo
$dir = '../archivos/';



if (!copy($_FILES['tablacsv']['tmp_name'], $dir.$_FILES['tablacsv']['name']))
echo '<script> alert("'.$id_error_upload.'");</script>';

//una vez transferido, lo abrimos e insertamos en la base de datos la información
//abro el archivo
move_uploaded_file($_FILES['tablacsv']['tmp_name'],$dir.$_FILES['tablacsv']['name']);
$arch=$dir.$_FILES['tablacsv']['name'];
echo "Cargando...";
//Quizás necesitemos instalar el paquete php5-mysqlnd
	$carga="LOAD DATA LOCAL  INFILE '$arch'  INTO TABLE alumnos CHARACTER SET latin1 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES ";
mysqli_query($link,$carga) or die (mysql_error($link));
	


	
echo "<meta http-equiv=\"refresh\" content=\"0;URL=elige.php\">";
	



?>

</body>
</html>
