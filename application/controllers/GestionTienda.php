<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GestionTienda extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("gestionTienda/LogicaTienda", "logicaTienda");
       	$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
    }
	public function categorias($idModulo)	
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
				$salida['centro'] 	   = "edicionTienda/categorias/home";
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

	public function getCategoriasAdmin()
	{
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['idEstado']   = 1;
		$categorias	     = $this->logicaTienda->getCategorias($where);
		echo json_encode($categorias);
	}
	public function procesaCategoria()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$categorias	     = $this->logicaTienda->procesaCategoria($_POST);
		echo json_encode($categorias);
	}
	public function eliminaCategoria()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$categorias	     = $this->logicaTienda->eliminaCategoria($_POST);
		echo json_encode($categorias);
	}


	public function plantillaCreaCategoria()
	{
		extract($_POST);
		//listados 
		//$tiposDoc		  	 = $this->logica->consultatiposDoc(); 
		//$sexo		  	 	 = $this->logica->consultaSexo(); 
		//$perfiles  	 	 = $this->logica->consultaPerfiles(); 
		$salida["selects"]   = array();
		if($edita == 1)
		{	
			//busca la info de la categoria
			$infoCategoria	     = $this->logicaTienda->infoCategoria($idProducto);
			$salida["titulo"] 	 = "Editar el categoría ";
			$salida["datos"]  	 = $infoCategoria['datos'][0];
			$salida["idProducto"] = $idProducto;
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR CATEGORÍA";
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nueva categoría";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["idProducto"] = $idProducto;
			$salida["labelBtn"]  = "CREAR CATEGORÍA";
		}
		echo $this->load->view("edicionTienda/categorias/formControl",$salida,true);
	}

	//subcategorias
	public function subcategorias($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			//var_dump($_SESSION['project']['info']);die();
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
				$salida['centro'] 	   = "edicionTienda/subcategorias/home";
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
	//productos
	public function productos($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{

			//var_dump($_SESSION['project']['info']);die();
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
				$salida['centro'] 	   = "edicionTienda/productos/home";
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
	//funciones para la creción y edición de las subcategorias
	public function getSubCategoriasAdmin()
	{
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['s.idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['s.idEstado']   = 1;
		$subCategorias	     = $this->logicaTienda->getSubcategoriasAnidada($where);
		echo json_encode($subCategorias);
	}

	public function plantillaCreaSubCategoria()
	{
		extract($_POST);
		
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['idEstado']   = 1;
		$categorias	     = $this->logicaTienda->getCategorias($where); 

		$salida["selects"]   = array("categorias"=>$categorias['datos']);
		if($edita == 1)
		{	
			//busca la info de la categoria
			$infoSubCategoria	     = $this->logicaTienda->getSubcategorias(array("idSubcategoria"=>$idSubcategoria));
			$salida["titulo"] 	 = "Editar el Subcategoría ";
			$salida["datos"]  	 = $infoSubCategoria['datos'][0];
			$salida["idProducto"] = $idSubcategoria;
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR SUBCATEGORÍA";
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nueva Subcategoría";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["idProducto"] = $idSubcategoria;
			$salida["labelBtn"]  = "CREAR SUBCATEGORÍA";
		}
		echo $this->load->view("edicionTienda/subcategorias/formControl",$salida,true);
	}
	public function procesaSubCategoria()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$resultado	     = $this->logicaTienda->procesaSubCategoria($_POST);
		echo json_encode($resultado);
	}
	public function eliminaSubCategoria()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$resultado	     = $this->logicaTienda->eliminaSubCategoria($_POST);
		echo json_encode($resultado);
	}
	//todo el tema de los productos
	public function getProductosAdmin()
	{
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['p.idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['p.idEstado']   = 1;
		$categorias	     = $this->logicaTienda->getProductosAnidados($where);
		echo json_encode($categorias);
	}

	public function plantillaCreaSubProductos()
	{
		extract($_POST);
		
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['idEstado']   = 1;
		$categorias	     = $this->logicaTienda->getCategorias($where); 

		$salida["selects"]   = array("categorias"=>$categorias['datos']);
		if($edita == 1)
		{	
			//busca la info de la categoria
			$infoProducto	       		= $this->logicaTienda->infoProducto(array("idPresentacion"=>$idPresentacion));
			$salida["titulo"] 	        = "Editar el producto ";
			$salida["datos"]  	        = $infoProducto['datos'][0];
			$salida["idPresentacion"]   = $idPresentacion;
			$salida["persistencia"]  	= 0;
			$salida["edita"]  	 		= $edita;
			$salida["labelBtn"]  		= "EDITAR PRODUCTO";
			$vista = $this->load->view("edicionTienda/productos/formControl",$salida,true);
			$respuesta = array("json"=>$infoProducto['datos'][0],"html"=>$vista);
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nueva producto";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["persistencia"]  = 0;
			$salida["idPresentacion"] = $idPresentacion;
			$salida["labelBtn"]  = "CREAR PRODUCTO";
			$vista = $this->load->view("edicionTienda/productos/formControl",$salida,true);
			$respuesta = array("json"=>array(),"html"=>$vista);
		}
		echo json_encode($respuesta);
	}
	public function getSubcategoriasSel()
	{
		extract($_POST);
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['idProducto']   = $categoria;

		$listaSubcat = $this->logicaTienda->getSubcategorias($where);
		$salida["data"] 	 	= $listaSubcat['datos'];
		$salida["persistencia"] = $persistencia;
		echo $this->load->view("edicionTienda/productos/selectSubcat",$salida,true);
	}

	public function procesaProducto()
	{
		
		$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$idTienda 			 = $_SESSION['project']['info']['idTienda'];
		// if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		// {
		// 	$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		// 	$idTienda 			 = $_SESSION['project']['info']['idTienda'];
		// }
		extract($_POST);
		if(isset($_FILES) && $_FILES['fotoPresentacion']['name'] != "")
		{
			@mkdir('assets/uploads/files/'.$idTienda,"0777");

			$config['upload_path'] 	 = 'assets/uploads/files/'.$idTienda.'/';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] 	 = 200048;
            // $config['max_width']     = 800;
            // $config['max_height']    = 800;
	        $config['encrypt_name']  = TRUE;
	        $file_element_name 		 = 'fotoPresentacion';
	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors();
	           //var_dump($msg);
	            $salida = array("mensaje"=>"No se ha podido realizar la carga de la foto de perfil, probablemente la falla sea porque ha superado el tamaño permitido de 2 MB ó no tenga el formato que se necesita: PNG, JPG ó GIF, supere",
            				"continuar"=>0,
            				"datos"=>array());
	        }
	        else
	        {
	            $data 					= $this->upload->data();
	            $_POST['fotoPresentacion']	=	$data['file_name'];
	            $_POST['idTienda']			=	$idTienda;
	            //procedo a actualizar la información del usuario
	            $salida 	 	=  $this->logicaTienda->procesaProductos($_POST);        	
	        }
	    }
	    else
	    {
            $_POST['fotoPresentacion']	=	(isset($_POST['fotoActual']))?$_POST['fotoActual']:"";
            $_POST['idTienda']			=	$idTienda;
            //procedo a actualizar la información del usuario
            $salida 	 	=  $this->logicaTienda->procesaProductos($_POST);   
	    }
        echo json_encode($salida);
	}

	public function plantillaVariaciones()
	{
		extract($_POST);
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
		{
			$where['idTienda']   = $_SESSION['project']['info']['idTienda'];
		}
		$where['idEstado']   	   = 1;
		$where['idPresentacion']   = $idPresentacion;
		$edita = 0;
		//busca la info de la categoria
		$infoProducto	       		= $this->logicaTienda->infoProducto($where);
		$variaciones	       		= $this->logicaTienda->getVariaciones($where);
		$salida["titulo"] 	        = "Variaciones del producto";
		$salida["infoProducto"]     = $infoProducto['datos'][0];
		$salida["variaciones"]  	= $variaciones['datos'];
		$salida["idPresentacion"]   = $idPresentacion;
		$salida["edita"]  	 		= $edita;
		$salida["labelBtn"]  		= "GUARDAR VARIACIONES";
		echo $this->load->view("edicionTienda/productos/formVariaciones",$salida,true);

	}
	public function procesaVariaciones()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$resultado	     = $this->logicaTienda->procesaVariaciones($_POST);
		echo json_encode($resultado);
	}
	public function eliminaProducto()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$proceso	     = $this->logicaTienda->eliminaProducto($_POST);
		echo json_encode($proceso);
	}
	public function eliminaVariacion()
	{
		$_POST['idTienda']   = $_SESSION['project']['info']['idTienda'];
		$proceso	     = $this->logicaTienda->eliminaVariacion($_POST);
		echo json_encode($proceso);
	}

}
