<div class="container">
  <div class="row">
    <div class="col-lg-12">
        <div class="container-fluid text-center" style="margin-top:10%">
              <form class="form-signin" data-ember-action="2" id="formCambioClave" ng-submit="recordarClaveUsuario()">
                <img src="<?php echo base_url()?>res/img/logo.png" width="100%"><br><br>
                <h2 class="form-signin-heading">RECORDAR CONTRASEÑA</h2>
                <small class="text-muted">Escriba el correo electrónico con el cual se encuentra registrado.</small>
                <div class="row-picture" style="margin:10% 0 0 0">
                  <img class="img img-circle" id="miniatura" ng-src="{{fotoLogin}}" alt="icon" width="35%">
                </div>
                <input name="usuario" autocomplete="off" ng-change="getPicture()" ng-model="usuario" id="usuario" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("placeHolderCorreo") ?>" type="text">
                <button class="btn btn-raised btn-danger" data-bindattr-3="3">ENVIAR NUEVA CLAVE</button>
                <br><br>

              </form>
      </div>
    </div>
  </div>

</div>