<div class="container-fluid" ng-controller="modulos" ng-init="adminInit()" id="contenedorModulos">

    <!-- Modal crear categoria -->
    <?php
        $this->load->view("admin/adminModulos/categorias/crear");
        $this->load->view("admin/adminModulos/categorias/editar");
    ?>

    <div id="modalNModulo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCreaModulo">
            </div>
        </div>
    </div>


    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $infoModulo['nombreModulo'] ?> <!--<small>Estructura de las áreas de su empresa</small>-->
            </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
                 <?php echo $infoModulo['nombreModulo'] ?>
            </li>
        </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i> Esta zona es muy importante para la aplicación aquí los súper administradores pueden asignar módulos a los perfiles.
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!--<div class="row">
        <div class="col-lg-12">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="exampleInputName2">Filtro por palabra: </label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                  </div>
                </form>
        </div>
    </div>-->
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h2>
                CATEGORÍAS 

                <?php if( $privilegios['crear'] == 1){ ?>
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                      <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" data-toggle="modal" data-target="#modalCategoria"><i class="fa fa-fw fa-plus"></i> NUEVA CATEGORÍA</a></li>
                    </ul>
                </div>
                <?php } ?>
            </h2>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <!--<th class="text-center">ID CATEGORÍA</th>-->
                            <th>NOMBRE CATEGORÍA</th>
                            <!--<th class="text-center">ÍCONO</th>-->
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="categorias in modulos">
                            <!--<td class="text-center">{{categorias.idPadre}}</td>-->
                            <td>{{categorias.nombreModulo}}</td>
                            <!--<td class="text-center">Icono</td>-->
                            <td class="text-center">
                                <span class="label label-success" ng-if="categorias.estado==1" value="1" >ACTIVO</span>
                                <span class="label label-default" ng-if="categorias.estado==0" value="0" >INACTIVO</span>
                            </td>
                            <td  class="text-center">
                                <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                <!--<a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>-->
                                <?php if( $privilegios['ver'] == 1 ){ ?>
                                    <a ng-click="consultaModulosCategoria(categorias.idPadre)" title="Ver los módulos de la categoría {{categorias.nombreModulo}}" class="btn btn-default btn-fab btn-fab-mini"><i class="fa fa-eye"></i></a>
                                <?php }?>
                                <?php if( $privilegios['editar'] == 1 ){ ?>
                                    <a ng-click="estadoCategoriaPrincipal(categorias.idPadre,categorias.estado)" ng-if="categorias.estado==1" title="Apagar categoría {{categorias.nombreModulo}}" class="btn btn-default btn-fab btn-fab-mini"><i class="fa fa-eye-slash"></i></a>
                                    <a ng-click="estadoCategoriaPrincipal(categorias.idPadre,categorias.estado)" ng-if="categorias.estado==0" title="Encender categoría {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fa fa-eye"></i></a>
                                    <a data-toggle="modal" data-target="#modalCategoriaEditar" ng-click="cargarDataCategoria(categorias)" title="Editar nombre de la categoría {{categorias.nombreModulo}}" class="btn btn-default btn-fab btn-fab-mini"><i class="fa fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row" id="panelModulo" style="display:none">
        <div class="col-lg-12">
            <h2>
                MÓDULOS DE LA CATEGORÍA  
                <?php if( $privilegios['crear'] == 1 ){ ?>
                    <div class="btn-group" >
                        <button type="button" class="btn dropdown-toggle"
                                data-toggle="dropdown">
                          <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                            <li><a class="btn" ng-click="cargaPlantillaCreacionModulos('',0,<?php echo $infoModulo['idModulo'] ?>)"><i class="fa fa-fw fa-plus"></i> NUEVO MÓDULO</a></li>
                        </ul>
                    </div>
                <?php }?>
            </h2>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <!--<th class="text-center">ID CATEGORÍA</th>-->
                            <th>NOMBRE MÓDULO</th>
                            <!--<th class="text-center">ÍCONO</th>-->
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="categorias in modulosInternos">
                            <!--<td class="text-center">{{categorias.idPadre}}</td>-->
                            <td>{{categorias.nombreModulo}}</td>
                            <!--<td class="text-center">Icono</td>-->
                            <td class="text-center">
                                <span class="label label-success" ng-if="categorias.estado==1" value="1" >ACTIVO</span>
                                <span class="label label-default" ng-if="categorias.estado==0" value="0" >INACTIVO</span>
                            </td>
                            <td  class="text-center">
                                <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                <!--<a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>-->
                                <?php if( $privilegios['ver'] == 1 ){ ?>
                                    <a ng-click="cargaPlantillaCreacionModulos(categorias.idPadre,1,<?php echo $infoModulo['idModulo'] ?>)" title="Ver configuración del módulo {{categorias.nombreModulo}}" class="btn btn-primary btn-fab btn-fab-mini"><i class="fa fa-edit text-white"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

    <div class="row" id="panelModulo" style="display:none">
       <div class="col-lg-12">
       </div>
    </div>   

 </div>
            <!-- /.container-fluid -->