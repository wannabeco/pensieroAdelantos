<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatos extends CI_Model {
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
        $this->tableSolicitudes          = "app_solicitudes";
        $this->tableSolicitudesTrans     = "app_solicitudes_trans";
        $this->table_bancos              = "app_bancos";
    }
    public function getSolicitudes($where=array())
    {
        $this->db->select("s.estado as estadoSol,s.*,e.email as emailEmpleado,e.telefono as telefonoEmpleado,e.direccion as direccionEmpleado,e.*,b.*,em.* ");
        if(count($where) > 0)
        {
            $this->db->where($where);
        }

        $this->db->from($this->tableSolicitudes." s");
        $this->db->join($this->tableEmpleados." e","e.idEmpleado = s.idEmpleado",'INNER');
        $this->db->join($this->table_bancos." b","b.idEntidad=s.idEntidad",'INNER');
        $this->db->join($this->tableEmpresas." em","em.idEmpresa=s.idEmpresa",'INNER');
        $this->db->order_by("s.fechaSolicitud","DESC");
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
    public function gestionaSolicitud($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableSolicitudes,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }  
}
?>