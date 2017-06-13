<?php

class Login {

    static function ValidarLogin( $obj ) {

        //Usuarios 
        $db_txt = 'usuarios.txt';       
        
        //Verifico que exista el archivo de usuarios
        if (is_file($db_txt)) {
            //Capturos todos los registros del archivo
            $lineas = file($db_txt);

            //Loop 
            foreach ($lineas as $linea) {
                //Separo en una lista los datos de los usuarios
                list($user,$pass,$perfil) = explode("=>",trim($linea),3);

                //Verifico que el username y la password sean texto
                if (is_string($user)  &&  is_string($pass)) {
                    
                    //Si el usuario que cargue pertenece a la lista, lo agrego a una cookie
                    if ( $user == $obj->email && $obj->pass) {
                        
                        //Set la Cookie
                        setcookie("user_mail",$obj->email ,  time()+30 , '/');
                        
                        $obj->nombre = strstr($obj->email, '@', true);
                        $obj->perfil = $perfil;
                        
                        $_SESSION['Usuario']= json_encode($obj);                        
                    }
                }
            }

        } else {
            $obj->Exito = false;
        }   

        return $obj;
    }
}

//Verifico la session
if (!isset($_SESSION)) {
    //Start Session     
    session_start();
   if (!isset($_SESSION['appLucasRodriguezSession_on'])) {
      header("location:frmLogin.php");
   }

}
    require_once('clases/lib/nusoap.php');
	require_once('clases/Usuario.php');
	require_once('clases/AccesoDatos.php');
	
	//Capturo el Usuario logueado 
    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
	
    //Clase Standard 
    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";
	$obj->email = $usuario->Email;
	$obj->pass = $usuario->Password;
	$obj->nombre ="";
	$obj->perfil = "";

    	
    //Devuelvo el Objeto 
    echo json_encode(Login::ValidarLogin($obj));