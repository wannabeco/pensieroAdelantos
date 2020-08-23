<div class="container-fluid" ng-controller="listas" ng-init="initListas()" id="contenedorUsuarios">

<div id="modalUsuarios" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="modalCrea">
            <!--Form de creación -->
        </div>
    </div>
</div>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $infoModulo['nombreModulo'] ?> <!--<small>Estructura de las áreas de su empresa</small>-->
            </h1>
            <p></p>
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

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none" href="<?php echo base_url()?>Parametrizacion/tiposDoumento/<?php echo $infoModulo['idModulo']?>">
                            <h1><i class="fa fa-list"></i></h1>Tipos de documento
                        </a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/sexo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Sexo</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/faq/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        FAQ</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/bancos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Bancos</a>
                    </div>
                <?php }?>

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/areasTrabajo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Áreas de trabajo</a>
                    </div>
                <?php }?> -->

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/tipoContrato/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipos de contrato</a>
                    </div>
                <?php }?> -->

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/cargos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Cargos</a>
                    </div>
                <?php }?> -->

               <!--  <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/bancos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Entidades bancarias</a>
                    </div>
                <?php }?> -->

               <!--  <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/tiposCuenta/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipo de cuenta</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/eps/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        EPS</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/afp/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        AFP</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/fondoCesantias/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Fondo cesantías</a>
                    </div>
                <?php }?>
                 -->
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/perfiles/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Perfiles</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/constantes/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Variables globales</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/kerrodal/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Acerca de Kerrodal</a>
                    </div>
                <?php }?>
                <!-- 
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/impuestos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Impuestos</a>
                    </div>
                <?php }?> -->
            </div>
        </div>
    </div>
    <!-- /.row -->
 </div>
<!-- /.container-fluid -->