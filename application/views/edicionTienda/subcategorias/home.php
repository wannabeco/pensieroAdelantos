<div class="container-fluid" ng-controller="gestionTienda" ng-init="initSubcategorias()" id="contenedorUsuarios">

<div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="modalCrea">
            <!--Form de creación -->
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
                            <li><a class="btn" ng-click="cargaPlantillaControlSubcat('',0)"><i class="fa fa-fw fa-plus"></i> Nueva subcategoría</a></li>
                        </ul>
                    </div>
                <?php } ?>
        </h1>
        <!-- <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>App"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
                 <?php echo $infoModulo['nombreModulo'] ?>
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
                   
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" ng-if="subCategorias.length > 0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID SUBCATEGORIA</th>
                                    <th>SUBCATEGORIA</th>
                                    <th>CATEGORIA</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="subCat in subCategorias | filter:q as results">
                                    <td class="text-center">{{subCat.idSubcategoria}}</td>
                                    <td>{{subCat.nombreSubcategoria}}</td>
                                    <td>{{subCat.nombreProducto}}</td>
                                    <td align="center">
                                        <span class="label label-success" ng-if="subCat.idEstado==1" value="1" >ACTIVO</span>
                                        <span class="label label-default" ng-if="subCat.idEstado==0" value="0" >INACTIVO</span>
                                    </td>
                                    <td  class="text-center">
                                        <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                            <a ng-click="cargaPlantillaControlSubcat(subCat.idSubcategoria,1)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>
                                        <?php }?>
                                        <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                            <a ng-click="eliminaSubCategoria(subCat.idSubcategoria)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs"><i class="material-icons">delete</i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info" ng-if="subCategorias.length == 0">
                        <strong>Vaya!</strong> aún no has creado ninguna subcategoría. <button class="btn" style="background:#fff;color:#333" ng-click="cargaPlantillaControlSubcat('',0)">CREAR MI PRIMERA SUBCATEGORÍA</button>
                        </div>
                        

                    </div>
                </div>
                <!-- Fin de las tablas y cualquier contenido-->
            </div>
        </div>
    </div>
    <!-- Fin de la nueva zona del contenido-->
</div>
<!-- Fin Div que engloba todo-->
