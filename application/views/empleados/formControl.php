
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
                <div class="x_title">Los campos marcados con un (*) son obligatorios</div>
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
                    

                <form id="formulario" ng-submit="procesaData(<?php echo $edita ?>)" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombres <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo (isset($datos['nombres']))?$datos['nombres']:''; ?>"  >
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Apellidos <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo (isset($datos['apellidos']))?$datos['apellidos']:''; ?>"  >
                      </div>
                    </div>

                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de identificación <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <select   id="tipoDocumento" name="tipoDocumento" class="form-control">
                            <option value="">Tipo de documento</option>
                          <?php foreach($selects['tiposDoc'] as $listaTD){ ?>
                              <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tipoDocumentoEmpleado']) && $listaTD['idTipoDoc'] == $datos['tipoDocumentoEmpleado'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nro documento <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nroDocumento" name="nroDocumento" class="form-control" value="<?php echo (isset($datos['documentoEmpleado']))?$datos['documentoEmpleado']:''; ?>"  >
                      </div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Direcci&oacute;n <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo (isset($datos['direccionEmpleado']))?$datos['direccionEmpleado']:''; ?>"  >
                      </div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Celular de contacto <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo (isset($datos['celularEmpleado']))?$datos['celularEmpleado']:''; ?>"  >
                      </div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Correo electrónico <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo (isset($datos['emailEmpleado']))?$datos['emailEmpleado']:''; ?>"  >
                      </div>
                    </div>

                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">G&eacute;nero <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
                        <select tabindex="1"  id="genero" name="genero" class="form-control">
                            <option value="">Seleccione el g&eacute;nero</option>
                            <option value="1" <?php echo (isset($datos['genero']) && 1 == $datos['genero'])?'selected':''; ?>>Masculino</option>
                            <option value="2" <?php echo (isset($datos['genero']) && 2 == $datos['genero'])?'selected':''; ?>>Femenino</option>
                        </select>
											</div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Empresa <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <select   id="idEmpresa" name="idEmpresa" class="form-control">
                          <?php if(count($selects['empresas']) > 1){?><option value="">Seleccione la empresa</option><?php }?>
                          <?php foreach($selects['empresas'] as $listaTD){ ?>
                              <option value="<?php echo $listaTD['idEmpresa'] ?>" <?php echo (isset($datos['idEmpresa']) && $listaTD['idEmpresa'] == $datos['idEmpresa'])?'selected':''; ?>><?php echo $listaTD['nombre'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>        


                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Cargo <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="cargo" name="cargo" class="form-control" value="<?php echo (isset($datos['cargo']))?$datos['cargo']:''; ?>"  >
                      </div>
                    </div>
  
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Salario devengado <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="salario" name="salario" class="form-control" value="<?php echo (isset($datos['salario']))?$datos['salario']:''; ?>"  >
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
                            <input id="idEmpleado" name="idEmpleado" value="<?php echo $datos['idEmpleado'] ?>" type="hidden">
                            
                          </div>
                        </div>
                    <?php } ?>
                    <input id="edita" name="edita" value="<?php echo $edita ?>" type="hidden">
                    

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">

                        <a href="<?php echo base_url()?>Empleados/listaEmpleados/<?php echo $infoModulo['idModulo']?>"  data-dismiss="modal" class="btn  btn-default"><i class="fa fa-arrow-left"></i> <?php echo lang('reg_btn_regresar') ?></a>
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