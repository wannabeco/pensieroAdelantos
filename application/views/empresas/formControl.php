
<!-- Inicio Div que engloba todo-->
<div ng-controller="empresas" ng-init="procesaEmpresasInit()">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left" style="width:100% !important">
        <h1>
            <?php echo $titulo ?> <small><?php echo (count($datos) > 0)?$datos['nombre']:""?></small>    
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
                <div class="x_title">Los campos marcados con un (*) son obligatorios</div>
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
                    

                <form id="formAgregaEmpresa" ng-submit="procesaEmpresa(<?php echo $edita ?>)" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Razón social <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo (isset($datos['nombre']))?$datos['nombre']:''; ?>"  >
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de identificación <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <select tabindex="1"  id="tipoDocumento" name="tipoDocumento" class="form-control">
                            <option value="">Tipo de documento</option>
                          <?php foreach($selects['tiposDoc'] as $listaTD){ ?>
                              <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tipoDocumento']) && $listaTD['idTipoDoc'] == $datos['tipoDocumento'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">N&uacute;mero de identificación <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nroDocumento" name='nroDocumento' class="form-control " value="<?php echo (isset($datos['nroDocumento']))?$datos['nroDocumento']:''; ?>">
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Representante legal <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nombreEncargado" name="nombreEncargado" class="form-control" value="<?php echo (isset($datos['nombreEncargado']))?$datos['nombreEncargado']:''; ?>">
                      </div>
                    </div>

                    <div class="item form-group">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Dirección <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 ">
                        <input id="direccion" class="form-control" type="text" name="direccion" value="<?php echo (isset($datos['direccion']))?$datos['direccion']:''; ?>">
                      </div>
                    </div>

                    <div class="item form-group">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tel&eacute;fono <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 ">
                        <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo (isset($datos['telefono']))?$datos['telefono']:''; ?>">
                      </div>
                    </div>
                  

                    <div class="item form-group">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Celular <!--<span class="required">*</span>--></label>
                      <div class="col-md-6 col-sm-6 ">
                        <input id="celular" class="form-control" type="text" name="celular" value="<?php echo (isset($datos['celular']))?$datos['celular']:''; ?>">
                      </div>
                    </div>
                  

                    
                    <div class="item form-group">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Correo electr&oacute;nico <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 ">
                        <input id="email" class="form-control" type="text" name="email" value="<?php echo (isset($datos['email']))?$datos['email']:''; ?>">
                      </div>
                    </div>
                      <?php if($edita == 1){ ?>
                        <div class="item form-group">
                          <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Estado</label>
                          <div class="col-md-6 col-sm-6 ">
                            
                              <select tabindex="26" class=" form-control" id="estado" name="estado">
                                <option value="1" <?php if($datos['estado'] == 1){?>selected<?php }?>>Activo</option>
                                <option value="0" <?php if($datos['estado'] == 0){?>selected<?php }?>>Inactivo</option>
                              </select>
                              <input id="idEmpresa" name="idEmpresa" value="<?php echo $datos['idEmpresa'] ?>" type="hidden">
                              
                            </div>
                          </div>
                      <?php } ?>
                      <input id="edita" name="edita" value="<?php echo $edita ?>" type="hidden">
                    

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">

                        <a href="<?php echo base_url()?>Empresas/listaEmpresas/<?php echo $infoModulo['idModulo']?>"  data-dismiss="modal" class="btn  btn-default"><i class="fa fa-arrow-left"></i> <?php echo lang('reg_btn_regresar') ?></a>
                        <?php if(getPrivilegios()[0]['crear'] == 1 && $edita == 0){ ?>
                          <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
                        <?php } ?>
                        
                        <?php if(getPrivilegios()[0]['editar'] == 1 && $edita == 1){ ?>
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