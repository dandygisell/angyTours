<?php 
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';
$conexion = conectarse();

$sql = "SELECT *,`foliocatalogo` as id, `nombrehotel` AS value, `nombrehotel` AS label FROM `catalogo1` WHERE `nombrehotel` LIKE '%".$_GET["term"]."%'";


				$result=mysql_query($sql);
				while ($row=mysql_fetch_assoc($result)) {

					$data[]=$row;
				}
				echo json_encode($data);
?>