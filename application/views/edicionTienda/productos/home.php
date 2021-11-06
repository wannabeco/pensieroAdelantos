
<div class="container-fluid" ng-controller="gestionTienda" ng-init="initProductos()" id="contenedor">

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
                            <li><a class="btn" ng-click="cargaPlantillaControlProductos('',0)"><i class="fa fa-fw fa-plus"></i> Nuevo producto</a></li>
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
                <table class="table table-hover table-striped" ng-if="productosLista.length > 0">
                    <thead>
                        <tr>
                            <th>PRODUCTO</th>
                            <!-- <th class="text-center">VARIACIONES</th> -->
                            <th class="text-center">CATEGORIA</th>
                            <th class="text-center">SUBCATEGORIA</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="prod in productosLista | filter:q as results">
                            <td style="vertical-align: middle">
                                <strong>{{prod.nombrePresentacion}}</strong><br>
                                <!-- <small>Valor unitario: ${{prod.valorPresentacion|number}}</small> -->
                            </td>
                            <!-- <td style="vertical-align: middle" class="text-center">
                                <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                <a href="#" class="text-success" ng-if="prod.variacion == 1" ng-click="variacionesProducto(prod.idPresentacion)">Variaciones</a>
                                <?php }?>
                            </td> -->
                            <td style="vertical-align: middle" class="text-center">{{prod.nombreProducto}}</td>
                            <td style="vertical-align: middle" class="text-center">{{prod.nombreSubcategoria}}</td>
                            <td style="vertical-align: middle" align="center">
                                <span class="label label-success" ng-if="prod.idEstado==1" value="1" >ACTIVO</span>
                                <span class="label label-default" ng-if="prod.idEstado==0" value="0" >INACTIVO</span>
                            </td>
                            <td  class="text-center">
                                <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                    <a ng-click="cargaPlantillaControlProductos(prod.idPresentacion,1)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini text-white"><i class="fa fa-edit"></i></a>
                                <?php }?>
                                <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                    <a ng-click="eliminarProducto(prod.idPresentacion)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini btn-xs text-white"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" ng-if="productosLista.length == 0">
                  <strong>Vaya!</strong> aún no has creado ningún producto. <button class="btn" style="background:#fff;color:#333" ng-click="cargaPlantillaControlProductos('',0)">CREAR MI PRIMER PRODUCTO</button>
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