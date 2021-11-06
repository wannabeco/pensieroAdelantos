<!-- Inicio Div que engloba todo-->
<div class="container-fluid" ng-controller="pedidos" ng-init="pedidosInit()" id="contenedorUsuarios">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left">
        <h1>
            Detalle del pedido: <strong><?php echo $infoPedido['idPedido'] ?></strong> 
        </h1>
        <!-- <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() ?>Pedidos/misPedidos/<?php echo $infoModulo['idModulo'] ?>"><?php echo $infoModulo['nombreModulo'] ?></a>
                </li>
                <li>
                    Detalle del pedido: <strong><?php echo $infoPedido['idPedido'] ?></strong>
                </li>
            </ol> -->
        </div>

        

    </div>
    <div class="clearfix"></div>
    <!-- Nueva zona del contenido-->
    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <!-- <div class="x_title"></div> -->
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
<!--                      
                    <div class="table-responsive">
                        <div class="alert alert-info" ng-if="solicitudes.length == 0" style="margin:2% 0">No hay solicitudes con el filtro seleccionado.</div>
                        


                    </div> -->

                    <!-- info del pedido-->
                    <div class="row">
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Empleado</strong><br> 
                            <!--  <?php if($infoPedido['icono'] != ""){ ?>
                                <img class="img img-circle" src="<?php echo base_url() ?>res/fotos/personas/<?php echo $infoPedido['idPersona'] ?>/<?php echo $infoPedido['icono'] ?>" alt="Foto usuario" width="30%">
                                <?php }else{ ?>
                                <img class="img img-circle" src="<?php echo base_url() ?>res/img/user.jpg" alt="Foto usuario" width="30%" >
                                <?php } ?> -->
                            <?php echo $infoPedido['nombres']." ".$infoPedido['apellidos'] ?>
                        </div>
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Empresa</strong><br> <?php echo $infoPedido['nombre'] ?>
                        </div>
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Fecha del pedido</strong><br> <?php echo traduceFecha($infoPedido['fechaPedido']) ?> a las <?php echo explode(" ",$infoPedido['fechaPedido'])[1] ?>
                        </div>
                        <?php if($infoPedido['estadoPedido'] == 4){ ?>
                            <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                                <strong>Fecha de pago y despacho</strong><br> 
                                <?php if(($infoPedido['estadoPedido'] == 4 && $infoPedido['estadoPago'] == _ID_ESTADO_PAGO)){ ?>
                                    <?php echo traduceFecha($infoPedido['fechaEntrega']) ?> a las <?php echo explode(" ",$infoPedido['fechaEntrega'])[1] ?>
                                <?php }else{ ?>
                                    El pedido no ha sido despachado a&uacute;n
                                <?php } ?>
                            </div>
                        <?php } ?>


                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Código de pedido</strong><br> <?php echo $infoPedido['codigoPedido'] ?>  
                        </div>
                        <!-- <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                            <strong>Forma de pago</strong><br> 
                            <?php if( $infoPedido['formaPago'] == 1){?>
                                Contra entrega Efectivo
                            <?php }if( $infoPedido['formaPago'] == 3){?>
                                Contraentrega datafono
                            <?php }?>
                        </div> -->
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Estado Pedido</strong><br> 
                            <label class="label <?php echo $infoPedido['label'] ?>"><?php echo $infoPedido['nombreEstadoPedido'] ?>  </label>
                        </div>
                        <!-- <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                            <strong>Estado del pago</strong><br> 
                            <span class="label <?php echo estadoPago($infoPedido['estadoPago'])['label'] ?>"><?php echo estadoPago($infoPedido['estadoPago'])['texto'] ?></span>
                        </div> -->
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Direccion empleado</strong><br>
                            <?php echo $infoPedido['direccionPedido'] ?>
                        </div>
                        <div class="col col-lg-3 text-left" style="margin:0 0 2% 0">
                            <strong>Teléfono empleado</strong><br>
                            <?php echo $infoPedido['telefonoPedido'] ?>
                        </div>
                        <!--<?php if( $infoPedido['formaPago'] != 1){?>
                            <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                                <strong>Id transacción PAYU</strong><br>
                                <?php echo $infoPedido['transactionId'] ?>
                            </div>
                            <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                                <strong>Moneda</strong><br>
                                <?php echo $infoPedido['moneda'] ?>
                            </div>
                            <div class="col col-lg-4 text-left" style="margin:0 0 2% 0">
                                <strong>Entidad</strong><br>
                                <?php echo $infoPedido['entidad'] ?>
                            </div>
                        <?php } ?>-->
                    </div>
                            
                    <!-- fin info del pedido-->


                    <!-- Detalle del pedido -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>CATEGORIA</th>
                                                <th>PEDIDO</th>
                                                <th class="text-center">CANTIDAD</th>
                                                <th class="text-center">VALOR KILO</th>
                                                <th class="text-center">SUBTOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php  $totalPedido=0;foreach($productosPedido as $pedidos){ 
                                                    $valorKilosComprados = ($pedidos['valorPresentacion'] * $pedidos['cantidad']);
                                                    $totalPedido         +=$valorKilosComprados;
                                                ?>
                                                <tr>
                                                    <td style="vertical-align: middle"><?php echo $pedidos['nombreProducto'] ?></td>
                                                    <td style="vertical-align: middle"><?php echo $pedidos['nombrePresentacion'] ?></td>
                                                    <td style="vertical-align: middle" align="center">
                                                        <?php echo $pedidos['cantidad'] ?>
                                                    </td>
                                                    <td style="vertical-align: middle" align="center">
                                                        $<?php echo number_format($pedidos['valorPresentacion'],0,",","."); ?>
                                                    </td>
                                                    <td  class="text-center">
                                                        $<?php echo number_format($valorKilosComprados,0,",",".");?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <!-- <tr>
                                                <td colspan="4" class="text-right">
                                                    <h4>VALOR DOMICILIO</h4>
                                                </td>
                                                <td class="text-center">
                                                    <h4>$<?php echo number_format($infoPedido['valorDomicilio'],0,",","."); ?></h4>
                                                </td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td colspan="4" class="text-right">
                                                    <h4>VALOR PEDIDO</h4>
                                                </td>
                                                <td class="text-center">
                                                    <h4>$<?php echo number_format($infoPedido['valor'],0,",","."); ?></h4>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="4" class="text-right">
                                                    <h4>TOTAL</h4>
                                                </td>
                                                <td class="text-center">
                                                    <h4>$<?php echo number_format($infoPedido['valor'] + $infoPedido['valorDomicilio'],0,",","."); ?></h4>
                                                </td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                                    <?php  if($_SESSION['project']['info']['idPerfil'] == 1 or $_SESSION['project']['info']['idPerfil'] == 2){?>
                                        
                                            
                                                <div class="row">
                                                    <div class="col col-lg-12">
                                                        <h2>Gestionar el pedido</h2>
                                                    </div>
                                                    <!-- <div class="col col-lg-3">
                                                        <select name="estadoPago" class="form-control" id="estadoPago" style="padding: 5px 8px">
                                                            <option value="">Estado del pago</option>
                                                            <option value="000" <?php if($infoPedido['estadoPago'] == '000'){ ?> selected <?php }?> >Esperando pago</option>
                                                            <option value="998" <?php if($infoPedido['estadoPago'] == '998'){ ?> selected <?php }?> >Pago realizado</option>
                                                        </select>
                                                    </div> -->
                                                    <div class="col col-lg-3">
                                                        <select name="estadoPedido" class="form-control" id="estadoPedido" style="padding: 5px 8px">
                                                            <option value="">Estado del pedido</option>
                                                            <?php foreach($estados  as $est){?>
                                                                <option value="<?php echo $est['idEstadoPedido'] ?>" <?php if($infoPedido['estadoPedido'] == $est['idEstadoPedido']){ ?> selected <?php }?>><?php echo $est['nombreEstadoPedido']?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div class="col col-lg-3" style="margin:0px 0 0 0">
                                                        <input type="hidden" id="idPedido" name="idPedido" value="<?php echo $infoPedido['idPedido'] ?>">
                                                        <input type="button" style="background: #03a9f4 !important;color: #fff !important" name="" ng-click="gestionaPedido()" value="GESTIONAR" class="btn btn-primary">
                                                    </div>
                                                    <!-- <div class="col col-lg-3"  style="margin:20px 0 0 0">
                                                        <a class="btn" target="_blank" style="background: #333 !important;color: #fff !important" href="<?php echo base_url()?>Pedidos/imprimeFacturaTicket/<?php echo $infoPedido['idPedido']?>" class="btn btn-info">VER FACTURA<a>
                                                    </div> -->
                                                </div>
                                                
                                            
                                        
                                    <?php } ?>

                                
                            </div>
                        </div>
                    <!-- Fin  Detalle del pedido -->




                </div>
                <!-- Fin de las tablas y cualquier contenido-->
            </div>
        </div>
    </div>
    <!-- Fin de la nueva zona del contenido-->
   





</div>
<!-- Fin Div que engloba todo-->