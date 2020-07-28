<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosEmpleados extends CI_Model {
    private $tableDeptos                 =   "";
    private $tableCiudad                 =   "";
    private $tableMails                  =   "";
    private $tableInfoPago               =   "";
    private $tableEmpleados               =   "";
    private $tablePersonas               =   "";
    private $tableAreas                  =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tableDeptos               = "app_departamentos"; 
        $this->tableCiudad               = "app_ciudades"; 
        $this->tableMails                = "app_mails";
        $this->tableInfoPago             = "app_estadopago";
        $this->tableEmpleados            = "app_empleados";
        $this->tableEmpresas             = "app_empresas";
        $this->tablePersonas             = "app_personas";
        $this->tableAreas                = "app_areas";
    }
    public function getEmpleados($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpleados." emple");
        $this->db->join($this->tableEmpresas." empre","empre.idEmpresa=emple.idEmpresa");
        $this->db->order_by("emple.nombres","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function insertarData($dataInserta)
    {
        $this->db->insert($this->tableEmpleados,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }

    public function actualizaData($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableEmpleados,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }   
    public function borrarData($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableEmpleados,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }   
}
?>