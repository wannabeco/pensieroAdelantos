<?php
/*

    ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo llamado lógica es el que se encargará de realizar procesos con la información obtenida de las
   bases de datos, aquí se realizan validaciones, armados de arreglos, procesos de calculos y muchos más por el estilo, aquí no deben
   realizarse querys directos a la base de datos, para eso se usa el archivo modelo de base de datos
   
*/
class LogicaTienda  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("gestionTienda/BaseDatosTienda","dbTienda");//reemplazar por el archivo de base de datos real
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");//reemplazar por el archivo de base de datos real
    } 
    public function infoCategoria($idProducto)
    {
        $where['idProducto'] = $idProducto;
        /*if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
        {
            $where['idTienda']   = $_SESSION['project']['info']['idTienda'];
        }*/
        $resultado = $this->ci->dbTienda->getCategorias($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"Info de la categoria",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No existe la categoria seleccionada",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getInfoTienda($url="",$idTienda="")
    {
        if($url != "")
        {
            //$where['dominioTienda'] = $url;
            $resultado = $this->ci->dbTienda->getInfoTiendaLike($url);
        }

        if($idTienda != "")
        {
            $where['idTienda'] = $idTienda;
            $resultado = $this->ci->dbTienda->getInfoTienda($where);
        }

        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"Info de la tienda",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No existe la tienda seleccionada",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function eliminaCategoria($post)
    {
        $dataActualiza['idEstado'] = 0;
        $resultado = $this->ci->dbTienda->actualizaCategoria($post,$dataActualiza);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"La categoría se ha eliminado exitosamente",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha podido eliminar la categoría, intente de nuevo más tarde",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function procesaCategoria($post)
    {
        extract($post);
        if($edita == 0)//agrega
        {
            unset($post['edita']);
            unset($post['idProducto']);
            $post['nombreProducto'] = mb_strtoupper($post['nombreProducto']);
            $resultado = $this->ci->dbTienda->agregaCategoria($post);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Categoría creada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido crear la categoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        else//actualiza
        {
            $where['idProducto']            = $idProducto;
            $dataActualiza['nombreProducto'] = mb_strtoupper($post['nombreProducto']);
            $resultado = $this->ci->dbTienda->actualizaCategoria($where,$dataActualiza);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Categoría actualizada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido actualizar la categoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        return $salida;
    }
    public function getCategorias($where=array())
    {
        $resultado = $this->ci->dbTienda->getCategorias($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"categorias consultadas",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay categorías creadas",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getSubcategorias($where=array())
    {
        $resultado = $this->ci->dbTienda->getSubcategorias($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"Subcategorias consultadas",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay Subcategorias creadas",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getSubcategoriasAnidada($where=array())
    {
        $resultado = $this->ci->dbTienda->getSubcategoriasAnidada($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"Subcategorias consultadas",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay Subcategorias creadas",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getProductos($where=array())
    {
        $resultado = $this->empaquetaPresentaciones($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"productos consultados",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay productos creados",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function empaquetaPresentaciones($where)
    {
        $productos = $this->ci->dbTienda->getProductos($where);
        $dataSalida = array();
        $primerVariacion =  0;
        foreach($productos as $prod)
        {
            $variaciones = $this->ci->dbTienda->getVariaciones(array("idPresentacion"=>$prod['idPresentacion'],"idTienda"=>$prod['idTienda'],"idEstado"=>1));
            if(count($variaciones) > 0)
            {   $varSal = array();
                $primerVariacion = $variaciones[0]['idVariacion'];
                foreach($variaciones as $var)
                {
                    $varSal[$var['idVariacion']]['idVariacion'] = $var['idVariacion'];
                    $varSal[$var['idVariacion']]['idTienda'] = $var['idTienda'];
                    $varSal[$var['idVariacion']]['nombreVariacion'] = $var['nombreVariacion'];
                    $varSal[$var['idVariacion']]['valorPresentacion'] = $var['valorPresentacion'];
                    $varSal[$var['idVariacion']]['valorAnterior'] = $var['valorAnterior'];
                    $varSal[$var['idVariacion']]['descuento'] = $var['descuento'];
                    $varSal[$var['idVariacion']]['fotoPresentacion'] = $var['fotoPresentacion'];
                    $varSal[$var['idVariacion']]['idEstado'] = $var['idEstado'];
                }
            }
            else
            {
                $varSal = array();
                $primerVariacion = 0;
            }
            //consulto las varicaiones de la presentacion
            $array = array("idPresentacion"=>$prod['idPresentacion'],
                           "idTienda"=>$prod['idTienda'],
                           "variacion"=>$prod['variacion'],
                           "idProducto"=>$prod['idProducto'],
                           "idSubcategoria"=>$prod['idSubcategoria'],
                            "nombrePresentacion"=>$prod['nombrePresentacion'],
                            "marca"=>$prod['marca'],
                            "codigoProducto"=>$prod['codigoProducto'],
                            "fotoPresentacion"=>$prod['fotoPresentacion'],
                            "foto2"=>$prod['foto2'],
                            "foto3"=>$prod['foto3'],
                            "foto4"=>$prod['foto4'],
                            "foto5"=>$prod['foto5'],
                            "descuento"=>$prod['descuento'],
                            "valorPresentacion"=>$prod['valorPresentacion'],
                            "valorAntes"=>$prod['valorAntes'],
                            "descripcionCorta"=>$prod['descripcionCorta'],
                            "descripcionPres"=>$prod['descripcionPres'],
                            "agotado"=>$prod['agotado'],
                            "nuevo"=>$prod['nuevo'],
                            "likes"=>$prod['likes'],
                            "idEstado"=>$prod['idEstado'],
                            "primerVariacion"=>$primerVariacion,
                            "variaciones"=>$varSal
                        );
            array_push($dataSalida,$array);
        }
        return $dataSalida;
    }

    
    public function procesaLike($post)
    {

        extract($post);
        //lo primero es verificar si el id de usuario ya dio Like
        $yaDioLike = $this->ci->dbTienda->verificaLike(array("idUsuario"=>$idUsuario,"idProducto"=>$idProducto,"eliminado"=>0,"idTienda"=>$idTienda));
        //consulto la info del producto
        $infoProducto = $this->ci->dbTienda->getProductos(array("idPresentacion"=>$idProducto));
        if(count($yaDioLike) == 0)//no le ha dado like a ese producto
        {
            $dataActualiza['likes'] = $infoProducto[0]['likes'] + 1;
            $procesoLike = $this->ci->dbTienda->procesaLike(array("idPresentacion"=>$idProducto),$dataActualiza);
            //luego de esto inserto el like del usuario en la tabla relacion de likes
            $dataInserta = array("idUsuario"=>$idUsuario,"idProducto"=>$idProducto,"idTienda"=>$idTienda);
            $insertoLikeRelacion = $this->ci->dbTienda->relLike($dataInserta);
            $salida = array("mensaje"=>"Te gusta este producto!",
                            "datos"=>array(),
                            "continuar"=>1);
        }
        else
        {
            $dataActualiza['likes'] = $infoProducto[0]['likes'] - 1;
            $procesoLike = $this->ci->dbTienda->procesaLike(array("idPresentacion"=>$idProducto),$dataActualiza);
            //luego de esto inserto el like del usuario en la tabla relacion de likes
            $whereElimina = array("idUsuario"=>$idUsuario,"idProducto"=>$idProducto,"idTienda"=>$idTienda);
            $insertoLikeRelacion = $this->ci->dbTienda->delRelLike($whereElimina,array("eliminado"=>1));
            $salida = array("mensaje"=>"Ya no te gusta este producto",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        
        return $salida;
    }
    public function agregaCarrito($post)
    {
        extract($post);
        //primero que todo verifico que el producto no este agregado al carrito
        $whereCarrito['idPresentacion'] = $idProducto;
        $whereCarrito['idProducto']     = $idCategoria;
        $whereCarrito['idPersona']      = $idEmpleado;
        $whereCarrito['idTienda']       = $idTienda;
        $whereCarrito['eliminado']      = 0;
        $verificaCarrito = $this->ci->dbTienda->verificaCarrito($whereCarrito);
        //verifico si el usuario ya ha agregado ese producto al carro
        if(count($verificaCarrito) == 0)
        {
            $dataInserta['idPresentacion'] = $idProducto;
            $dataInserta['idProducto']     = $idCategoria;
            $dataInserta['idPersona']      = $idEmpleado;
            //$dataInserta['proveedor']      = $proveedor;
            $dataInserta['idTienda']       = $idTienda;
            //$dataInserta['idVariacion']    = $variacion;
            $dataInserta['cantidad']       = $cantidad;
            //si no esta entonces lo ingreso
            $insertoEnCarro = $this->ci->dbTienda->insertaEnCarro($dataInserta);
            if($insertoEnCarro > 0)
            {
                $salida = array("mensaje"=>"Producto agregado con éxito.",
                            "continuar"=>1,
                            "datos"=>$insertoEnCarro);
            }
            else
            {
                $salida = array("mensaje"=>"El producto no ha sido agregado.",
                            "continuar"=>0,
                            "datos"=>array());
            }
        }
        else
        {
            //acá actualizo la información del carrito para que vuelva a agregar el producto sin problema
            $whereProducto['idPresentacion'] = $idProducto;
            $whereProducto['idProducto']     = $idCategoria;
            $whereProducto['idPersona']      = $idEmpleado;
            $whereProducto['idTienda']       = $idTienda;

            $dataInserta['cantidad']         = $verificaCarrito[0]['cantidad'] + $cantidad;
            //si no esta entonces lo ingreso
            $insertoEnCarro = $this->ci->dbTienda->actualizaPedido($whereProducto,$dataInserta);


            $salida = array("mensaje"=>"Este producto ya lo agregaste al carrito.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
    public function quitarDelCarrito($post)
    {
        extract($post);
        //primero que todo verifico que el producto no este agregado al carrito
        $whereCarrito['idPedidoTemp']   = $idRelacion;
        $whereCarrito['idPersona']      = $idUsuario;
        $whereCarrito['idTienda']       = $idTienda;
        $dataActualiza['eliminado']     = 1;
        $quitaCarroProceso = $this->ci->dbTienda->actualizaPedido($whereCarrito,$dataActualiza);
        //verifico si el usuario ya ha agregado ese producto al carro
        if($quitaCarroProceso > 0)
        {
            $salida = array("mensaje"=>"Eliminaste el producto del carrito.",
                        "continuar"=>1,
                        "datos"=>$quitaCarroProceso);

        }
        else
        {
            $salida = array("mensaje"=>"No se pudo eliminar el carrito.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    } 
    public function modificarCantidad($post)
    {
        extract($post);
        //primero que todo verifico que el producto no este agregado al carrito
        $whereCarrito['idPedidoTemp']   = $idRelacion;
        $whereCarrito['idPersona']      = $idUsuario;
        $whereCarrito['proveedor']      = $proveedor;
        $whereCarrito['idTienda']       = $idTienda;
        $dataActualiza['cantidad']      = $cantidad;
        $quitaCarroProceso = $this->ci->dbTienda->actualizaPedido($whereCarrito,$dataActualiza);
        //verifico si el usuario ya ha agregado ese producto al carro
        if($quitaCarroProceso > 0)
        {
            $salida = array("mensaje"=>"Se ajustó la cantidad.",
                        "continuar"=>1,
                        "datos"=>$quitaCarroProceso);

        }
        else
        {
            $salida = array("mensaje"=>"No se pudo eliminar el carrito.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
    public function leerCarrito($post)
    {
        extract($post);
        $whereCarrito['p.idPersona']      = $idUsuario;
        //$whereCarrito['p.proveedor']      = $proveedor;
        $whereCarrito['p.idTienda']       = $idTienda;
        $whereCarrito['p.eliminado']      = 0;
        $productosCarrito = $this->ci->dbTienda->leerCarrito($whereCarrito);
        //verifico si el usuario ya ha agregado ese producto al carro
        if(count($productosCarrito) > 0)
        {
            $salida = array("mensaje"=>"Listado de productos carrito.",
                        "continuar"=>1,
                        "datos"=>$productosCarrito);

        }
        else
        {
            $salida = array("mensaje"=>"No hay productos cargados en el carrito.",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
    public function procesaSubCategoria($post)
    {
        extract($post);
        if($edita == 0)//agrega
        {
            unset($post['edita']);
            $post['nombreSubcategoria'] = mb_strtoupper($post['nombreSubcategoria']);
            $resultado = $this->ci->dbTienda->agregaSubCategoria($post);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Subcategoría creada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido crear la categoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        else//actualiza
        {
            $where['idSubcategoria']             = $idSubcategoria;
            $dataActualiza['nombreSubcategoria'] = mb_strtoupper($nombreSubcategoria);
            $dataActualiza['idProducto']         = $idProducto;
            $resultado = $this->ci->dbTienda->actualizaSubCategoria($where,$dataActualiza);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Subcategoría actualizada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido actualizar la subcategoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        return $salida;
    }


    public function eliminaSubCategoria($post)
    {
        $dataActualiza['idEstado'] = 0;
        $resultado = $this->ci->dbTienda->actualizaSubCategoria($post,$dataActualiza);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"La subcategoría se ha eliminado exitosamente",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha podido eliminar la subcategoría, intente de nuevo más tarde",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    //procesos para los productos
    public function getProductosAnidados($where=array())
    {
        $resultado = $this->ci->dbTienda->getProductosAnidados($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"productos consultados",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay productos creados",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }

    public function procesaProductos($post)
    {
        extract($post);
        //var_dump($post);die();
        if($edita == 0)//agrega
        {
            unset($post['edita']);
            $post['nombrePresentacion'] = mb_strtoupper($post['nombrePresentacion']);
            $resultado = $this->ci->dbTienda->agregaProducto($post);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"El producto se ha agregado de manera correcta",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"El producto no se ha podido crear, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        else//actualiza
        {
            unset($post['edita']);
            unset($post['idPresentacion']);
            unset($post['fotoActual']);
            $where['idPresentacion']        = $idPresentacion;
            $post['nombrePresentacion']     = mb_strtoupper($nombrePresentacion);
            $resultado = $this->ci->dbTienda->actualizaProducto($where,$post);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Producto actualizado de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido actualizar el producto, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        return $salida;
    }


    public function infoProducto($where=array())
    {
        $resultado = $this->ci->dbTienda->infoProductoTotal($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"producto consultado",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay producto creadas",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function getVariaciones($where=array())
    {
        $resultado = $this->ci->dbTienda->getVariaciones($where);
        if(count($resultado) > 0)
        {
            $salida = array("mensaje"=>"variaciones consultadas",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay variaciones creadas",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }


    //procesa las variaciones
    public function procesaVariaciones($post)
    {
        extract($post);
        if($nueva == 1)//agrega
        {
            $dataInsertar['nombreVariacion']          = mb_strtoupper($post['nombreVar']);
            $dataInsertar['valorPresentacion']  = $post['valor'];
            $dataInsertar['valorAnterior']      = $post['valorAntes'];
            $dataInsertar['descuento']          = $post['descuento'];
            $dataInsertar['idPresentacion']     = $post['idPresentacion'];
            $dataInsertar['idTienda']           = $post['idTienda'];
            $resultado = $this->ci->dbTienda->agregaVariacion($dataInsertar);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Categoría creada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido crear la categoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>0);
            }
        }
        else//actualiza
        {
            $where['idVariacion']            = $idVariacion;

            $dataActualiza['nombreVariacion']          = mb_strtoupper($post['nombreVar']);
            $dataActualiza['valorPresentacion']  = $post['valor'];
            $dataActualiza['valorAnterior']      = $post['valorAntes'];
            $dataActualiza['descuento']          = $post['descuento'];
            $dataActualiza['idPresentacion']     = $post['idPresentacion'];
            $dataActualiza['idTienda']           = $post['idTienda'];

            $resultado = $this->ci->dbTienda->actualizaVariacion($where,$dataActualiza);
            if(count($resultado) > 0)
            {
                $salida = array("mensaje"=>"Categoría actualizada de manera exitosa",
                                "datos"=>$resultado,
                                "continuar"=>1);
            }
            else
            {
                $salida = array("mensaje"=>"No se ha podido actualizar la categoría, intente de nuevo más tarde",
                                "datos"=>array(),
                                "continuar"=>1);
            }
        }
        return $salida;
    }

    public function eliminaProducto($post)
    {
        extract($post);
        $dataActualiza['idEstado']      = 0;
        $where['idPresentacion']        = $idPresentacion;
        $where['idTienda']              = $idTienda;
        $resultado = $this->ci->dbTienda->actualizaProducto($where,$dataActualiza);
        if(count($resultado) > 0)
        {

            $dataActualizaV['idEstado']      = 0;
            $whereV['idPresentacion']        = $idPresentacion;
            $whereV['idTienda']              = $idTienda;
            $resultadoV = $this->ci->dbTienda->actualizaVariacion($whereV,$dataActualizaV);
            //actualio todas las variaciones que tenga el producto
            $salida = array("mensaje"=>"El producto se la eliminado de manera corecta",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha podido eliminar el producto, intente de nuevo más tarde",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }
    public function eliminaVariacion($post)
    {
        extract($post);
        $dataActualiza['idEstado']      = 0;
        $where['idVariacion']           = $idVariacion;
        $where['idTienda']              = $idTienda;
        $resultado = $this->ci->dbTienda->actualizaVariacion($where,$dataActualiza);
        if(count($resultado) > 0)
        {
            //actualio todas las variaciones que tenga el producto
            $salida = array("mensaje"=>"La variacion se ha eliminado de manera corecta",
                            "datos"=>$resultado,
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No se ha podido eliminar la variacion, intente de nuevo más tarde",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        return $salida;
    }

    public function consultaCupoEmpleado($post)
    {
        extract($post);
        $consultaCupo = $this->ci->dbTienda->infoEmpleado(array("e.idEmpleado"=>$idEmpleado));
        if(count($consultaCupo) > 0)
        {
            //actualio todas las variaciones que tenga el producto
            $salida = array("mensaje"=>"dataEmpleado",
                            "datos"=>$consultaCupo[0],
                            "continuar"=>1);
        }
        else
        {
            $salida = array("mensaje"=>"No hay empleados con esta info",
                            "datos"=>array(),
                            "continuar"=>0);
        }
        
        return $salida;
    }

    public function realizarPedido($post)
    {
        extract($post);
        //lo primero que debo hacer es traer la información del pedido temporal del usuario
        $whereCarrito['p.idPersona']      = $idUsuario;
        //$whereCarrito['p.proveedor']      = $proveedor;
        $whereCarrito['p.idTienda']       = $idTienda;
        $whereCarrito['p.eliminado']      = 0;
        //consulto la data del carrito
        $productosCarrito   = $this->ci->dbTienda->leerCarrito($whereCarrito);
        if(count($productosCarrito) > 0)
        {
            //el siguiente paso es crear un pedido en la tabla pedidos
            $dataInsertarPedido['idPersona']    = $idUsuario;
            $dataInsertarPedido['fechaPedido']  = date("Y-m-d H:i:s");
            $dataInsertarPedido['mesPedido']    = date("m");
            $dataInsertarPedido['anoPedido']    = date("Y");
            $dataInsertarPedido['valor']        = $totalPedido;
            $insertoPedido       =  $this->ci->dbTienda->creaPedido($dataInsertarPedido);
            //valido si el pedido se inserta
            if($insertoPedido > 0)
            {
                $sumoTotal = 0;
                $insertados = 0;
                $textoProductos = "";
                //ahora procedo a insertar los productos que solicitó el usuario al detalle del pedido
                foreach($productosCarrito as $productos)
                {
                    //el siguiente paso es crear un pedido en la tabla pedidos
                    $dataInsertarDetPedido['idPedido']          = $insertoPedido;
                    $dataInsertarDetPedido['idProducto']        = $productos['idProducto'];
                    $dataInsertarDetPedido['idPresentacion']    = $productos['idPresentacion'];
                    $dataInsertarDetPedido['cantidad']          = $productos['cantidad'];
                    $dataInsertarDetPedido['idPersona']         = $idUsuario;
                    $dataInsertarDetPedido['fechaSolicitud']    = date("Y-m-d");
                    $dataInsertarDetPedido['horaSolicitud']     = date("H:i:s");
                    $insertoDetPedido       =  $this->ci->dbTienda->creaDetPedido($dataInsertarDetPedido);

                    if($insertoDetPedido > 0)
                    {
                        $insertados ++;
                    }
                    $sumoTotal += ($productos['cantidad'] * $productos['valorPresentacion']);
                    $textoProductos .= " - ".$productos['nombrePresentacion'].". Cantidad: ".$productos['cantidad']."<br>";
                }
                //valido si ya se insertaron todos los productos al detalle
                if($insertados == count($productosCarrito))
                {
                    $cupoActualEmpleado = $this->consultaCupoEmpleado(array("idEmpleado"=>$idUsuario));
                    //debo descontarle el cupo disponible al usuario
                    $nuevoCupo = ($cupoActualEmpleado['datos']['cupoDisp'] -  $sumoTotal);
                    //actualizo el empleado para descontarle el cupo disponible
                    $dataActualizaUsuario['cupoDisp'] = $nuevoCupo;
                    $whereActualizaUsuario['idEmpleado'] = $idUsuario;
                    $actualizoCupoEmpleado  =  $this->ci->dbTienda->actualizaEmpleado($whereActualizaUsuario,$dataActualizaUsuario);
                    if($actualizoCupoEmpleado > 0)
                    {
                        //el último paso es borrar el pedido temporal para este usuario, para que no me lo vuelva a mostrar en la app móvil
                        $eliminoPedidoTemporal = $this->ci->dbTienda->borraPedidoTemporal(array("idPersona"=>$idUsuario));

                        //notifico al administrador acerca de esta petición
                        //debo enviar un mail al administrador del sistema avisando de que alguien realizo un adelanto de salario
                        $para        =   _ADMIN_SOLICITUDES;
                        $asunto      =   "Solicitud de adelanto de nómina".lang("titulo");
                        $mensaje     =   "Se ha registrado una nueva solicitud de adelanto de nómina, a continuación verá la información de la solicitud.<br><br>";
                        $mensaje    .=   "<strong>Solicitante: </strong> ".$cupoActualEmpleado['datos']['nombres']." ".$cupoActualEmpleado['datos']['apellidos']."<br>";
                        $mensaje    .=   "<strong>Empresa: </strong> ".$cupoActualEmpleado['datos']['nombre']."<br>";
                        
                        $mensaje    .=   "<strong>Productos solicitados: </strong><br>";
                        $mensaje    .=   $textoProductos."<br><br>";
                        $mensaje    .=   "<strong>Total del pedido: </strong> $".number_format($sumoTotal,0,',','.')."<br><br>";

                        $mensaje    .=   "<strong>Fecha y hora: </strong> ".$dataInsertarDetPedido['fechaSolicitud']."<br><br>";
                        $mensaje    .=   "Para ver más información de la solicitud haga clic en el siguiente botón<br><br>";
                        $mensaje    .=   "<a style='background:#ed1b24;color:#fff;text-align:center;text-decoration:none;font-weight:bold' href='".base_url()."/Pedidos/infoPedido/41/".$insertoPedido."'>VER PEDIDO</a>";
                        //plantilla del mail
                        $plantilla   = plantillaMail($asunto,$mensaje);
                        //envio el codigo de ingreso al mail del usuario
                        $envioMail   = sendMail($para,$asunto,$plantilla);



                        $salida = array("mensaje"=>"El pedido se ha realizado de manera exitosa. El número del pedido es el: <strong>".$insertoPedido."</strong>",
                                        "continuar"=>1,
                                        "datos"=>array());
                    }
                    else
                    {
                        
                        $salida = array("mensaje"=>"No se ha podido actualizar el cupo del usuario",
                                        "continuar"=>0,
                                        "datos"=>array());
                    }
                }
            }
            else
            {
                $salida = array("mensaje"=>"El pedido no ha podido ser insertado",
                                "continuar"=>0,
                                "datos"=>array());
            }
        }
        else
        {
            $salida = array("mensaje"=>"No hay poductos para insertar",
                            "continuar"=>0,
                            "datos"=>array());
        }
        
        return $salida;
    }

    
    public function getPedidosUsuarios($post)
    {
        extract($post);
        $pedidos = $this->ci->dbTienda->misPedidos(array("p.idPersona"=>$idEmpleado));
        if(count($pedidos) > 0)
        {
            $salida = array("mensaje"=>"Listado de pedidos",
                            "continuar"=>1,
                            "datos"=>$pedidos);
        }
        else
        {
            $salida = array("mensaje"=>"No hay pedidos para el usuario",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }



 }