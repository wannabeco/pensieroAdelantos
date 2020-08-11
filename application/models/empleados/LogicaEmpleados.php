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
        if(isset($_SESSION['project']) && in_array($_SESSION['project']['info']['idPerfil'],array(3,4)) && $_SESSION['project']['info']['idEmpresa'] != "")
        {
            $where['emple.idEmpresa']     = $_SESSION['project']['info']['idEmpresa'];
        }

        $where['emple.estado']        = 1;
        $where['emple.eliminado']     = 0;
        $listaEmpleados = $this->ci->dbEmpleados->getEmpleados($where);
        if(count($listaEmpleados) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de empleados consultado.",
                          "continuar"=>1,
                          "datos"=>$listaEmpleados); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay empleados creados aún, no olvide crearlas haciendo clic en el boton ACCIONES > AGREGAR NUEVA ÁREA.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 

    public function getListaEmpleados($where)
    {
        $where['emple.estado']        = 1;
        $where['emple.eliminado']     = 0;
        $listaEmpleados = $this->ci->dbEmpleados->getEmpleados($where);
        if(count($listaEmpleados) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de empleados consultado.",
                               "continuar"=>1,
                               "datos"=>$listaEmpleados); 
        }
        else
        {
            $respuesta = array("mensaje"=>"La información ingresada no coincide con ninguna en nuestra base de datos, por favor verifique nuevamente",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    } 
    public function insertaSolicitud($post)
    {
        extract($post);
        //obtengo la data del empleado
        $where['emple.estado']        = 1;
        $where['emple.eliminado']     = 0;
        $where['emple.idEmpleado']    = $idEmpleado;
        $listaEmpleados = $this->ci->dbEmpleados->getEmpleados($where);
        //verifico que el usuario no tenga creada ya una solicitud para este mes
        $verificoSolicitudes = $this->ci->dbEmpleados->verificaSolicitudes(array('idEmpleado'=>$idEmpleado,'mes'=>date("m")));
        //si no tiene solicitudes creadas para el mes, lo dejo pasar
        if(count($verificoSolicitudes) == 0)
        {
            //$nroSolicitud       =     
            //realizo el calculo del interes y todo eso
            $interesAPagar      = (($monto * _INTERES_COBRO) / 100);
            $montoConInteres    = ($monto + $interesAPagar);
            //procedo a insertar la data de la solicitud
            $dataInsertar['idEmpleado']             = $idEmpleado;
            $dataInsertar['idEmpresa']              = $listaEmpleados[0]['idEmpresa'];
            $dataInsertar['mes']                    = date('m');
            $dataInsertar['ano']                    = date('Y');
            $dataInsertar['monto']                  = $monto;
            $dataInsertar['montoConInteres']        = $montoConInteres;
            $dataInsertar['valorInteres']           = $interesAPagar;
            $dataInsertar['interes']                = _INTERES_COBRO;
            $dataInsertar['idEntidad']              = $entidadBancaria;
            $dataInsertar['tipoCuenta']             = $tipoCuenta;
            $dataInsertar['nroCuenta']              = $cuentaBanco;
            $dataInsertar['idMotivo']               = $motivo;
            $dataInsertar['motivo']                 = $cualMotivo;
            $dataInsertar['fechasolicitud']         = date("Y-m-d H:i:s");
            $dataInsertar['ip']                     = getIP();
            $dataInsertar['userAgent']              = $_SERVER['HTTP_USER_AGENT'];
            //inserto la solicitud
            $respuestaSolicitud = $this->ci->dbEmpleados->insertaSolicitud($dataInsertar);
            //tambien inserto la transaccion inicial para la solicitud.
            $dataInsertarTrans['idSolicitud']   = $respuestaSolicitud;
            $dataInsertarTrans['idEmpleado']    = $idEmpleado;
            $dataInsertarTrans['idPersona']     = 0;
            $dataInsertarTrans['fechaTrans']    = date("Y-m-d H:i:s");
            $dataInsertarTrans['estado']        = 'recibida';
            $dataInsertarTrans['ip']            = getIP();
            $dataInsertarTrans['userAgent']     = $_SERVER['HTTP_USER_AGENT'];
            $respuestaSolicitud = $this->ci->dbEmpleados->insertaSolicitudTrans($dataInsertarTrans);
            //valido la insercion
            if($respuestaSolicitud > 0)
            {
                $respuesta = array("mensaje"=>"La solicitud de adelanto de nómina se ha llevado a cabo de manera exitosa, su número de solicitud es el: <strong>".$respuestaSolicitud."</strong>, pronto estaremos comunicandonos con usted.",
                          "continuar"=>1,
                          "datos"=>"");     
            }
            else
            {
                $respuesta = array("mensaje"=>"Estimado usuario, no se ha podido llevar a cabo la solicitud de adelanto de nómina, por favor intente más tarde. Si el problema persiste por favor comuníquese con su empresa.",
                              "continuar"=>0,
                              "datos"=>""); 

            }
        }
        else
        {
            $respuesta = array("mensaje"=>"Estimado usuario, usted ya ha realizado una solicitud de adelanto de nómina para el mes ".traducirMes(date("m")),
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
        //     
        //     
        //     motivo
    }
    public function insertaCodigo($idEmpleado,$codigo)
    {
        $whereActualiza['idEmpleado']           = $idEmpleado;
        $dataActualiza['codigoVerificacion']    = $codigo;
        $dataActualiza['caducidadCodigo']       = date("Y-m-d H:i:s");
        $proceso = $this->ci->dbEmpleados->actualizaData($whereActualiza,$dataActualiza);
        if($proceso)
        {
            $salida = array("mensaje"=>"codigo insertado",
                            "continuar"=>1,
                            "datos"=>array());
        }
        else
        {
            $salida = array("mensaje"=>"Codigo no insertado",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
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
    //inserta empleados masivos
    public function insertaMasivo($dataExcel,$post)
    {
        $nuevoArrayConData = array();
        $encabezados    =  $this->getPrimeraLinea($dataExcel);
        //elimino la primer línea de el excel para eliminar los encabezados
        unset($dataExcel[1]);
        //recorro los encabezados generados para armar un arreglo final, esperemos que funcione.
        foreach($dataExcel as $datos)
        {
            $cont = 0;//creo un contador en cero cada vez que recorra una línea del arreglo del excel
            foreach($datos as $llave=>$valor)//recorro los datos del excel internos
            {
                //analiso los nombres de la columna para  verificar que se llamen igual que en la base de datos
                if(strtolower($encabezados[$cont]) == 'tipodocumento')
                {
                    if($valor == 'cedula')
                    {
                        $nvalor = 4;
                    }
                    else if($valor == 'nit')
                    {
                        $nvalor = 9;
                    }
                    else if($valor == 'rut')
                    {
                        $nvalor = 10;
                    }
                    else
                    {
                        $nvalor = 11;
                    }
                    $nArray['tipoDocumento'] = $nvalor;
                }
                else if(strtolower($encabezados[$cont]) == 'documento')
                {
                    $nArray['nroDocumento'] = $valor;
                }
                else if(strtolower($encabezados[$cont]) == 'genero')
                {
                    if($valor == 'f')
                    {
                        $nvalor = 2;
                    }
                    else if($valor == 'm')
                    {
                        $nvalor = 1;
                    }
                    $nArray['genero'] = $nvalor;
                }
                else if(strtolower($encabezados[$cont]) == 'estado')
                {
                    if($valor == 'activo')
                    {
                        $nvalor     = 1;
                        $nvalorel   = 0;
                    }
                    else if($valor == 'inactivo')
                    {
                        $nvalor     = 0;
                        $nvalorel   = 1;
                    }
                    else
                    {
                        $nvalor     = 0;
                        $nvalorel   = 1;
                    }
                    $nArray['estado']    = $nvalor;
                    $nArray['eliminado'] = $nvalorel;
                }
                else if(strtolower($encabezados[$cont]) == 'celular')
                {
                    $nArray['telefono'] = $valor;
                }
                else
                {
                    //para poder armar el nuevo arreglo con las llaves del arreglo con los valores de la primera fila lo que hago es valerme del contador que va incrementando ya que en teoría siempre serán de la misma longitud.
                    $nArray[$encabezados[$cont]] = $valor;
                }
                $nArray['idEmpresa'] = $post['idEmpresa'];
                $cont++;
            }
            //asigno al arreglo final
            array_push($nuevoArrayConData,$nArray);
        }
        //procedo a insertar la informacion en la tabla de los empleados.
        $cont2 = 0;
        $tablaEmpleados = 'app_empleados';
        //a esta altura es porque la creación de tabla ha salido correcta, ahora se procede a insertar la información
        foreach($nuevoArrayConData as $dataInserta)
        {
            //verifico que el usuario no este registrado ya para insertarlo, de lo contrario lo actualizo
            $verificaEmpleado =  $this->ci->dbEmpleados->getEmpleados(array('emple.nroDocumento'=>$dataInserta['nroDocumento']));
            if(count($verificaEmpleado) == 0)//inserto la data
            {
                $insercionDatos   =  $this->ci->dbEmpleados->insertaDataTablaCreada($dataInserta,$tablaEmpleados);
            }
            else ///actualizo la data
            {
                $insercionDatos   =  $this->ci->dbEmpleados->actualizaDataTablaCreada(array('nroDocumento'=>$dataInserta['nroDocumento']),$dataInserta,$tablaEmpleados);
            }
            $cont2++;
        } 
        if($cont2 == count($nuevoArrayConData))
        {
            auditoria("CREACIONLISTAEMPLEADOS","Se ha creado un nuevo empleado | ".$tablaEmpleados);
            $salida = array("mensaje"=>"La lista se ha creado exitosamente el listado de empleados.",
                            "continuar"=>1,
                            "datos"=>array());
        }
        else
        {
            auditoria("CREACIONLISTAEMPLEADOSFALLIDA","No se han cargado todos los empleados del listado | ".$tablaEmpleados);
            $salida = array("mensaje"=>"No se han cargado todos los empleados del listado, por favor verifique.",
                            "continuar"=>1,
                            "datos"=>array());
        }
        return $salida;
    }
    //primera linea de los excel
    public function getPrimeraLinea($dataExcel)
    {
        $primerLinea  =  $dataExcel[1];
        foreach($primerLinea as $llave=>$linea1)
        {
            $campos[] = eliminaCaracteres($linea1);
        }
        return $campos;
    }
 }