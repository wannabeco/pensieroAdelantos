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
                                    <?php foreach($listadoDeEstados as $estadosPed){?>
                                        <option value="<?php echo $estadosPed['idEstadoPedido']?>"><?php echo strtoupper($estadosPed['nombreEstadoPedido'])?></option>
                                    <?php }?>

                                </select>
                            </div>    
                            <div class="col col-lg-2">
                                <button class="btn btn-danger" ng-click="getMisPedidos()" style="margin:26px 0 0 0">FILTRAR</button>
                            </div>          
                        </div>
<br><br>
                    <div class="table-responsive">
                        <div class="alert alert-info" ng-if="pedidosLista.length == 0" style="margin:2% 0">No hay pedidos con los filtro seleccionado.</div>
                        <table class="table table-hover table-striped" ng-if="pedidosLista.length > 0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>FECHA</th>
                                    <th>EMPLEADO</th>
                                    <th class="text-center">EMPRESA</th>
                                    <th class="text-center">VALOR DEL PEDIDO</th>
                                    <th class="text-center">ESTADO DEL PEDIDO</th>
                                    <!-- <th class="text-center">EMPRESA</th> -->
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr ng-repeat="ped in pedidosLista">
                                        <td style="vertical-align: middle" class="text-center">{{ped.idPedido}}</td>
                                        <td style="vertical-align: middle">{{ped.fechaPedido}}</td>
                                        <td style="vertical-align: middle">{{ped.nombres}} {{ped.apellidos}}</td>
                                        
                                        <td style="vertical-align: middle" class="text-center">
                                            {{ped.nombre}}
                                        </td>
                                        <td style="vertical-align: middle" align="center">
                                            ${{ped.valor|number}}
                                        </td>
                                        <!-- <td style="vertical-align: middle" align="center" <?php if($pedidos['estadoPedido'] == 5){ ?> colspan="2"<?php }?>> -->
                                        <td style="vertical-align: middle" align="center" >
                                            <span class="badge {{ped.label}}">{{ped.nombreEstadoPedido}}</span>
                                        </td>
                                        <td  class="text-center">
                                            <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                                <a href="<?php echo base_url() ?>Pedidos/detalleMiPedido/<?php echo $infoModulo['idModulo'] ?>/{{ped.idPedido}}" title="Ver detalle del pedido"  class="btn btn-primary btn-fab btn-fab-mini btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php }?>
                                        </td>
                                    </tr>
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