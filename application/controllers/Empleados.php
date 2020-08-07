<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Empleados extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("empleados/LogicaEmpleados", "logicaEmpleados");
       	$this->load->helper('language');
		$this->lang->load('spanish');
        $this->load->library('Excel',"excel");
    }
    /*
    * Funcion inicial del módulo de creación de empleados
    * @author Farez Prieto
    * @date 23 de Julio de 2020
    * @param $idModulo Este parámetro siempre lo enviará el menú y siempre se deberá recibir en la función del módulo principal, no olvidar esto.
    * Esta función permite inicializar este módulo, dentro de ella siempre se debe declarar la variable de session $_SESSION['moduloVisitado'] con el $idModulo Pasado por parámetro
    * y a continuación siempre se debe llamar la función del helper llamada getPrivilegios, la función está en el archivo helpers/funciones_helper.php
    * Tenga en cuenta que cada llamado ajax que haga a una plantilla gráfica que incluya botones de ver,editar, crear, borrar debe siempre llamar la función getPrivilegios.
    */
	public function listaEmpleados($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "empleados/home";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
    }
	public function cargaViaExcel($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				if($_SESSION['project']['info']['idPerfil'] == 3)//si es admin y super admin
				{
					$infoEmpresa		   = $this->logica->consultaEmpresas();
				}
				else
				{
					$infoEmpresa		   = $this->logica->consultaEmpresas($_SESSION['project']['info']['idEmpresa']);
				}
				$salida['titulo']      = "Carga de empleados en Excel";
				$salida['edita'] 	   = 1;
				$salida['empresas']    = $infoEmpresa;
				$salida['labelBtn']    = "CARGAR EMPLEADOS";
				$salida['centro'] 	   = "empleados/formControlExcel";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
    }
    //funcion para agregar empresas
    public function gestionEmpleados($idModulo,$accion,$idEmpleado=0)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
                $opc 				   = "home";
                //selects de informacion
                $tiposDoc		  	 = $this->logica->consultatiposDoc();
                $empresas		  	 = $this->logica->consultaEmpresas();
                $salida["selects"]["tiposDoc"] = $tiposDoc;
                $salida["selects"]["empresas"] = $empresas;
                //valido la accion
                if($accion == 'editar')
                {
                    $infoEmpresa	       = $this->logicaEmpleados->getEmpleados($idEmpleado);
                    $salida['titulo']      = "Formulario de edición de empleados";
                    $salida['edita'] 	   = 1;
                    $salida['datos'] 	   = $infoEmpresa['datos'][0];
                    $salida['labelBtn']    = "EDITAR EMPLEADO";
                }
                else if($accion == 'crear')
                {
                    $salida['titulo']      = "Formulario de creación de empleados";
                    $salida['edita'] 	   = 0;
                    $salida['datos'] 	   = array();
                    $salida['labelBtn']    = "AGREGAR EMPLEADO";
                }
				$salida['centro'] 	   = "empleados/formControl";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
    }
    //metodo de ajax para traer las empresas
    public function getEmpleados()
    {
        $listaEmpleados = $this->logicaEmpleados->getEmpleados();
        echo json_encode($listaEmpleados);
    }
    //proceso los datos que se ingresan como nuevo se modifican
    public function procesaData()
    {
        $procesoEmpresa = $this->logicaEmpleados->procesaData($_POST);
        echo json_encode($procesoEmpresa);
    }
    public function eliminarData()
    {
        extract($_POST);
        $eliminaEmpresa = $this->logicaEmpleados->eliminarData($idBorrar);
        echo json_encode($eliminaEmpresa);
	}
	
	public function procesaExcel()
	{
		if(isset($_FILES) && $_FILES['excelFile']['name'] != "")
		{
			$config['upload_path'] 	 = './res/cargueMasivo';
	        $config['allowed_types'] = 'xls|xlsx';
	        $config['max_size'] 	 = 10240;
	        $config['encrypt_name']  = TRUE;
	        $file_element_name 		 = 'excelFile';

	        $this->load->library('upload', $config);
	        if(!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $data = $this->upload->data();
	            if($data)//carga perfectamente el archivo
	            {
	            	//var_dump($_POST);
					$dataExcel 		= $this->excel->importarExcel($data['full_path']);
					//die($data['full_path']);
	            	//ahora debo tomar la data del excel y realizar el cargue.
	            	$dataInsertada	= $this->logicaEmpleados->insertaMasivo($dataExcel,$_POST);		
	                @unlink($data['full_path']);
	                echo json_encode($dataInsertada);
	            }
	            else
	            {
	                @unlink($data['full_path']);
	                $salida = array("mensaje"=>"El archivo ".$data['file_name']." no ha sido cargado",
	                				"continuar"=>0,
	                				"datos"=>$data['file_name']);
	                echo json_encode($salida);
	            }
	            @unlink($_FILES[$file_element_name]);
	        	
	        }
	    }
	    else
	    {
	    	$salida = array("mensaje"=>"Recuerde que debe seleccionar un archivo para poder realizar el cargue. Sólo formatos xls y xlsx",
            				"continuar"=>0,
            				"datos"=>array());
            echo json_encode($salida);
	    }
	}
}
?>