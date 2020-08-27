
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>" class="site_title">
                <img src="<?php echo base_url()?>res/img/logoRojo-05.png?<?php echo rand(0,1000)?>" alt="" width="80%">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php if($_SESSION['project']['info']['icono'] != ""){ ?>
                    <img class="profile_img img-circle" id="miniatura" src="<?php echo base_url()."res/fotos/personas/".$_SESSION['project']['info']['idPersona']."/".$_SESSION['project']['info']['icono'] ?>" alt="icon" width="35%">
                <?php }else{ ?>
                    <img class="profile_img img-circle" id="miniatura" src="<?php echo base_url()."res/img/user.jpg" ?>" alt="icon" width="25%">
                <?php } ?>


              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $_SESSION['project']['info']['nombre'] ?>  <?php echo $_SESSION['project']['info']['apellido'] ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> HOME </a></li>

                  <?php foreach($modulos as $modMenu){ ?>
                        <li>
                            <a ><i class="fa fa-fw <?php if($modMenu['icono'] != ""){ echo $modMenu['icono']; }else{ echo 'fa-circle';}?>"></i> <?php echo strtoupper($modMenu['nombreModulo']) ?>  <span class="fa fa-chevron-down"></span></a>
                            <?php if(count($modMenu['modulos']) > 0){ ?>
                                <ul class="nav child_menu">
                                    <?php foreach($modMenu['modulos'] as $hijos){ ?>
                                        <li><a href="<?php echo base_url()?><?php echo $hijos['urlModulo'] ?><?php echo $hijos['idModulo'] ?>"><i class="fa fa-fw <?php if($hijos['icono'] != ""){ echo $hijos['icono']; }else{ echo 'fa-circle';}?>"></i> <?php echo strtoupper($hijos['nombreModulo']) ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?> 


                 
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
           <!--  <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url()."res/fotos/personas/".$_SESSION['project']['info']['idPersona']."/".$_SESSION['project']['info']['icono'] ?>" alt=""><?php echo $_SESSION['project']['info']['nombre'] ?>  <?php echo $_SESSION['project']['info']['apellido'] ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="<?php echo base_url() ?>PerfilUsuario/datosUsuario"> Perfil</a>
                      <!-- <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                    <a class="dropdown-item"  href="javascript:;">Ayuda</a>
                    <a class="dropdown-item"  href="<?php echo base_url()?>Login/logout"><i class="fa fa-sign-out pull-right"></i> Cerrar sesi&oacute;n</a>
                  </div>
                </li>

               <!--  <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->