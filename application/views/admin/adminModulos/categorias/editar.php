<div id="modalCategoriaEditar" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" ng-submit="editarCategoria()" id="formAgregaPersona">    
                <div class="modal-header">
                    <h3 class="modal-title">Editar Categoría</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">  
                    <!--<div class="alert alert-primary alert-dismissable">
                    <i class="fa fa-info-circle"></i> <?php echo lang("txtPersona4") ?>
                    </div>  -->          
                    <div class="form-group" id="cajaNombreEmpresa">
                        <input tabindex="1" autocomplete="off" id="" name="" ng-model="categoriaEditar.nombreModulo" class="ember-view ember-text-field form-control login-input" placeholder="Escriba el nombre de la categoría"  type="text">
                        <p class="help-block">Nombre que identificará la categorría de los módulos</p>
                    </div>
                    <div class="form-group" id="cajaNombreEmpresa">
                        <input tabindex="1" autocomplete="off" id="icono" name="icono" ng-model="categoriaEditar.icono" class="ember-view ember-text-field form-control login-input" placeholder="Ícono de la categoría. Fontawesome Ej: fa fa-file"  type="text">
                        <p class="help-block">Ícono de la categoría</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
                    <button type="submit" class="btn btn-raised btn-primary">EDITAR CATEGORÍA</button>
                </div>
            </form>
        </div>

    </div>
</div>