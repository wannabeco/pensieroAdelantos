<!-- Inicio Div que engloba todo-->
<div class="container-fluid" ng-controller="pedidos" ng-init="misPedidosInit()" id="contenedorUsuarios">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left">
        <h1>
            <?php echo $infoModulo['nombreLargo'] ?> <!--<small>Estructura de las áreas de su empresa</small>-->
                
            <!-- <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                        <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" href="<?php echo base_url()?>Empleados/gestionEmpleados/<?php echo $infoModulo['idModulo'] ?>/crear/0"><i class="fa fa-fw fa-plus"></i>  NUEVO EMPLEADO</a></li>
                        <li><a class="btn" href="<?php echo base_url()?>Empleados/cargaViaExcel/<?php echo $infoModulo['idModulo'] ?>"><i class="fa fa-fw fa-file-excel-o"></i>  CARGA V&iacute;A EXCEL</a></li>
                    </ul>
                </div>
            <?php } ?> -->
        </h1>
        
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
                    <p>Listado de solicitudes de adelanto de n&oacute;mina</p>
                        <div class="row">
                            <!-- <div class="col col-lg-4">
                                <fieldset>
                                    <div class="control-group ">
                                        <div class="controls">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i class=" fa fa-calendar"></i></span>
                                            <input type="text" style="width: 200px" name="fechasFiltro" id="fechasFiltro" class="form-control" value="<?php echo date("Y-m-01")?> - <?php echo date("Y-m-").date("d",(mktime(0,0,0,date("m")+1,1,date("Y"))-1));?>" />
                                        </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div> -->
                            <div class="col col-lg-2">
                                <label for="">Año</label>
                                <select name="anoBusca" id="anoBusca" class="form-control">
                                    <?php for($m=2020;$m<=date("Y");$m++){?>
                                        <option value="<?php echo $m?>" <?php if($m == date("Y")){?> selected <?php }?>><?php echo $m?></option>
                                    <?php }?>
                                </select>
                            </div> 
                            <div class="col col-lg-2">
                                <label for="">Mes</label>
                                <select name="mesBusca" id="mesBusca" class="form-control">
                                    <?php for($a=1;$a<=12;$a++){?>
                                        <option value="<?php echo $a?>" <?php if($a == date("m")){?> selected <?php }?>><?php echo traducirMes($a)?></option>
                                    <?php }?>
                                </select>
                            </div> 
                            <div class="col col-lg-2">
                                <label for="">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="">TODAS</option>
                                    <option value="recibida">RECIBIDAS</option>
                                    <option value="aprobada">APROBADAS</option>
                                    <option value="rechazada">RECHAZADAS</option>
                                    <option value="pagada">PAGADAS</option>
                                    <option value="reembolsada">REEMBOLSADAS</option>
                                </select>
                            </div>    
                            <div class="col col-lg-2">
                                <button class="btn btn-danger" ng-click="getSolicitudes()" style="margin:26px 0 0 0">FILTRAR</button>
                            </div>          
                        </div>
<br><br>
                    <div class="table-responsive">
                        <div class="alert alert-info" ng-if="solicitudes.length == 0" style="margin:2% 0">No hay solicitudes con el filtro seleccionado.</div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>FECHA</th>
                                    <th>EMPLEADO</th>
                                    <th class="text-center">EMPRESA</th>
                                    <th class="text-center">VALOR PEDIDO</th>
                                    <th class="text-center">ESTADO PEDIDO</th>
                                    <!-- <th class="text-center">EMPRESA</th> -->
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaPedidos as $pedidos){ 
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle" class="text-center"><?php echo $pedidos['idPedido'] ?></td>
                                        <td style="vertical-align: middle"><?php echo $pedidos['fechaPedido'] ?> </td>
                                        <td style="vertical-align: middle"><?php echo $pedidos['nombres'] ?> <?php echo $pedidos['apellidos'] ?></td>
                                        
                                        <td style="vertical-align: middle" class="text-center">
                                            <?php echo $pedidos['nombre'] ?>
                                        </td>
                                        <!-- <td>{{ulist.nombreArea}}</td>
                                        <td>{{ulist.nombreCargo}}</td> -->
                                        <!-- <td style="vertical-align: middle"></td> -->
                                        <td style="vertical-align: middle" align="center">
                                            $<?php echo number_format($pedidos['valor'],0,',','.') ?>
                                        </td>
                                        <td style="vertical-align: middle" align="center" <?php if($pedidos['estadoPedido'] == 5){ ?> colspan="2"<?php }?>>
                                            <span class="label <?php echo $pedidos['label'] ?>"><?php echo $pedidos['nombreEstadoPedido'] ?></span>
                                        </td>
                                        <!-- <?php if($pedidos['estadoPedido'] != 5){ ?>
                                            <td style="vertical-align: middle" align="center">
                                                
                                                <span class="label <?php echo estadoPago($pedidos['estadoPago'])['label'] ?>"><?php echo estadoPago($pedidos['estadoPago'])['texto'] ?></span>
                                            </td>
                                        <?php } ?> -->
                                        <td  class="text-center">

                                            <!-- <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                                <a ng-click="cargaPlantillaControl(ulist.idPersona,1)" title="Editar usuario" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>
                                                <a ng-click="generaDatosAcceso(ulist.idPersona)" title="Generar datos de acceso" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">https</i></a>
                                            <?php }?> -->
                                            <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                                <a href="<?php echo base_url() ?>Pedidos/detalleMiPedido/<?php echo $infoModulo['idModulo'] ?>/<?php echo ($pedidos['idPedido']) ?>" title="Ver detalle del pedido"  class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php }?>
                                            <!-- <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                                <a ng-click="borraUsuario(ulist.idPersona)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="material-icons">delete</i></a>
                                            <?php } ?> -->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- Fin de las tablas y cualquier contenido-->
            </div>
        </div>
    </div>
    <!-- Fin de la nueva zona del contenido-->
</div>
<!-- Fin Div que engloba todo-->