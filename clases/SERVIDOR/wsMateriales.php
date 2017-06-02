<?php 

require_once('../lib/nusoap.php'); 
require_once('../Usuario.php');
include_once("../Materiales.php");
include_once("../Cd.php");

$server = new nusoap_server(); 

$server->configureWSDL('WEB Server Usuarios', 'urn:userWS'); 

$server->register('Ingresar',                	// METODO
					array('usuario' => 'xsd:string',
					'clave' => 'xsd:string', 'correo' => 'xsd:string'),
					array('return' => 'xsd:Array'),    		// PARAMETROS DE SALIDA
					'urn:userWS'               		// NAMESPACE				  
				);
$server->register('TraerTodos',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);
$server->register('TraerTodosProductos',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodosProductos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Productos'    			
				);
$server->register('TraerUno',                	
					array('id' => 'xsd:int'),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#TraerTodos',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Usuarios'    			
				);
$server->register('Alta',                	
					array('nombre' => 'xsd:string',
							'precio' => 'xsd:int',
							'tipo' => 'xsd:string'),  
					array('return' => 'xsd:int'),   
					'urn:userWS',                		
					'urn:userWS#Alta',             
					'rpc',                        		
					'encoded',                    		
					'Alta de Un Producto'    			
				);
$server->register('Baja',                	
					array('usuario' => 'xsd:int'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Producto por Parametros'    			
				);
$server->register('Modificar',                	
					array('usuario' => 'xsd:string', 'correo' => 'xsd:string', 'clave' => 'xsd:string', 'tipo' => 'xsd:string', 'id' => 'xsd:string'),  
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Baja',             
					'rpc',                        		
					'encoded',                    		
					'Baja de Un Usuario por Parametros'    			
				);
$server->register('InsertarFoto',                	
				array('nombre' => 'xsd:string', 'id' => 'xsd:string'),  
				array('return' => 'xsd:string'),   
				'urn:userWS',                		
				'urn:userWS#Baja',             
				'rpc',                        		
				'encoded',                    		
				'Baja de Un Usuario por Parametros'    			
			);

$server->register('ObtenerTodosLosCds',                	
					array(),  
					array('return' => 'xsd:Array'),   
					'urn:userWS',                		
					'urn:userWS#ObtenerTodosLosCds',             
					'rpc',                        		
					'encoded',                    		
					'Trae Todos Los Cds'    			
				);

function TraerTodosProductos()
{
	return producto::TraerTodos();
}
	
function TraerTodos()
{
	return Material::TraerTodos();
}

function ObtenerTodosLosCds(){
	return Cd::TraerTodos();	
}

function Alta($nombre,$precio,$tipo)
{
	return Material::InsertarMaterial($nombre,$precio,$tipo);
		
		
		
		// if($cantidad ==1)
			// $flag = true;
		// else	
		// {
			// $flag =false;
		// }
			
        //return $flag;

}
function Baja($id)
{
		$cantidad = Material::BorrarMaterial($id);
		
		if($cantidad ==1)
			$Mensaje = "el user fue eliminado correctamente";
		else	
		{
			$Mensaje ="no se pudo eliminar";
		}
			
        return $Mensaje;

}
function Modificar($Codigo,$Nombre,$Precio,$Tipo)
{

		$cantidad = Material::Modificar($Codigo,$Nombre,$Precio,$Tipo);
		
		if($cantidad ==1)
			$Mensaje = "el user fue Updateado correctamente";
		else	
		{
			$Mensaje ="no se pudo eliminar";
		}
			
        return $Mensaje;
	
}


$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
$server->service($HTTP_RAW_POST_DATA);


?>