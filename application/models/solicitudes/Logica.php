<?php
class Logica {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("solicitudes/BaseDatos","dbSolicitudes");
        $this->ci->load->model("empleados/BaseDatosEmpleados","dbEmpleados");
    } 
    public function getSolicitudes($filtro = array())
    {
        if(count($filtro) > 0)
        {
            $where = $filtro;
        }
        else
        {
            $where = array();
        }
        //valido que si la persona que esta logueada es una empresa me traiga solo las solicitudes de la empresa
        if(isset($_SESSION['project']) && in_array($_SESSION['project']['info']['idPerfil'],array(3,4)) && $_SESSION['project']['info']['idEmpresa'] != "")
        {
            $where['s.idEmpresa']     = $_SESSION['project']['info']['idEmpresa'];
        }

        $solicitudes = $this->ci->dbSolicitudes->getSolicitudes($where);
        if(count($solicitudes) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de solicitudes consultado.",
                          "continuar"=>1,
                          "datos"=>$solicitudes); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay solicitudes creados aún.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 
    public function getCobros($filtro = array())
    {
        if(count($filtro) > 0)
        {
            $where = $filtro;
        }
        else
        {
            $where = array();
        }
        //valido que si la persona que esta logueada es una empresa me traiga solo las solicitudes de la empresa
        if(isset($_SESSION['project']) && in_array($_SESSION['project']['info']['idPerfil'],array(3,4)) && $_SESSION['project']['info']['idEmpresa'] != "")
        {
            $where['s.idEmpresa']     = $_SESSION['project']['info']['idEmpresa'];
        }

        $cobros = $this->ci->dbSolicitudes->getCobros($where);
        if(count($cobros) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de cobros consultado.",
                          "continuar"=>1,
                          "datos"=>$cobros); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay cobros creados aún.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 

    public function getSolicitudesUsuario($where)
    {
        $solicitudesLista = $this->ci->dbSolicitudes->getSolicitudes($where);
        //recorro para traer las transacciones y saber la última que se realizó
        $nArray = array();
        foreach($solicitudesLista as $sol)
        {
            $ultimaTransaccion         =  $this->ci->dbSolicitudes->ultimaTransaccion(array("idSolicitud"=>$sol['idSolicitud']));
            $arrayTemp["ultimaTrans"]  =   $ultimaTransaccion[0];
            foreach($sol as $llave=>$solLis)
            {
                $arrayTemp[$llave]         =   $solLis;   
            }
            array_push($nArray,$arrayTemp);
        }
        if(count($solicitudesLista) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de solicitudes consultado.",
                          "continuar"=>1,
                          "datos"=>$nArray); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay solicitudes creados aún.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }

    public function gestionaSolicitud($post)
    {
        extract($post);
        $infoSolicitud = $this->ci->dbSolicitudes->getSolicitudes(array('idSolicitud'=>$idSolicitud));
        $mensajeSalida = "";
        //valido que mensaje de exito mostrar
        if($estado == 'aprobada')//solicitud aprobada
        {
            $mensajeSalida = "La solicitud de adelanto de nómina por valor de $".number_format($infoSolicitud[0]['monto'],0,',','.')." ha sido ".$estado;
        }
        else if($estado == 'rechazada')//solicitud rechazada
        {
            $mensajeSalida = "La solicitud de adelanto de nómina por valor de $".number_format($infoSolicitud[0]['monto'],0,',','.')." ha sido ".$estado;
        }
        else if($estado == 'pagada')//solicitud rechazada
        {
            $mensajeSalida = "La solicitud de adelanto de nómina por valor de $".number_format($infoSolicitud[0]['monto'],0,',','.')." ha sido ".$estado;
        }

        $dataInsertar['estado']     = $estado;
        $where['idSolicitud']       = $idSolicitud;
        $solicitudes = $this->ci->dbSolicitudes->gestionaSolicitud($where,$dataInsertar);
        //var_dump($infoSolicitud);die();
        if($solicitudes > 0)
        {
            //inserta una transaccion
            //tambien inserto la transaccion inicial para la solicitud.
            $dataInsertarTrans['idSolicitud']   = $idSolicitud;
            $dataInsertarTrans['idEmpleado']    = $idEmpleado;
            $dataInsertarTrans['idPersona']     = $_SESSION['project']['info']['idPersona'];
            $dataInsertarTrans['fechaTrans']    = date("Y-m-d H:i:s");
            $dataInsertarTrans['estado']        = $estado;
            $dataInsertarTrans['ip']            = getIP();
            $dataInsertarTrans['userAgent']     = $_SERVER['HTTP_USER_AGENT'];
            $respuestaSolicitud = $this->ci->dbEmpleados->insertaSolicitudTrans($dataInsertarTrans);
            //valido la insercion
            if($respuestaSolicitud > 0)
            {
                //debo enviar un mail al administrador del sistema avisando de que alguien realizo un adelanto de salario
                $para        =   $infoSolicitud[0]['emailEmpleado'];
                $asunto      =   "Solicitud de adelanto de nómina".lang("titulo");
                $mensaje     =   "La solicitud de adelanto de nómina nro: ".$idSolicitud." ha sido <strong>".$estado."</strong>. <br><br>";
                $mensaje    .=   "<strong>Solicitante: </strong> ".$infoSolicitud[0]['nombres']." ".$infoSolicitud[0]['apellidos']."<br>";
                $mensaje    .=   "<strong>Empresa: </strong> ".$infoSolicitud[0]['nombre']."<br>";
                $mensaje    .=   "<strong>Monto solicitado: </strong> $".number_format($infoSolicitud[0]['monto'],0,',','.')."<br>";
                $mensaje    .=   "<strong>Fecha y hora de solicitud: </strong> ".$infoSolicitud[0]['fechaSolicitud']."<br><br>";
                $plantilla   = plantillaMail($asunto,$mensaje);
                //envio el codigo de ingreso al mail del usuario
                sendMail($para,$asunto,$plantilla);
                //envio una notificacion push al usuario
                sendFCM("Cambio de estado en solicitud",$mensajeSalida,$infoSolicitud[0]['FCMToken']);
                //inserto una notificación para que sea en la sección notificaciones de la app móvil.
                insertaNotificacion("Cambio de estado en solicitud",$mensajeSalida,$idEmpleado,"movil");
                //respuesta
                $respuesta = array("mensaje"=>"La solicitud de adelanto de nómina por $".number_format($infoSolicitud[0]['monto'],0,',','.')." ha sido <strong>".$estado."</strong>",
                          "continuar"=>1,
                          "datos"=>"");     
            }
            else
            {
                $respuesta = array("mensaje"=>"No se ha podido realizar el proceso de gestión de la solicitud, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>""); 

            }
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido realizar el proceso de gestión de la solicitud, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }
    
 }