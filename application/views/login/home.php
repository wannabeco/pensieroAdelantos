<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-signin" data-ember-action="2" id="formLogin" ng-submit="loginInApp()">
              <h1>Ingreso al sistema</h1>
              <div>
                <input name="usuario"  autocomplete="off" ng-change="getPicture()" ng-model="usuario" id="usuario" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("placeHolderCorreo") ?>" type="text"/>
              </div>
              <div>
                <input name="clave"  autocomplete="off" ng-model="clave" id="clave" class="ember-view ember-text-field form-control login-input-pass" placeholder="<?php echo lang("placeHolderClave") ?>" type="password"/>
              </div>
              <div>
              <button class="btn btn-danger " href="index.html"><?php echo lang("labelBtnLogin") ?></button>
                <!-- <a class="reset_pass" href="<?php echo base_url() ?>Inicio/recordarClave">Olvid&oacute; su clave?</a> -->
                <a class="reset_pass" href="#signup">Olvid&oacute; su clave?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">Eres nuevo?
                  <a href="#signup" class="to_register"> Resg&iacute;strate! </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="<?php echo base_url()?>res/img/logoRojo-05.png" alt="" width="80%">
                  <p>©<?php echo date("Y")?> Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>


        
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="formCambioClave" ng-submit="recordarClaveUsuario()">
              <h1>Olvide mi clave</h1>
              <small class="text-muted">Escriba el correo electrónico con el cual se encuentra registrado.</small>
              <!-- <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div> -->
              <div>
                <!-- <input type="email" name="usuario" id="usuario" class="form-control" placeholder="Correo electr&oacute;nico" /> -->
                <input name="usuario" autocomplete="off"  ng-model="usuario" id="usuario" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("placeHolderCorreo") ?>" type="text">
              </div>
              <!-- <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div> -->
              <div>
                <button class="btn btn-primary " href="index.html">Enviar nueva clave</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signin" class="to_register"> <i class="fa fa-arrow-left"></i> Regresar </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-money"></i> <?php echo $titulo ?></h1>
                  <p>©<?php echo date("Y")?> Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>




      </div>
	</div>