<!-- Inicio Div que engloba todo-->
<div ng-controller="empleados" ng-init="init()" id="contenedorEmpleados">

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
                
            <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
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
            <?php } ?>
        </h1>
        
        </div>

        <div class="title_right">
            <div class="col-md-8 col-sm-8   form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." ng-model="q">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
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
                    <p>Listado de todos los usuarios registrados en el sistema</p>
                    <div class="table-responsive">
                        <div class="alert alert-info" ng-if="empleados.length == 0">No hay empleados creados aun</div>
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable-responsive" ng-if="empleados.length > 0">
                            <thead>
                                <tr>
                                    <th class="text-left">EMPLEADO</th>
                                    <th>EMPRESA</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">APP</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ulist in empleados  | filter:q as results">
                                    <td class="text-left">{{ulist.nombres | uppercase}} {{ulist.apellidos | uppercase}}</td>
                                    <td>{{ulist.nombre | uppercase}}</td>
                                    <td class="text-center">
                                        <span class="badge badge-success" ng-if="ulist.estado==1" value="1" >ACTIVO</span>
                                        <span class="badge badge-secondary" ng-if="ulist.estado==0" value="0" >INACTIVO</span>
                                    </td>
                                    <td class="text-center" style="font-size:1.8em">
                                        <i class="fa fa-mobile" ng-if="ulist.FCMToken != ''" title="El usuario ya está usando la app móvil"></i>
                                    </td>
                                    <td  class="text-center">
                                        <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                            <a href="<?php echo base_url()?>Empleados/gestionEmpleados/<?php echo $infoModulo['idModulo'] ?>/editar/{{ulist.idEmpleado}}" title="Editar empresa" class="btn btn-primary btn-fab btn-fab-mini text-white"><i class="fa fa-edit"></i></a>
                                        <?php }?>
                                        <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                            <a ng-click="borrarData(ulist.idEmpleado)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs text-white"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
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