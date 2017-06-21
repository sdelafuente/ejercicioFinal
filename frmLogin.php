<?php 
if(isset($_COOKIE["user_mail"]))
    $mail = $_COOKIE["user_mail"];
else
    $mail = "";

 ?>
<html>
    <head>
        <title>ABM Materiales</title>

        <meta charset="UTF-8">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones_login.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <!--h1>   </h1-->      
            </div>
            <div class="CajaInicio animated bounceInRight">
                <h1>LOGIN</h1>

                <form id="FormIngreso" method="post">
                    <input type="text" id="email" placeholder="E-mail" value="<?php echo $mail; ?>" />
                    <input type="password" id="password" placeholder="Password" value="" />					
                    <input type="button" class="btn btn-danger" value="Log In" onclick="Login()" />
                    <input type="button" class="btn btn-danger" value="Admin" onclick="cargarUsuario('admin')" />
                    <input type="button" class="btn btn-danger" value="Vendedor" onclick="cargarUsuario('vendedor')" />
                    <input type="button" class="btn btn-danger" value="Comprador" onclick="cargarUsuario('comprador')" />
                    <input type="button" class="btn btn-danger" value ="delete cookie" onclick= "delete_cookie('user_mail');"/>                    
                </form>
            </div>
            <div style="text-align:center">
                <?php
				//Pase por parametro USS=1
                if (isset($_GET["uss"])) {
                    echo "<h1>Usuario sin Sesi&oacute;n Activa!!!</h1>";
                }
                ?>
            </div>
        </div>
    </body>
</html>