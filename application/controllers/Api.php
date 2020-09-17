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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("empleados/LogicaEmpleados", "logicaEmpleados");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
        $this->load->model("solicitudes/Logica", "logicaSolicitudes");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
       	$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
    }
    //verifica empleados
    public function verificaDocumento()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            //consulto si el empleado existe
            $salida   = $this->logicaEmpleados->getListaEmpleados(array("emple.clave"=>sha1($objDatos['clave']),"emple.nroDocumento"=>$objDatos['nroDocumento']));
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //envio codigo de verificacion del usuario

    public function enviaCodigoLogin()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $codigo = generacodigonumerico(4);
            //consulto si el empleado existe
            $salida   = $this->logicaEmpleados->insertaCodigo($objDatos['idEmpleado'],$codigo);
            //data del empleado
            $dataempleado = $this->logicaEmpleados->getEmpleados($objDatos['idEmpleado']);
            //proceso a enviar el codigo por medio del metodo de envio seleccionado por el usuario.
            if($objDatos['metodoEnvio'] == 1)//via correo electronico
            {
                $para        =   $dataempleado['datos'][0]['emailEmpleado'];
                $asunto      =   "Codigo de verificacion ".lang("titulo");
                $mensaje     =   "Hola, ingresa el código que verás a continuación en la app móvil.<br><br>";
                $mensaje    .=   "<strong>".$codigo."</strong>";
                $mensajeW    =   "Hola, ingresa el código que verás a continuación en la app móvil. ";
                $mensajeW   .=   "*".$codigo."*";
                //plantilla del mail
                $plantilla   = plantillaMail($asunto,$mensajeW);
                //envio el codigo de ingreso al mail del usuario
                sendMail($para,$asunto,$plantilla);
                //envio el código de acceso al whatsapp de la persona
                sendWhatsappMessage("57".$dataempleado['datos'][0]['celularEmpleado'],"Probando Envio");
                $salida = array("mensaje"=>"Hemos enviado el mensaje al correo electrónico seleccionado, por favor verifique.",
                                "datos"=>array(),
                                "continuar"=>1);
            }
            else//via celular
            {
                $salida = array("mensaje"=>"Hemos enviado el mensaje al número de celular seleccionado, por favor verifique.",
                                "datos"=>array(),
                                "continuar"=>1);
            }
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }

    public function asignaContrasena()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logicaEmpleados->asignaContrasena($objDatos['idEmpleado'],$objDatos['repitaClave']);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }

    public function verificacionCodigoUsurio()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $where['emple.idEmpleado']              = $objDatos['idEmpleado'];
            $where['emple.codigoVerificacion']      = $objDatos['digitoA'].$objDatos['digitoB'].$objDatos['digitoC'].$objDatos['digitoD'];
            $salida = $this->logicaEmpleados->getListaEmpleados($where);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //solicitud de adelanto
    public function enviaSolicitud()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logicaEmpleados->insertaSolicitud($objDatos);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //Consulta FAQS
    public function consultaFaqs()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logica->consultaFaqs($objDatos);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //consulta la información del quiénes somos
    public function consultaQuienes()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logica->consultaQuienes();
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //Consulta BANCOS
    public function consultaBancos()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logica->consultaBancos($objDatos);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }
    //inserta el código de FCM en la base de datos
    public function updateTokenFCM()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logicaEmpleados->updateTokenFCM($objDatos);
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);

    }
    //funcion que me muestra las notificaciones sin leer
    public function getNotificacionesPersonaSinLeer()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        extract($objDatos);
        //súper acceso a la app
        if($objDatos['fuente'] == 'app')
        {
            $post['idPersona']      = $objDatos['idEmpleado'];
            $post['tipoUsuario']    = 'movil';
            $post['estado']         = 0;
            //busco la foto con la palabra que envien
            $noti = $this->logica->getNotificacionesPersona($post);
            echo json_encode($noti);
        }
        else
        {
            $respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
        }
    }
    //Notificaciones para la persona logueada
    public function getNotificacionesPersona()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        extract($objDatos);
        //súper acceso a la app
        if($objDatos['fuente'] == 'app')
        {
            $post['idPersona']      = $objDatos['idEmpleado'];
            $post['tipoUsuario']    = 'movil';
            //busco la foto con la palabra que envien
            $noti = $this->logica->getNotificacionesPersona($post);
            //pongo las notificaciones en estado leidas
            $unoti = $this->logica->updateNotificacionesPersona(array('estado'=>1),$post);
            echo json_encode($noti);
        }
        else
        {
            $respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
        }
    }
    //consulta de las solicitudes
    public function getSolicitudesUsuario()
    {
        $objDatos       = json_decode(file_get_contents("php://input"),true);
        if($objDatos['fuente'] == 'app')
        {
            $salida = $this->logicaSolicitudes->getSolicitudesUsuario(array("e.eliminado"=>0,"e.idEmpleado"=>$objDatos['idEmpleado']));
        }
        else
        {
            $salida = array("mensaje"=>"No tiene acceso a esta zona",
                                "datos"=>array(),
                                "continuar"=>0);
        }
        //retorno la salida del servidor
        echo json_encode($salida);
    }

}
?>