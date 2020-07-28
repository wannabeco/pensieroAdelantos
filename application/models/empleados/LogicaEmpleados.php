<?php
class LogicaEmpleados {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("empleados/BaseDatosEmpleados","dbEmpleados");
    } 
    public function getEmpleados($idEmpleado="")
    {
        if($idEmpleado != "")
        {
            $where['emple.idEmpleado']     = $idEmpleado;
        }
        /*
         * valido si el usuario logueado es una empresa, si es una empresa solo traigo sus empleados, 
         * si es un super administrador le muestro todos los empleados
         */
        if(in_array($_SESSION['project']['info']['idPerfil'],array(3,4)) && $_SESSION['project']['info']['idEmpresa'] != "")
        {
            $where['emple.idEmpresa']     = $_SESSION['project']['info']['idEmpresa'];
        }

        $where['emple.estado']        = 1;
        $where['emple.eliminado']     = 0;
        $listadoAreas = $this->ci->dbEmpleados->getEmpleados($where);
        if(count($listadoAreas) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de empleados consultado.",
                          "continuar"=>1,
                          "datos"=>$listadoAreas); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay empleados creados aún, no olvide crearlas haciendo clic en el boton ACCIONES > AGREGAR NUEVA ÁREA.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 
    public function procesaData($post)
    {
        extract($post);
        if($edita == 1)//quiere decir que actualizo la informacion
        {
            $dataActualiza  = $post;
            unset($dataActualiza['edita']);
            unset($dataActualiza['idEmpleado']);
            $whereActualiza['idEmpleado'] = $idEmpleado;
            $proceso = $this->ci->dbEmpleados->actualizaData($whereActualiza,$dataActualiza);
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
            unset($dataInserta['idEmpleado']);
            $proceso = $this->ci->dbEmpleados->insertarData($dataInserta);
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

    public function eliminarData($idEmpleado)
    {
        $dataActualiza['eliminado']  = 1;
        $dataActualiza['estado']     = 0;
        $whereActualiza['idEmpleado'] = $idEmpleado;
        $proceso = $this->ci->dbEmpleados->actualizaData($whereActualiza,$dataActualiza);
        if($proceso)
        {
            $salida = array("mensaje"=>"La empleado ha sido eliminado de manera correcta.",
                            "continuar"=>1,
                            "datos"=>array());
        }
        else
        {
            $salida = array("mensaje"=>"El empleado no ha podido ser eliminado, intente de nuevo más tarde o contacte al área de soporte.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
 }