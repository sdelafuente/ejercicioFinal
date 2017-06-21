
function Enunciado() {

    var pagina = "./enunciado.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        async: true
    })
    .done(function (grilla) {

        $("#divGrilla").html(grilla);

        var pagina = "./puntaje.php";

        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "html",
            async: true
        })
        .done(function (grilla) {

            $("#divAbm").html(grilla);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function MostrarGrilla() {
var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "MOSTRAR_GRILLA"
        },
        async: true
    })
    .done(function (html) {

        $("#divGrilla").html(html);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function MostrarCd() {
var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "MOSTRAR_CD"
        },
        async: true
    })
    .then(function (html) {

        $("#divGrilla").html(html);
    }, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function CargarFormNuevoMaterial() {

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM"
        },
        async: true
    })
    .then(
        function (html) {

            $("#divAbm").html(html);
            $('#cboTipo > option[value="usuario"]').attr('selected', 'selected');
        }
       ,function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function AgregarMaterial() {
   var pagina = "./administracion.php";
    var id = $("#hdnIdMaterial").val();
	var nombre = $("#txtNombre").val();
	var precio = $("#txtPrecio").val();
	var tipo = $("#cboTipo").val();	
	var material = {};	
	
    material.Codigo = id;
	material.Nombre= nombre;
	material.Precio = precio;
	material.Tipo= tipo;
	
	$.ajax({
        url:pagina, 
        type:"post",
        dataType:"text",
        data:{
                queMuestro : "ALTA_MATERIAL", 
                material : material
           }}
    )
	.then( function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	   alert(objJson);
		// var objJsonPaseado = JSON.parse(objJson);
		
        // alert(objJsonPaseado.Mensaje);
        // if (!objJsonPaseado.Exito) {
            // alert(objJsonPaseado.Mensaje);
            // return;
        // }

        $("#divAbm").html("");
        MostrarGrilla();
		// var objJsona = JSON.parse(objJson);
		// alert(objJsona.Mensaje);
         // console.log("recibirJSON()");
         // console.log(resultado);
	}, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	

}

function ModificarMaterial() {//#3a
  if (!confirm("Modificar material?")) {
		//si es  Cancelar
        return;
    }
	//si es aceptar
	//material.accion="Modificar";
    //alert(material);
    var pagina = "./administracion.php";
    var Codigo = $("#hdnIdMaterial").val();
	var Nombre = $("#txtNombre").val();
	var Precio = $("#txtPrecio").val();
	var Tipo = $("#cboTipo").val();
	
	var material = {};
    material.Codigo = Codigo;
	material.Nombre= Nombre;
	material.Precio = Precio;
	material.Tipo  = Tipo;
    
	
	$.ajax({
        url:pagina, 
        type:"post",
        dataType:"text", 
        data:{
                queMuestro : "MODIFICAR_MATERIAL", 
                material : material
             }
        }).then( function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
	
		 var objJsonPaseado = JSON.parse(objJson);
		alert(objJsonPaseado);
       
        // if (!objJsonPaseado.Exito) {
			// MostrarGrilla();
            // alert(objJsonPaseado.Mensaje);
            // return;
        // }

        $("#divAbm").html("");
        MostrarGrilla();
		// var objJsona = JSON.parse(objJson);
		// alert(objJsona.Mensaje);
         // console.log("recibirJSON()");
         // console.log(resultado);
	}, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	

 

}


function Modificar(objMaterial) {//#3b

    var pagina = "./administracion.php";

    objMaterial.accion ='Modificar';

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM",
            material: objMaterial
        },
        async: true
    })
   .then( function (html) {
        
        //CargarFormNuevoMaterial();
        $("#divAbm").html(html);

        },function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });     
 
}

function EliminarMaterial(objMaterial) {//#3b

    if (!confirm("Eliminar material?")) {
        return;
    }

    var pagina = "./administracion.php";

    var codigoBorrar = objMaterial.Codigo;
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            queMuestro: "ELIMINAR_USUARIO",
            codigoBorrar: codigoBorrar
        },
        async: true
    })
   .then( function (objJson) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
		alert(objJson);
        MostrarGrilla();
		
		}, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 	
 
}


function Logout() {//#5

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            queMuestro: "LOGOUT"
        },
        async: true
    })
    .then(function (objJson) {


        window.location.href = "login.php";

    },function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
