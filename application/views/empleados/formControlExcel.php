
<!-- Inicio Div que engloba todo-->
<div ng-controller="empleados" ng-init="initInterno()">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left" style="width:100% !important">
        <h1>
            <?php echo $titulo ?>
        </h1>
        
        </div>

        <!-- <div class="title_right">
            <div class="col-md-8 col-sm-8   form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." ng-model="q">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div> -->

    </div>
    <div class="clearfix"></div>
    <!-- Nueva zona del contenido-->
    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">Seleccione el archivo excel para cargar, este debe contener el siguente format: <a href="<?php echo base_url()?>res/formatoCarga.xlsx">Descargar formato de excel</a></div>
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
                    

                <form id="formExcel" ng-submit="procesaExcel()" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Empresa <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <select   id="idEmpresa" name="idEmpresa" class="form-control">
                            <?php if(count($empresas) > 1){?><option value="">Seleccione la empresa</option><?php }?>
                            <?php foreach($empresas as $listaTD){ ?>
                                <option value="<?php echo $listaTD['idEmpresa'] ?>" ><?php echo $listaTD['nombre'] ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Archivo en excel <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="file" id="excelFile" name="excelFile" class="form-control" >
                      </div>
                    </div>
                    

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">

                        <a href="<?php echo base_url()?>Empleados/listaEmpleados/<?php echo $infoModulo['idModulo']?>"  data-dismiss="modal" class="btn  btn-default"><i class="fa fa-arrow-left"></i> <?php echo lang('reg_btn_regresar') ?></a>
                        <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                          <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
                        <?php } ?>
                        

                      </div>
                    </div>

                  </form>

                </div>
                <!-- Fin de las tablas y cualquier contenido-->
            </div>
        </div>
    </div>
    <!-- Fin de la nueva zona del contenido-->
</div>
<!-- Fin Div que engloba todo-->