/*
* Controlador que maneja todas las funcionalidades de la zona empresas
* @author Farez Prieto @orugal
* @date 24 de Julio 2020
*/
project.controller('solicitudes', function($scope,$http,$q,constantes)
{
	$scope.solicitudes 	= [];
	$scope.init = function()
	{
		$scope.config 			=  configLogin; //configuración global
        $scope.getSolicitudes();
	}

	$scope.initInterno = function()
	{
		$scope.config 			=  configLogin; //configuración global
	}
	$scope.getSolicitudes = function()
	{
        //capturo los valores de los filtros
        var fechasFiltro    = $("#fechasFiltro").val();
        var mesBusca    	= $("#mesBusca").val();
        var anoBusca    	= $("#anoBusca").val();
        var estado          = $("#estado").val();
		var controlador = 	$scope.config.apiUrl+"Solicitudes/getSolicitudes";
		var parametros  = 	"fechasFiltro="+fechasFiltro+"&mesBusca="+mesBusca+"&anoBusca="+anoBusca+"&estado="+estado;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.solicitudes		=	json.datos;
				$scope.$digest();
			}
			else
			{
                $scope.solicitudes		=	json.datos;
                $scope.$digest();
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

    $scope.gestionaSolicitud = function(idSolicitud,estado,idEmpleado)
    {
    	constantes.confirmacion("Atención","Esta apunto de cambiar el estado de la solicitud a "+estado+", desea continuar","warning",function(){
    		var controlador = 	$scope.config.apiUrl+"Solicitudes/gestionaSolicitud";
			var parametros  = 	"idSolicitud="+idSolicitud+"&estado="+estado+"&idEmpleado="+idEmpleado;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					constantes.alerta("Atención",json.mensaje,"success",function(){})
				}
				else
				{
					constantes.alerta("Atención",json.mensaje,"info",function(){})
				}
			});
    	})
    }
    
});
//controlador de pagos
project.controller('cobrosController', function($scope,$http,$q,constantes)
{
	$scope.cobros 	= [];
	$scope.init = function()
	{
		$scope.config 			=  configLogin; //configuración global
        $scope.getCobros();
	}
	//obtiene el listado de sobros
	$scope.getCobros = function()
	{
        //capturo los valores de los filtros
        var mesBusca    	= $("#mesBusca").val();
        var anoBusca    	= $("#anoBusca").val();
		var controlador = 	$scope.config.apiUrl+"Solicitudes/getCobros";
		var parametros  = 	"mesBusca="+mesBusca+"&anoBusca="+anoBusca;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.cobros		=	json.datos;
				$scope.$digest();
			}
			else
			{
                $scope.cobros		=	json.datos;
                $scope.$digest();
				//constantes.alerta("Atención",json.mensaje,"warning",function(){})
			}
		});
		
	}

});
