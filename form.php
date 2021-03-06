<?php
    require_once("verificar_sesion.php");
    require_once("clases/AccesoDatos.php");
    require_once("clases/Materiales.php");


    if (!isset($material)) {//alta
        $Id             = "";
        $Nombre         = "";
        $Precio         = "";
    	$Tipo           = "";
        $botonClick     = "AgregarMaterial()";
        $botonTitulo    = "Guardar";
        
    } else {
        $Id     = $material->id;
        $Nombre = $material->nombre;
        $Precio = $material->precio;
        $Tipo   = $material->tipo;
    	
        if(isset($material->accion)){
            $botonClick     = $material->accion == "Modificar" ? "ModificarMaterial()" : "EliminarMaterial()";    
            $botonTitulo    = $material->accion;
        }
        else {
            $botonClick     = "ModificarMaterial()";    
            $botonTitulo    = "Editar Material";        
        }
    }

    $perfiles = Material::TraerTipos();


?>
<div id="divFrm" class="animated bounceInLeft" style="height:330px;overflow:auto;margin-top:0px;border-style:solid">
    <input type="hidden" id="hdnIdMaterial" value="<?php echo $Id; ?>" />
    <input type="text" placeholder="Nombre material" id="txtNombre" value="<?php echo $Nombre; ?>" />
    <input type="text" placeholder="Precio" id="txtPrecio" value="<?php echo $Precio; ?>" />
 
    <span>Seleccione Tipo de Material</span>
    <select id="cboTipo" >
        <?php
        foreach ($perfiles AS $p) {
            $miTipo = isset($material->tipo) ? $material->tipo : "";
            $selected = $miTipo == $p["Tipo"] ? "selected" : "";
            echo "<option value='" . $p["Tipo"] . "' " . $selected . ">" . $p["Tipo"] . "</option>";
        }
        ?>	
    </select>
    <br/><br/>

    <input type="button" class="MiBotonUTN" onclick="<?php echo $botonClick; ?>" value="<?php echo $botonTitulo; ?>"  />
    <input type="hidden" id="hdnQueHago" value="agregar" />
</div>