/*
* Controlador que maneja todas las funcionalidades de la zona empresas
* @author Farez Prieto @orugal
* @date 24 de Julio 2020
*/
project.controller('empleados', function($scope,$http,$q,constantes)
{
	$scope.empleados 	= [];
	$scope.empleadosInit = function()
	{
		$scope.config 			=  configLogin; //configuración global
		$scope.getEmpleados();
	}

	$scope.procesaEmpresasInit = function()
	{
		$scope.config 			=  configLogin; //configuración global
	}
	$scope.getEmpleados = function()
	{
		var controlador = 	$scope.config.apiUrl+"Empleados/getEmpleados";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.empleados		=	json.datos;
				$scope.$digest();
			}
			else
			{
				//constantes.alerta("Atención",json.mensaje,"warning",function(){})
			}
		});
	}

	$scope.compileAngularElement = function(elSelector) {

        var elSelector = (typeof elSelector == 'string') ? elSelector : null ;  
            // The new element to be added
        if (elSelector != null ) {
            var $div = $( elSelector );

                // The parent of the new element
                var $target = $("[ng-app]");

              angular.element($target).injector().invoke(['$compile', function ($compile) {
                        var $scope = angular.element($target).scope();
                        $compile($div)($scope);
                        // Finally, refresh the watch expressions in the new element
                        $scope.$apply();
                    }]);
            }

	}

	//funcion que procesa la empresa, sea crear o editar
	$scope.procesaEmpresa = function()
	{
		//capturo la data
		var nombre = $("#nombre").val();
		var tipoDocumento = $("#tipoDocumento").val();
		var nroDocumento = $("#nroDocumento").val();
		var nombreEncargado = $("#nombreEncargado").val();
		var direccion = $("#direccion").val();
		var telefono = $("#telefono").val();
		var celular = $("#celular").val();
		var email = $("#email").val();
		var estado = $("#estado").val();
		var idEmpresa = $("#idEmpresa").val();
		var edita 	  = $("#edita").val();
		//valido campos
		if(nombre == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre de la empresa","warning",function(){})
		}
		else if(tipoDocumento == "")
		{
			constantes.alerta("Atención","Seleccione el tipo de documento de identificacion de la empresa","warning",function(){})
		}
		else if(nroDocumento == "")
		{
			constantes.alerta("Atención","Escriba el número de documento de identificacion de la empresa, si es nit puede agregar el número de verificación","warning",function(){})
		}
		else if(nombreEncargado == "")
		{
			constantes.alerta("Atención","Escriba el nombre del representante legal","warning",function(){})
		}
		else if(direccion == "")
		{
			constantes.alerta("Atención","Escriba la dirección de la empresa","warning",function(){})
		}
		else if(telefono == "")
		{
			constantes.alerta("Atención","Escriba el teléfono de contacto de la empresa","warning",function(){})
		}
		else if(email == "")
		{
			constantes.alerta("Atención","Escriba un correo electrónico de contacto para la empresa","warning",function(){})
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","El correo ingresado no tiene una sintaxis válida","warning",function(){})
		}
		else
		{
			var texto = (edita == 1)?"Está a punto de editar la información de la empresa, desea continuar":"Está a punto de agregar una empresa con la información agregada, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Empleados/procesaEmpresa";
				var parametros  =   $("#formAgregaEmpresa").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){})
					}
				});
			});
		}
	}

	$scope.borrarEmpleado = function(idEmpresa)
	{
		constantes.confirmacion("Confirmación","Esta a punto de eliminar la empresa seleccionada, desea continuar",'info',function(){
			var controlador = 	$scope.config.apiUrl+"Empleados/eliminarEmpleado";
			var parametros  =   "idEmpresa="+idEmpresa;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					})
				}
				else
				{
					constantes.alerta("Atención",json.mensaje,"warning",function(){})
				}
			});
		});
	}
		
});
