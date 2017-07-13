<?php 
//session_start();
//if(isset($_SESSION['registrado']))
//{

//require_once("clases/AccesoDatos.php");
require_once("clases/Materiales.php");
require_once('clases/lib/nusoap.php');
	
$host = 'http://localhost/ejercicioFinal/clases/SERVIDOR/wsMateriales.php';
$client = new nusoap_client($host . '?wsdl');

$arrayDeMateriales=$client->call('ObtenerLosMateriales');
//$arrayDeMateriales=Material::TraerTodos();

$err = $client->getError();
if ($err) {
	echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
	die();
}

$user = $_SESSION["Usuario"];

$miUser = json_decode($user);

?>
<table class="table"  style=" background-color: beige;color:black;">
	<thead>
		<tr>
			<?php
			if($miUser->perfil!='comprador'){
				echo "<th>Editar</th><th>Borrar</th><th>Codigo Prod</th><th>Nombre</th><th>Precio</th><th>Tipo</th>";
			} else {
				echo "<th>Codigo Prod</th><th>Nombre</th><th>Precio</th><th>Tipo</th>";
			}
			?>
		</tr>
	</thead>
	<tbody>

<?php 

foreach ($arrayDeMateriales as $material) {

	$objMaterial = array();
	$objMaterial['id'] = $material['id'];
	$objMaterial['nombre'] = $material['nombre'];
	$objMaterial['precio'] = $material['precio'];
	$objMaterial['tipo'] = $material['tipo'];
	$objMaterial['accion'] = "";
	
	$objMaterial = json_encode($objMaterial);
	
	$botones= "<td><a onclick='Modificar($objMaterial)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
		<td><a onclick='EliminarMaterial($objMaterial)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
			";
	$grilla = "<td>".$material['id']."</td>
			   <td>".$material['nombre']."</td>
			   <td>".$material['precio']."</td>
			   <td>".$material['tipo']."</td>
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

?>