<form role="form"  ng-controller="procesaGuardado" id="formAgregaPersona" ng-submit="procesaUsuario(<?php echo $edita ?>)">    
  <div class="modal-header">
    <h5 class="modal-title"><?php echo $titulo ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

    <div class="modal-body">    

        <div class="row">
          <div class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="tipoDocumento">Tipo de documento</label>
                <select tabindex="1"  id="tipoDocumento" name="tipoDocumento" class="form-control">
                    <option value=""></option>
                  <?php foreach($selects['tiposDoc'] as $listaTD){ ?>
                      <option value="<?php echo $listaTD['idTipoDoc'] ?>" <?php echo (isset($datos['tipoDocumentoU']) && $listaTD['idTipoDoc'] == $datos['tipoDocumentoU'])?'selected':''; ?>><?php echo $listaTD['nombreTipoDoc'] ?></option>
                  <?php } ?>
                </select>
              </div> 
          </div>
          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="nroDocumento">Documento de identidad</label>
                  <input tabindex="2" autocomplete="off" id="nroDocumento" name="nroDocumento"  class="form-control" value="<?php echo (isset($datos['nroDocumentoU']))?$datos['nroDocumentoU']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>
          </div> 
          <!-- 
          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="ciudadExpedicionCedula">Ciudad de expedición documento</label>
                <select tabindex="3"  id="ciudadExpedicionCedula" name="ciudadExpedicionCedula" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['ciudades'] as $listaProf){ 
                        $cidDoc = $listaProf['ID_DPTO']."-".$listaProf['ID_CIUDAD'];
                      ?>
                        <option value="<?php echo $cidDoc ?>" <?php echo (isset($datos['ciudadExpedicionCedula']) && $cidDoc == $datos['ciudadExpedicionCedula'])?'selected':''; ?>><?php echo $listaProf['NOMBRE'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>


          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="fechaNacimiento">Fecha de nacimiento</label>
                  <input tabindex="4" autocomplete="off" id="fechaNacimiento" name="fechaNacimiento"  class="form-control" value="<?php echo (isset($datos['fechaNacimiento']))?$datos['fechaNacimiento']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>
          </div>-->

       

        
            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="nombre">Nombres</label>
                  <input tabindex="5" autocomplete="off" id="nombre" name="nombre"  class="form-control" value="<?php echo (isset($datos['nombreUsuario']))?$datos['nombreUsuario']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>
           <div class="col col-lg-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="apellido">Apellidos</label>
                  <input tabindex="6" autocomplete="off" id="apellido" name="apellido"  class="form-control" value="<?php echo (isset($datos['apellido']))?$datos['apellido']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>

        
            <!-- <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="direccion"> Dirección de residencia</label>
                  <input tabindex="7" autocomplete="off" id="direccion" name="direccion"  class="form-control" value="<?php echo (isset($datos['direccion']))?$datos['direccion']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div>
            
            <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="barrio"> Barrio</label>
                  <input tabindex="8" autocomplete="off" id="barrio" name="barrio"  class="form-control" value="<?php echo (isset($datos['barrio']))?$datos['barrio']:''; ?>"  type="text">
                  <p class="help-block"></p>
                </div> 
            </div> -->
           <!-- <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="telefono">Teléfono de contacto</label>
                  <input tabindex="9" autocomplete="off" id="telefono" name="telefono"  class="form-control" value="<?php echo (isset($datos['telUsuario']))?$datos['telUsuario']:''; ?>"  type="text">
                  <p class="help-block">Sin caracteres especiales</p>
                </div> 
            </div> -->
           <div class="col col-lg-6">
                <div class="form-group  label-floating">
                  <label class="control-label" for="celular">Celular de contacto</label>
                  <input tabindex="10" autocomplete="off" id="celular" name="celular"  class="form-control" value="<?php echo (isset($datos['celUsuario']))?$datos['celUsuario']:''; ?>"  type="text">
                </div> 
            </div>
        

        
          <div class="col col-lg-6">
              <div class="form-group  label-floating">
                <label class="control-label" for="idSexo">Genero</label>
                <select tabindex="11"  id="idSexo" name="idSexo" class="form-control">
                    <option value=""></option>
                  <?php foreach($selects['sexo'] as $listaSexo){ ?>
                      <option value="<?php echo $listaSexo['idSexo'] ?>" <?php echo (isset($datos['idSexo']) && $listaSexo['idSexo'] == $datos['idSexo'])?'selected':''; ?>><?php echo $listaSexo['nombreSexo'] ?></option>
                  <?php } ?>
                </select>
              </div> 
          </div>

          <!-- <div  class="col col-lg-6">
            <div class="form-group label-floating">
                <label class="control-label" for="idArea">Area</label>
                <select tabindex="14"  id="idArea" name="idArea" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['areas'] as $listaAreas){ ?>
                        <option value="<?php echo $listaAreas['idArea'] ?>" <?php echo (isset($datos['idArea']) && $listaAreas['idArea'] == $datos['idArea'])?'selected':''; ?>><?php echo $listaAreas['nombreArea'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>

        
          <div class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="idCargo">Cargo a desempeñar</label>
                <select tabindex="15"  id="idCargo" name="idCargo" class="ember-view ember-text-field form-control">
                    <option value=""></option>
                  <?php foreach($selects['cargos'] as $cargos){ ?>
                      <option value="<?php echo $cargos['idCargo'] ?>" <?php echo (isset($datos['idCargo']) && $cargos['idCargo'] == $datos['idCargo'])?'selected':''; ?>><?php echo $cargos['nombreCargo'] ?></option>
                  <?php } ?>
                </select>
              </div> 
          </div>
          <div  class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="contrato">Tipo de contrato</label>
                <select tabindex="16"  id="contrato" name="contrato" class="ember-view ember-text-field form-control">
                    <option value=""></option>
                    <option value="INDEFINIDO" <?php echo (isset($datos['contrato']) && 'INDEFINIDO' == $datos['contrato'])?'selected':''; ?>>INDEFINIDO</option>
                </select>
              </div> 
           </div>   

          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="salario">Salario</label>
                  <input tabindex="17" autocomplete="off" id="salario" name="salario"  class="form-control" value="<?php echo (isset($datos['salario']))?$datos['salario']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>
          </div>

          <div  class="col col-lg-6">
            <div class="form-group  label-floating">
                <label class="control-label" for="fechaIngreso">Fecha Ingreso</label>
                  <input tabindex="19" autocomplete="off" id="fechaIngreso" name="fechaIngreso"  class="form-control" value="<?php echo (isset($datos['fechaIngreso']))?$datos['fechaIngreso']:''; ?>" type="text">
              <p class="help-block"></p>
            </div>
          </div>

          <div  class="col col-lg-6">
            <div class="form-group label-floating">
                <label class="control-label" for="id_eps">EPS</label>
                <select tabindex="20"  id="id_eps" name="id_eps" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['eps'] as $epss){ ?>
                        <option value="<?php echo $epss['id_eps'] ?>" <?php echo (isset($datos['id_eps']) && $epss['id_eps'] == $datos['id_eps'])?'selected':''; ?>><?php echo $epss['des_eps'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>

          <div  class="col col-lg-6">
            <div class="form-group label-floating">
                <label class="control-label" for="id_afp">AFP</label>
                <select tabindex="21"  id="id_afp" name="id_afp" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['afp'] as $afps){ ?>
                        <option value="<?php echo $afps['id_afp'] ?>" <?php echo (isset($datos['id_afp']) && $afps['id_afp'] == $datos['id_afp'])?'selected':''; ?>><?php echo $afps['des_afp'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>

          <div  class="col col-lg-6">
            <div class="form-group label-floating">
                <label class="control-label" for="id_app_cesantias">Fondo de cesantias</label>
                <select tabindex="22"  id="id_app_cesantias" name="id_app_cesantias" class="form-control">
                    <option value=""></option>
                    <?php foreach($selects['cesantias'] as $cesantiass){ ?>
                        <option value="<?php echo $cesantiass['id_app_cesantias'] ?>" <?php echo (isset($datos['id_app_cesantias']) && $cesantiass['id_app_cesantias'] == $datos['id_app_cesantias'])?'selected':''; ?>><?php echo $cesantiass['nombrefondocesantias'] ?></option>
                    <?php } ?>
                </select>
            </div>
          </div> -->


       

         
            <div  class="col col-lg-6">
              <div class="form-group  label-floating">
                  <label class="control-label" for="email">Correo electrónico</label>
                    <input tabindex="23" autocomplete="off" id="email" name="email"  class="form-control" value="<?php echo (isset($datos['emailUsuario']))?$datos['emailUsuario']:''; ?>" type="text">
              </div>
            </div>

          <!-- <div class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="tipoUsuario">Tipo de usuario</label>
                <select tabindex="24"  id="tipoUsuario" name="tipoUsuario" class="ember-view ember-text-field form-control">
                    <option value=""></option>
                    <option value="1" <?php echo (isset($datos['tipoUsuario']) && $datos['tipoUsuario'] == 1)?'selected':''; ?>>Administrativo</option>
                    <option value="2" <?php echo (isset($datos['tipoUsuario']) && $datos['tipoUsuario'] == 2)?'selected':''; ?>>Operativo</option>
                </select>
              </div> 
          </div> -->

            <div  class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="idPerfil">Perfil de usuario</label>
                <select tabindex="25"  id="idPerfil" name="idPerfil"  class="ember-view ember-text-field form-control">
                    <option value=""></option>
                  <?php foreach($selects['perfiles'] as $perfiles){ ?>
                      <?php if($perfiles['idPerfil'] != 1){?>
                        <option value="<?php echo $perfiles['idPerfil'] ?>" <?php echo (isset($datos['idPerfil']) && $perfiles['idPerfil'] == $datos['idPerfil'])?'selected':''; ?>><?php echo $perfiles['nombrePerfil'] ?></option>
                      <?php } ?>
                  <?php } ?>
                </select>
              </div> 
            </div>

            <div  class="col col-lg-6">
              <div class="form-group label-floating">
                <label class="control-label" for="idEmpresa">Empresa</label>
                <select tabindex="25"  id="idEmpresa" name="idEmpresa" class="ember-view ember-text-field form-control">
                    <option value=""></option>
                  <?php foreach($selects['empresas'] as $perfiles){ ?>
                      <option value="<?php echo $perfiles['idEmpresa'] ?>" <?php echo (isset($datos['idEmpresa']) && $perfiles['idEmpresa'] == $datos['idEmpresa'])?'selected':''; ?>><?php echo $perfiles['nombre'] ?></option>
                  <?php } ?>
                </select>
              </div> 
            </div>

            <div  class="col col-lg-6">
                <?php if($edita == 1){ ?>
                  <div class="form-group  label-floating">
                    <label class="control-label" for="estado">Estado del usuario</label>
                    <select tabindex="26" class=" form-control" id="estado" name="estado">
                      <option value="1" <?php if($datos['estadoU'] == 1){?>selected<?php }?>>Activo</option>
                      <option value="0" <?php if($datos['estadoU'] == 0){?>selected<?php }?>>Inactivo</option>
                    </select>
                  </div> 
                  <input id="idUsuario" name="idUsuario" value="<?php echo $idUsuario ?>" type="hidden">
                <?php } ?>
            </div>


  </div>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <?php if(getPrivilegios()[0]['crear'] == 1 && $edita == 0){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>
    
    <?php if(getPrivilegios()[0]['editar'] == 1 && $edita == 1){ ?>
      <button type="submit" class="btn btn-raised btn-primary"><?php echo $labelBtn ?></button>
    <?php } ?>

  </div>
</form>