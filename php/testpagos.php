<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="../css/kendo.common.min.css">
	<link rel="stylesheet" type="text/css" href="../css/kendo.default.min.css">
</head>
<body>

busqueda pagos pendientes

 <table id="lista_Tablas_Pendientes" class="table">
     <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Observaciones</th>
        <th>Modificar</th>
        
      </thead>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tbody>
    </table>

    busqueda pagos cerrados

 <table id="lista_Tablas_Cerrados" class="table">
     <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Observaciones</th>
        <th>Modificar</th>
        
      </thead>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tbody>
    </table>
	

	bitacora ingresos



 <table id="lista_Tablas_Ingresos" class="table">
     <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Observaciones</th>
        <th>Modificar</th>
        
      </thead>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tbody>
    </table>

    bitacoras egresos

 <table id="lista_Tablas_Egresos" class="table">
     <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Observaciones</th>
        <th>Modificar</th>
        
      </thead>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tbody>
    </table>
	
	<script src="../js/jquery-1.11.0.min.js"></script>
  <script src="../js/bjqs-1.3.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/busqueda.js"></script>
	<div id="grid" style="width:700px; height:455px;"></div>

	<script src="../js/jquery-2.0.2.min.js"></script>
	<script src="../js/kendo.all.min.js"></script>
	<script>
	   /*LEEME:
		PRIMERO CREO UN ARREGLO JSON PARA UTILIZARLO EN EL KENDO,
		OJO LOS INDICES DEL JSON TIENEN QUE IGUALITOS CUANDO ESCRIBAS EL FIELD DENTO DEL KENDO POR
		EJEMPO MI INDICE EN JSON ES id, EN UN APARTADO DE KENDO ESTA COLUMNS AHI ESTA EL PARAMETRO
		FIELD ESTE FIELD ES EL NOMBRE DEL INDICE O COLUMNA DEL JSON ES id

			ejemplo

			columns:[
					{
					field:"id" /* es igualito al indice del json que tiene indice id*/
					/*title:"Ide empl" */ /*el parametro title es para poner el nombre del columna en el kendo */
				/*	}
				];
	   */
		var jsonObj=[
				{id:1,fecEmp:"2014/02/18",hEnEmp:"07:38:45",hSaEmp:"13:05:06"},
				{id:2,fecEmp:"2014/02/18",hEnEmp:"07:30:01",hSaEmp:"13:00:05"}
			];
		/*
			CREO UN OBJETO DE KENDO DATASOURCE PARA UTILIZARLO EN EL KENDO
		*/
		var ds = new kendo.data.DataSource({
				data: jsonObj,
				dataSource:'pruebaKendo.php',
				pageSize:10 /* NUMERO DE ELEMENTOS QUE MOSTRA POR PAGINA EN EL KENDO*/
			});

		/* DECLARO EL KENDO Y PONGO LOS PARAMETROS CORRESPONDIENTES PARA QUE PUEDA FUNCIONAR*/
		$("#grid").kendoGrid({
				filterable:true, /* FILTRADO */
				sortable:true,
				pageable:{      /* PAGINADO DE 5 EN 5  */
					pageSizes:5
				},
				dataSource: ds,
				columns:[
					{
					field:"id",
					title:"Ide empl"
					},
					{
						field:"fecEmp",
						title:"Fecha Empleado"
					},
					{
						field:"hEnEmp",
						title:"Hora Empleado"
					},
					{
						field:"hSaEmp",
						title:"Hora Empleado"
					}
				]
			});

	</script>

</body>
</html>