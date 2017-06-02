<?php 
//session_start();
//if(isset($_SESSION['registrado']))
//{
	require_once("clases/AccesoDatos.php");
	require_once("clases/Materiales.php");
	require_once("clases/Usuario.php");
require_once('clases/lib/nusoap.php');

		$host = 'http://localhost/2parcial-utn1/clases/SERVIDOR/wsMateriales.php';     
		$client = new nusoap_client($host . '?wsdl');

		 $arrayDeMateriales=$client->call('TraerTodos', array());
	//	$arrayDeMateriales=Material::TraerTodos();


	$user = $_SESSION["Usuario"];

     $miUser = json_decode($user);
 ?>
<table class="table"  style=" background-color: beige;color:black;">
	<thead>
		<tr>
	<?php	if($miUser->perfil!='comprador'){ echo "<th>Editar</th><th>Borrar</th><th>Codigo Prod</th><th>Nombre</th><th>Precio</th><th>Tipo</th>";}
			else {echo "<th>Codigo Prod</th><th>Nombre</th><th>Precio</th><th>Tipo</th>";}
	?>

		</tr>
	</thead>
	<tbody>

<?php 

foreach ($arrayDeMateriales as $material) {
	$objMaterial = array();
			$objMaterial['Codigo'] = $material['Codigo'];
			$objMaterial['Nombre'] = $material['Nombre'];
			$objMaterial['Precio'] = $material['Precio'];
			$objMaterial['Tipo'] = $material['Tipo'];
			$objMaterial['accion'] = "";
			$objMaterial = json_encode($objMaterial);
			$botones= "<td><a onclick='EditarUsuario($objMaterial)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
			<td><a onclick='EliminarUsuario($objMaterial)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
			";
			$grilla="
			<td>".$material['Codigo']."</td>
			<td>".$material['Nombre']."</td>
			<td>".$material['Precio']."</td>
			<td>".$material['Tipo']."</td>
			</tr>   ";

			if($miUser->perfil!='comprador')
					
			$grilla= "<tr>" . $botones. $grilla;
				else
			$grilla= "<tr>" . $grilla;				
	

	echo $grilla;
}			
		 ?>
	</tbody>
</table>

<?php 	
//}else	{
//		echo "<h4 class='widgettitle'>No estas registrado</h4>";
//	}

	 ?>