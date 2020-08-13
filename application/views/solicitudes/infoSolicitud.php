<!-- Inicio Div que engloba todo-->
<div ng-controller="solicitudes" ng-init="init()" id="contenedorSolicitudes">

    <div class="modal fade" tabindex="-1" role="dialog" id="modalUsuarios" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
            
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left">
        <h1>
           Solicitud nro: <?php echo $infoSolicitud['idSolicitud']?><!--<small>Estructura de las áreas de su empresa</small>-->
            <!-- <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                        <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" href="<?php echo base_url()?>Empleados/gestionEmpleados/<?php echo $infoModulo['idModulo'] ?>/crear/0"><i class="fa fa-fw fa-plus"></i>  NUEVO EMPLEADO</a></li>
                        <li><a class="btn" href="<?php echo base_url()?>Empleados/cargaViaExcel/<?php echo $infoModulo['idModulo'] ?>"><i class="fa fa-fw fa-file-excel-o"></i>  CARGA V&iacute;A EXCEL</a></li>
                    </ul>
                </div>
            <?php } ?> -->
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
                <!-- <div class="x_title"></div> -->
                <!-- Tablas y cualquier contenido-->
                <div class="x_content">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="card">
                                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                <div class="card-body">
                                    <h5 class="card-title">Informaci&oacute;n del solicitante</h5>
                                    <p class="card-text">
                                        <strong>Nombres: </strong><?php echo $infoSolicitud['nombres']?><br>
                                        <strong>Apellidos: </strong><?php echo $infoSolicitud['apellidos']?><br>
                                        <strong>Correo electr&oacute;nico: </strong><?php echo $infoSolicitud['emailEmpleado']?><br>
                                        <strong>Telefono: </strong><?php echo $infoSolicitud['telefonoEmpleado']?><br>
                                        <strong>Direccion: </strong><?php echo $infoSolicitud['direccionEmpleado']?><br>
                                        <strong>Cargo: </strong><?php echo $infoSolicitud['cargo']?><br>
                                        <strong>Salario: </strong>$<?php echo number_format($infoSolicitud['salario'],0,",",'.')?><br>
                                    </p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6">
                            <div class="card">
                                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                <div class="card-body">
                                    <h5 class="card-title">Informaci&oacute;n de la empresa</h5>
                                    <p class="card-text">
                                        <strong>Empresa: </strong><?php echo $infoSolicitud['nombre']?><br>
                                        <strong>Representante legal: </strong><?php echo $infoSolicitud['nombreEncargado']?><br>
                                        <strong>Correo electr&oacute;nico: </strong><?php echo $infoSolicitud['email']?><br>
                                        <strong>Contacto: </strong><?php echo $infoSolicitud['personaContacto']?><br>
                                        <strong>Direcci&oacute;n: </strong><?php echo $infoSolicitud['direccion']?><br>
                                        <strong>Telefono contacto: </strong><?php echo $infoSolicitud['telefonoContacto']?><br>
                                    </p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6" style="margin:10px 0 0 0">
                            <div class="card">
                                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                <div class="card-body">
                                    <h5 class="card-title">Informaci&oacute;n del adelanto</h5>
                                    <p class="card-text">
                                        <strong>Monto solicitado: </strong>$<?php echo number_format($infoSolicitud['monto'],0,',','.')?><br>
                                        <strong>Comisi&oacute;n: </strong>$<?php echo number_format($infoSolicitud['valorInteres'],0,',','.')?><br>
                                        <strong>Valor descuento n&oacute;mina: </strong>$<?php echo number_format($infoSolicitud['montoConInteres'],0,',','.')?><br>
                                        <strong>Comisi&oacute;n: </strong><?php echo $infoSolicitud['interes']?>%<br>
                                        <strong>Fecha solicitud: </strong><?php echo $infoSolicitud['fechaSolicitud']?><br>
                                        <strong>Ip solicitud: </strong><?php echo $infoSolicitud['ip']?><br>
                                        <strong>Dispositivo: </strong><?php echo $infoSolicitud['userAgent']?><br>
                                    </p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6" style="margin:10px 0 0 0">
                            <div class="card">
                                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                <div class="card-body">
                                    <h5 class="card-title">Informaci&oacute;n de cuenta bancaria</h5>
                                    <p class="card-text">
                                        <strong>Banco: </strong><?php echo $infoSolicitud['nombreEntidad']?><br>
                                        <strong>Tipo de cuenta: </strong><?php echo $infoSolicitud['tipoCuenta']?><br>
                                        <strong>N&uacute;mero de cuenta: </strong><?php echo $infoSolicitud['nroCuenta']?><br>
                                    </p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="margin:10px 0 0 0">
                        <div class="col text-right">
                            <button class="btn btn-danger">RECHAZAR SOLICITUD</button>
                            <button class="btn btn-success">APROBAR SOLICITUD</button>
                        </div>
                    </div>
                </div>
                <!-- Fin de las tablas y cualquier contenido-->
            </div>
        </div>
    </div>
    <!-- Fin de la nueva zona del contenido-->
</div>
<!-- Fin Div que engloba todo-->