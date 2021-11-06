<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo es el controlador que realizara al cuál se harán los llamados desde las url en la página o en los procesos AJAX que se utilicen.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Solicitudes extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("solicitudes/Logica", "logicaSolicitudes");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
       	$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
    }

	public function listaSolicitudes($idModulo)	
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
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreLargo'];
				$salida['centro'] 	   = "solicitudes/home";
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

	public function infoSolicitud($idModulo,$idSolicitud)	
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
				$infoSolicitud		   = $this->logicaSolicitudes->getSolicitudes(array('s.idSolicitud'=>$idSolicitud));
				//var_dump($infoSolicitud['datos'][0]);die();
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreLargo'];
				$salida['centro'] 	   = "solicitudes/infoSolicitud";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoSolicitud']  = $infoSolicitud['datos'][0];
				$salida['idSolicitud']  = $idSolicitud;
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
    
    public function getSolicitudes()
    {
        extract($_POST);
        //armo la data del filtro
		$explodeFecha = explode(' - ',$fechasFiltro);
		$where['s.mes'] = $mesBusca;
		$where['s.ano'] = $anoBusca;
        //$where['s.fechaSolicitud >= '] = $explodeFecha[0].' 00:00:00';
        //$where['s.fechaSolicitud <= '] = $explodeFecha[1].' 23:59:59';

        if($estado != '')
        {
            $where['s.estado'] = $estado;
        }
        
        //$filtro =
        $listaSolicitudes =  $this->logicaSolicitudes->getSolicitudes($where);
        echo json_encode($listaSolicitudes);
    } 
    public function gestionaSolicitud()
    {
        extract($_POST);
        $gestionSolicitud =  $this->logicaSolicitudes->gestionaSolicitud($_POST);
        echo json_encode($gestionSolicitud);
	}


	//cobros de dinero
	public function Cobros($idModulo)	
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
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreLargo'];
				$salida['centro'] 	   = "solicitudes/cobros";
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
	public function getCobros()
    {
        extract($_POST);
        //armo la data del filtro
		$where['s.mes'] 			= $mesBusca;
		$where['s.ano'] 			= $anoBusca;
		$where['s.estado'] 			= 'pagada';
		$where['s.idReembolso'] 	= 0;
        //consulto
        $listaCobros =  $this->logicaSolicitudes->getCobros($where);
        echo json_encode($listaCobros);
    } 
	public function pruebaMail()
	{
		$asunto = "PRUEBA ENVIO MAIL GMAIL";
		$mensaje = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo blanditiis ex odit voluptatibus! Dolor at corrupti necessitatibus! Exercitationem qui veritatis, tenetur velit atque soluta harum ducimus itaque tempora sunt. Illum.";
		//plantilla del mail
		$plantilla   = plantillaMail($asunto,$mensaje);
		//envio el codigo de ingreso al mail del usuario
		$envioMail   = sendMail("kyo20052@gmail.com",$asunto,$plantilla);
	}
}
?>