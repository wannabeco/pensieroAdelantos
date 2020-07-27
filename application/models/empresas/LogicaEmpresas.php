<?php
class LogicaEmpresas {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("empresas/BaseDatosEmpresas","dbEmpresas");
    } 
    public function getEmpresas($idEmpresa="")
    {
        if($idEmpresa != "")
        {
            $where['idEmpresa']     = $idEmpresa;
        }
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $listadoAreas = $this->ci->dbEmpresas->getEmpresas($where);
        if(count($listadoAreas) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de áreas empresariales consultado.",
                          "continuar"=>1,
                          "datos"=>$listadoAreas); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay áreas de trabajo creadas aún, no olvide crearlas haciendo clic en el boton ACCIONES > AGREGAR NUEVA ÁREA.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 
    public function procesaEmpresas($post)
    {
        extract($post);
        if($edita == 1)//quiere decir que actualizo la informacion
        {
            $dataActualiza  = $post;
            unset($dataActualiza['edita']);
            unset($dataActualiza['idEmpresa']);
            $whereActualiza['idEmpresa'] = $idEmpresa;
            $proceso = $this->ci->dbEmpresas->actualizaEmpresa($whereActualiza,$dataActualiza);
            if($proceso)
            {
                $salida = array("mensaje"=>"La información de la empresa se ha actualizado de manera correcta",
                                "continuar"=>1,
                                "datos"=>array());
            }
            else
            {
                $salida = array("mensaje"=>"La información de la empresa no se ha podido actualizar, intente de nuevo más tarde o contacte al área de soporte.",
                                "continuar"=>0,
                                "datos"=>array());
            }
        }
        else//creacion de una nueva empresa
        {
            $dataInserta  = $post;
            unset($dataInserta['edita']);
            unset($dataInserta['idEmpresa']);
            $proceso = $this->ci->dbEmpresas->insertaEmpresa($dataInserta);
            if($proceso)
            {
                $salida = array("mensaje"=>"La empresa ha sido creada de manera exitosa",
                                "continuar"=>1,
                                "datos"=>array());
            }
            else
            {
                $salida = array("mensaje"=>"La empresa no ha podido ser creada, intente de nuevo más tarde o contacte al área de soporte.",
                                "continuar"=>0,
                                "datos"=>array());
            }
        }
        return $salida;
    }

    public function eliminarEmpresa($idEmpresa)
    {
        $dataActualiza['eliminado']  = 1;
        $dataActualiza['estado']     = 0;
        $whereActualiza['idEmpresa'] = $idEmpresa;
        $proceso = $this->ci->dbEmpresas->actualizaEmpresa($whereActualiza,$dataActualiza);
        if($proceso)
        {
            $salida = array("mensaje"=>"La empresa ha sido eliminada de manera correcta.",
                            "continuar"=>1,
                            "datos"=>array());
        }
        else
        {
            $salida = array("mensaje"=>"La empresa no ha posido ser eliminada, intente de nuevo más tarde o contacte al área de soporte.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
 }