<!-- Inicio Div que engloba todo-->
<div ng-controller="usuariosApp" ng-init="initUsuarios()" id="contenedorUsuarios">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left">
        <h1>
            <?php echo $infoModulo['nombreModulo'] ?> <!--<small>Estructura de las áreas de su empresa</small>-->
                
            <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                        <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" ng-click="cargaPlantillaControl('',0,<?php echo $infoModulo['idModulo'] ?>)"><i class="fa fa-fw fa-plus"></i>  NUEVO USUARIO</a></li>
                    </ul>
                </div>
            <?php } ?>
        </h1>
        
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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
                <div class="x_title">
                </div>
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
                    <p>Listado de todos los usuarios registrados en el sistema</p>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr>
                                    <th class="text-left">EMPRESA</th>
                                    <th>NOMBRE</th>
                                    <th>PERFIL</th>
                                    <th class="text-center">ACCESO</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="ulist in usuarios  | filter:q as results"  ng-if="ulist.idPersona > 1">
                                    <td class="text-center">{{ulist.nombreEmpresa}}</td>
                                    <td>{{ulist.nombre}} {{ulist.apellido}}</td>
                                    <td>{{ulist.nombrePerfil}}</td>
                                    <td class="text-center">
                                    <i class="fa fa-lock" ng-if="ulist.clave != null" title="Este usuario posee datos de acceso a la plataforma. Usuario y clave"></i>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success" ng-if="ulist.estadoU==1" value="1" >ACTIVO</span>
                                        <span class="badge badge-secondary" ng-if="ulist.estadoU==0" value="0" >INACTIVO</span>
                                    </td>
                                    <td  class="text-center">
                                        <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                            <a ng-click="cargaPlantillaControl(ulist.idPersona,1,<?php echo $infoModulo['idModulo'] ?>)" title="Editar usuario" class="btn btn-primary btn-fab btn-fab-mini text-white"><i class="fa fa-edit"></i></a>
                                            <a ng-click="generaDatosAcceso(ulist.idPersona)" title="Generar datos de acceso" class="btn btn-primary btn-fab btn-fab-mini text-white"><i class="fa fa-lock"></i></a>
                                        <?php }?>
                                        <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                            <a ng-click="borraUsuario(ulist.idPersona)" ng-if="ulist.idPersona != 1" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs text-white"><i class="fa fa-trash"></i></a>
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