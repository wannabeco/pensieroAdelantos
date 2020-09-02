<!-- Inicio Div que engloba todo-->
<div ng-controller="cobrosController" ng-init="init()" id="contenedorSolicitudes">

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
                    <p>Consulte las empresas que deben reembolsarle dinero. Aquí se mostrarán solo el dinero de las solicitudes que hayan sido pagadas.</p>
                        <div class="row">
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
                                <button class="btn btn-danger" ng-click="getCobros()"  style="margin:26px 0 0 0">BUSCAR</button>
                            </div>          
                        </div>

                    <div class="table-responsive">
                        <div class="alert alert-info" ng-if="cobros.length == 0" style="margin:2% 0">No hay reembolsos con el filtro seleccionado.</div>
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable-responsive" ng-if="cobros.length > 0" style="margin:2% 0 0 0">
                            <thead>
                                <tr>
                                    <th class="text-left">EMPRESA</th>
                                    <th class="text-center">MONTO</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="cobro in cobros  | filter:q as results">
                                    <td class="text-left">{{cobro.empresa | uppercase}}</td>
                                    <td class="text-center">${{cobro.montoCobrar | number}}</td>
                                    <td  class="text-center">
                                        <?php if(getPrivilegios()[0]['ver'] == 1){ ?>
                                            <a href="<?php echo base_url()?>/Solicitudes/infoSolicitud/<?php echo $infoModulo['idModulo']?>/{{cobro.idEmpresa}}">Ver detalles</a>
                                        <?php }?>
                                        <!-- <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                            <a href="<?php echo base_url()?>Empleados/gestionEmpleados/<?php echo $infoModulo['idModulo'] ?>/editar/{{cobro.idEmpleado}}" title="Editar empresa" class="btn btn-primary btn-fab btn-fab-mini text-white"><i class="fa fa-edit"></i></a>
                                        <?php }?>
                                        <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                            <a ng-click="borrarData(cobro.idEmpleado)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs text-white"><i class="fa fa-trash"></i></a>
                                        <?php } ?> -->
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