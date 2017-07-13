<?php 

require_once('../lib/nusoap.php'); 
include_once("../Materiales.php");
include_once("../Cd.php");

$server = new nusoap_server(); 

$server->configureWSDL('WEB Server Materiales', 'urn:userWS'); 

$server->register('Ingresar',                	// METODO
					array('usuario' => 'xsd:string',
					'clave' => 'xsd:string', 'correo' => 'xsd:string'),
					array('return' => 'xsd:Array'),    		// PARAMETROS DE SALIDA
					'urn:userWS'               		// NAMESPACE				  
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
					array(
							'id' => 'xsd:string', 
							'nombre' => 'xsd:string', 
							'precio' => 'xsd:string', 
							'tipo' => 'xsd:string'
						 ), 
					array('return' => 'xsd:string'),   
					'urn:userWS',                		
					'urn:userWS#Modificar',             
					'rpc',                        		
					'encoded',                    		
					'Modificar un material'    								
				);

$server->register('AltaMaterial',                	
					array('nombre' => 'xsd:string',
							'precio' => 'xsd:int',
							'tipo' => 'xsd:string'),  
					array('return' => 'xsd:int'),   
					'urn:userWS',                		
					'urn:userWS#AltaMaterial',             
					'rpc',                        		
					'encoded',                    		
					'Alta de Un Producto'    			
				);
$server->register('ObtenerLosMateriales',
					array(),
					array('return' => 'xsd:Array'),
					'urn:userWS',
					'urn:userWS#ObtenerLosMateriales',
					'rpc',
					'encoded',
					'Trae Todos Los Cds'
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


/**
* 
*
* @return	Traer la lista completa de materiales 
* @access	public
*/	
function ObtenerLosMateriales()
{
	return Material::TraerTodos();
}

/**
* 
*
* @return	Nada
* @access	public
*/
function AltaMaterial($nombre,$precio,$tipo)
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

/**
* 
*
* @return	
* @access	public
*/
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

/**
* 
*   
* @return	
* @access	public
*/
function Modificar($Id,$Nombre,$Precio,$Tipo)
{
		$cantidad = Material::Modificar($Id,$Nombre,$Precio,$Tipo);
		
		if($cantidad == 1)
			$Mensaje = "el material fue Updateado correctamente";
		else	
		{
			$Mensaje ="no se pudo eliminar";
		}
			
        return $Mensaje;
	
}

/**
* 
*
* @return	
* @access	public
*/
function ObtenerTodosLosCds(){
	return Cd::TraerTodos();	

}


$HTTP_RAW_POST_DATA = file_get_contents("php://input");
	
$server->service($HTTP_RAW_POST_DATA);

?>