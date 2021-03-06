<?php
    require_once("verificar_sesion.php");

    $user = $_SESSION["Usuario"];

?>
<html>
    <head>
        <title>ABM Materiales</title> 

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/animacion.css">

    </head>
    <body>
        <div class="container" style="width:100%" >
            <div class="page-header">
            <?php
                $objUser = json_decode($user);
                
			    if($objUser->perfil !='invitado')//grilla
				{ 
				   echo "<a class='btn btn-default animated bounceInLeft' href='#' onclick='MostrarGrilla()'><span class='glyphicon glyphicon-th'>&nbsp;</span>Grilla&nbsp;</a>";
				}
			    
                if($objUser->perfil !='comprador') // agregar usuario
			    {
				   echo "<a class='btn btn-info animated bounceInLeft' href='#' onclick='CargarFormNuevoMaterial()'><span class='glyphicon glyphicon-user'>&nbsp;</span><span class='glyphicon glyphicon-plus-sign'></span>Agregar Material&nbsp;</a>";
				}
			    
                if($objUser->perfil !='invitado') // mostrar cds
				{
				   echo "<a class='btn btn-default animated bounceInLeft' href='#' onclick='MostrarCd()'><span class='glyphicon glyphicon-th'>&nbsp;</span>MOSTRARCDS&nbsp;</a>";
				}
				
                echo "<a class='btn btn-danger animated bounceInLeft' href='#' onclick='Logout()'><span class='glyphicon glyphicon-off'></span>LogOut&nbsp;</a>";
              
			  ?>
                <span id="spanDatos" class="animated bounceInRight" style='margin-top:-10px' >
                    <h3><?php echo $objUser->nombre . " - " . $objUser->perfil; ?></h3>
                </span>
            </div>
            <h1 style="font-size:28px">ABM de Materiales</h1>

            <div id="divAbm"  style='border-style:none;float:left;width:30%'>
			 <?php
					if(isset($_COOKIE['user_mail']))
						echo $_COOKIE['user_mail'];				
               ?>
            </div>
            <div id="divGrilla"  style='border-style:none;float:right;width:70%'>

            </div>
        </div>
    </body>
</html>