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
        var estado          = $("#estado").val();
		var controlador = 	$scope.config.apiUrl+"Solicitudes/getSolicitudes";
		var parametros  = 	"fechasFiltro="+fechasFiltro+"&estado="+estado;
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
    
});
