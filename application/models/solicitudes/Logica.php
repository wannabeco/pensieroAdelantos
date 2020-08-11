<?php
class Logica {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("solicitudes/BaseDatos","dbSolicitudes");
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

    
 }