/*
* Controlador que maneja todas las funcionalidades de la zona empresas
* @author Farez Prieto @orugal
* @date 24 de Julio 2020
*/
project.controller('empleados', function($scope,$http,$q,constantes)
{
	$scope.empleados 	= [];
	$scope.init = function()
	{
		$scope.config 			=  configLogin; //configuración global
		$scope.getEmpleados();
	}

	$scope.initInterno = function()
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

	$scope.procesaExcel = function()
	{
		//validación de campos
		var excelFile 	= $("#excelFile").val();
		var empresa 	= $("#idEmpresa").val();

		if(empresa == "")
		{
			constantes.alerta("Atención","Seleccione la empresa a la que le desea cargar el listado.","info",function(){})
		}
		else if(excelFile == "")
		{
			constantes.alerta("Atención","Debe seleccionar un archivo de Excel.","info",function(){})
		}
		else
		{
			constantes.confirmacion("Confirmación","Está a punto de generar una carga masiva de empleados a partir del archivo de excel seleccionado, esta acción puede tardar dependiendo la cantidad de registros del archivo excel, desea continuar?",'info',function()
			{
					var formData 	=   new FormData($("#formExcel")[0]);
			        var controlador = 	$scope.config.apiUrl+"Empleados/procesaExcel"; 
			        //hacemos la petición ajax  
			        parametros	=	formData;
			        $.ajax({
			            url: controlador,  
			            type: 'POST',
			            data: parametros,
			            dataType:"json",
			            cache: false,
			            contentType: false,
			            processData: false,
			            beforeSend: function(){
			                     
			            },
			            //una vez finalizado correctamente
			            success: function(json)
			            {
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
			            },
			            //si ha ocurrido un error
			            error: function(){
			              
			            }
			        });
			});
		}

	}

	//funcion que procesa la empresa, sea crear o editar
	$scope.procesaData = function()
	{
		//capturo la data
		var nombres 		= $("#nombres").val();
		var apellidos 		= $("#apellidos").val();
		var tipoDocumento 	= $("#tipoDocumento").val();
		var nroDocumento 	= $("#nroDocumento").val();
		var direccion		= $("#direccion").val();
		var telefono 		= $("#telefono").val();
		var email 			= $("#email").val();
		var genero 			= $("#genero").val();
		var idEmpresa 		= $("#idEmpresa").val();
		var cargo 			= $("#cargo").val();
		var salario 		= $("#salario").val();
		var edita 			= $("#edita").val();
		//valido campos
		if(nombres == "")
		{
			constantes.alerta("Atención","Debe escribir los nombres del empleado","warning",function(){})
		}
		else if(apellidos == "")
		{
			constantes.alerta("Atención","Debe escribir los apellidos del empleado","warning",function(){})
		}
		else if(tipoDocumento == "")
		{
			constantes.alerta("Atención","Seleccione el tipo de documento de identificacion","warning",function(){})
		}
		else if(nroDocumento == "")
		{
			constantes.alerta("Atención","Escriba el número de documento de identificacion del empleado","warning",function(){})
		}
		else if(direccion == "")
		{
			constantes.alerta("Atención","Debe escribir la dirección de residencia del empleado","warning",function(){})
		}
		else if(telefono == "")
		{
			constantes.alerta("Atención","Escriba el teléfono de contacto del empleado","warning",function(){})
		}
		else if(email == "")
		{
			constantes.alerta("Atención","Escriba el correo electrónico del empleado","warning",function(){})
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","Escriba un correo electrónico válido","warning",function(){})
		}
		else if(idEmpresa == "")
		{
			constantes.alerta("Atención","Por favor seleccione la empresa","warning",function(){})
		}
		else if(genero == "")
		{
			constantes.alerta("Atención","Por favor indique el género del empleado","warning",function(){})
		}
		else if(cargo == "")
		{
			constantes.alerta("Atención","Por favor especifique el cargo del empleado","warning",function(){})
		}
		else if(salario == "")
		{
			constantes.alerta("Atención","Es importante que indique el salario devengado por el empleado","warning",function(){})
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
			var texto = (edita == 1)?"Está a punto de editar la información del empleado, ¿desea continuar?":"Está a punto de agregar un nuevo empleado con la información agregada, ¿desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Empleados/procesaData";
				var parametros  =   $("#formulario").serialize();
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

	$scope.borrarData = function(idBorrar)
	{
		constantes.confirmacion("Confirmación","Esta a punto de eliminar el usuario seleccionado, desea continuar",'info',function(){
			var controlador = 	$scope.config.apiUrl+"Empleados/eliminarData";
			var parametros  =   "idBorrar="+idBorrar;
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
