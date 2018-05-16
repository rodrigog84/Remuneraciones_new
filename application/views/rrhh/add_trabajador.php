<?php if(isset($message)): ?>
     <div class="row">
        <div class="col-md-12">
                  <div class="alert alert-<?php echo $classmessage; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa <?php echo $icon;?>"></i> Alerta!</h4>
                <?php echo $message;?>
              </div>
    </div>            
  </div>
  <?php endif; ?>


<!--sub-heard-part--><form id="basicBootstrapForm" action="<?php echo base_url();?>rrhh/submit_trabajador" id="basicBootstrapForm" method="post">
<!--sub-heard-part-->
								<div class="sub-heard-part">
									<ul class="nav nav-tabs">
  										<li class="active"><a href="#datospersonales" data-toggle="tab">Datos Personales </a></li>
  										<li><a href="#datosempresa" data-toggle="tab"> Datos Empresa</a></li>
  										<li><a href="#datosllss" data-toggle="tab">L.L.S.S</a></li>
  										<li><a href="#pago" data-toggle="tab">Forma Pago</a></li>
  										<li><a href="#otros" data-toggle="tab">Otros</a></li>
  										<li><a href="#configuracion" data-toggle="tab">Configuraciones</a></li>
									</ul>
								</div>
								<!--//sub-heard-part-->
								
								<div class="graph-visual tables-main">
									<h3 class="inner-tittle two">Nuevo Colaborador </h3>
									<div class="graph">
										<div class="tab-content">
											<div class="tab-pane active" id="datospersonales">
												<section id="personales">
													<!--div class='row'>
							                          <div class='col-md-6'>
							                            <div class="form-group">
							                              <label for="apaterno">Apellido Paterno</label>
							                              <input type="text" class="form-control1" name="apaterno" id="apaterno" placeholder="Apellido Paterno" value="<?php echo $datos_form['apaterno'];?>"  >
							                            </div>
							                          </div>
							                          <div class='col-md-6'>
							                            <div class="form-group">
							                                <label for="amaterno">Apellido Materno</label>  
							                                 <input type="text" id="amaterno" name="amaterno" class="form-control1" placeholder="Apellido Materno" value="<?php echo $datos_form['amaterno'];?>">
							                            </div>
							                          </div>   
							                        </div-->

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Rut:</th> 
																<th>Número de Ficha:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="rut" id="rut"  class="form-control1"  placeholder="98123456-7" title="Escriba Rut" required  oninput="checkRut(this)">
															</td>
															<td>
																<input type="text" name="numficha" id="numficha" class="form-control1" id="" placeholder="Número de Ficha" >
															</td>
														</tbody>	
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Nombre Completo:</th> 
																<th>Apellido Parterno:</th>
																<th>Apellido Materno:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td >
																<div class="form-group">
																<input type="text" name="nombre" class="form-control1" id="nombre" placeholder="Nombre Completo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
																</div>
															</td>
															<td class="form-group">
																<input type="text" name="apaterno" class="form-control1" id="apaterno" placeholder="Apellido Parterno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
															</td>
															<td class="form-group">
																<input type="text" name="amaterno" class="form-control1" id="amaterno" placeholder="Apellido Materno" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Fecha de Nacimiento:</th> 
																<th>Nacionalidad:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control1" required id="datepicker" type="text" value="" onchange="calculaedad(this.value)"> <span id="edad" style="font-style:italic"></span>
															</td>
															<td>
																<select name="nacionalidad" id="nacionalidad" class="form-control1" required>
																	<option>Seleccione Nacionalidad</option>
						                                    		<?php foreach ($paises as $pais) { ?>
							                                      <?php $paisselected = $pais->id == $datos_form['id_nacionalidad'] ? "selected" : ""; ?>
							                                      <option value="<?php echo $pais->id_paises;?>" <?php echo $paisselected;?> ><?php echo $pais->nombre;?></option>
							                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Estado Civil:</th> 
																<th>Sexo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="ecivil" id="ecivil" class="form-control1" required>
							                                   <option value="">Seleccione Estado Civil</option>
								                                    <?php foreach ($estados_civiles as $estado_civil) { ?>
								                                      <?php $ecivilselected = $estado_civil->id == $datos_form['idecivil'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estado_civil->id_estado_civil;?>" <?php echo $ecivilselected;?> ><?php echo $estado_civil->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
								                                <select name="sexo" id="sexo"  class="form-control1" required>
								                                    <option value="">Seleccione Sexo</option>
								                                    <option value="M" <?php echo $datos_form['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
								                                    <option value="F" <?php echo $datos_form['sexo'] == 'F' ? 'selected' : ''; ?>>Femenino</option>
								                                </select> 
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Dirección:</th> 
																<th>Email:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="direccion" id="direccion" class="form-control1 required" placeholder="Dirección" size ="85" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="email" id="email" class="form-control1" placeholder="Email" size="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Región</th>
																<th>Tipo de Renta:</th> 
																<th>Cargo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="region" id="region" class="form-control1">
																	<?php foreach ($regiones as $region) { ?>
								                                      <?php $regionselected = $region->id == $datos_form['idregion'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $region->id_region;?>" <?php echo $regionselected;?> ><?php echo $region->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="tiporenta" id="tiporenta" class="form-control1">
																	<option value="">Seleccione Tipo Renta</option>
																	<option value="Mensual">Mensual</option>
																	<option value="Diaria">Diaria</option>
																	<option value="Semanal">Semanal</option>
																</select>
															</td>
															<td>
														 <?php $label_cargo = ""; ?>

							                              <select name="cargo" id="cargo"  class="form-control1"  >
							                                  <option value="">Seleccione un Cargo</option>
							                                  <?php foreach ($cargos as $cargo) { ?>
							                                      <?php if($cargo->idpadre != $label_cargo){
							                                              if($label_cargo != ''){
							                                                  echo "</optgroup>";
							                                              }
							                                              echo "<optgroup label='". $cargo->nombrepadre . "''>";
							                                              $label_cargo = $cargo->idpadre;
							                                      } ?>
							                                      <?php if(!($cargo->idpadre == '' && $cargo->hijos > 0)){ ?>
							                                        <?php $cargoselected = $cargo->id == $datos_form['idcargo'] ? "selected" : ""; ?>
							                                        <option value="<?php echo $cargo->id_cargos;?>" <?php echo $cargoselected;?> ><?php echo $cargo->nombre;?></option>
							                                      <?php } ?>
							                                  <?php } 
							                                        if($label_cargo != ''){
							                                          echo "</optgroup>";
							                                        }
							                                        ?>                                
							                              </select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Estudios:</th> 
																<th>Titulo:</th>
																<th>Idioma:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="estudios" id="estudios" class="form-control1">
																	<option value="">Seleccione Nivel Educacional</option>
						                                    		<?php foreach ($estudios as $estudio) { ?>
								                                      <?php $estudioselected = $estudio->id == $datos_form['idestudio'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $estudio->id_estudios;?>" <?php echo $estudioselected;?> ><?php echo $estudio->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<input type="text" name="titulo" id="titulo" class="form-control1" placeholder="Titulo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<select name="idioma" id="idioma" class="form-control1">
																	<option value="">Seleccione Idioma</option>
						                                    		<?php foreach ($idiomas as $idioma) { ?>
								                                      <?php $idiomaselected = $idioma->id == $datos_form['ididioma'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $idioma->id_idioma;?>" <?php echo $idiomaselected;?> ><?php echo $idioma->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Jefe o Supervisor:</th> 
																<th>Reemplazo de:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="jefe" id="jefe" class="form-control1">
																	<option value="">Seleccione Jefe o Supervisor</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="reemplazo" id="reemplazo" class="form-control1">
																	<option value="">Seleccione Reemplazo</option>
						                                    		<?php foreach ($personal as $trabajador) { ?>
								                                      <?php $jefeselected = $trabajador->id == $datos_form['idjefe'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $trabajador->id_personal;?>" <?php echo $jefeselected;?> ><?php echo $trabajador->nombre." ".$trabajador->apaterno." ".$trabajador->amaterno;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Licencia:</th> 
																<th>Talla de Polera:</th>
																<th>Talla de Pantalón:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="licencia" id="licencia" class="form-control1">
																	<option value="">Seleccione Tipo Licencia</option>
						                                    		<?php foreach ($licencias as $licencia) { ?>
								                                      <?php $licenciaselected = $licencia->id == $datos_form['idlicencia'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $licencia->id_licencia_conducir;?>" <?php echo $licenciaselected;?> ><?php echo $licencia->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="polera" id="polera" class="form-control1">
																	<option  value="">Seleccione Talla</option>
						                                    		<?php foreach ($polera as $tpolera) { ?>
								                                      <?php $poleraselected = $tpolera->id_vestuario == $datos_form['idvestuario'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tpolera->id_vestuario;?>" <?php echo $poleraselected;?>><?php echo $tpolera->talla;?></option>
								                                    <?php } ?>
																</select>

																<!--<input type="text" name="polera" id="polera" class="form-control1" placeholder="Talla de Polera">-->
															</td>
															<td>
																<select name="pantalon" id="pantalon" class="form-control1">
																	<option value="">Seleccione Talla</option>
						                                    		<?php foreach ($pantalon as $tpantalon) { ?>
								                                      <?php $pantalonselected = $tpantalon->id_vestuario == $datos_form['idvestuario'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tpantalon->id_vestuario;?>" <?php echo $pantalonselected;?>><?php echo $tpantalon->talla;?></option>
								                                    <?php } ?>
																</select>
														
																<!--<input type="text" name="pantalon" id="pantalon" class="form-control1" placeholder="Talla de Pantalón">-->
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>Tipo de Documento:</th> 
																<th>Centro de Costo:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="tipo_documento" id="tipo_documento" class="form-control1" placeholder="Tipo de Documento" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<select name="centro_costo" id="centro_costo" class="form-control1">
																	<option value="">Seleccione Centro Costo</option>
						                                    		<?php foreach ($centros_costo as $centro_costo) { ?>
								                                      <?php $centrocostoselected = $centro_costo->id == $datos_form['idcentrocosto'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $centro_costo->id_centro_costo;?>" <?php echo $centrocostoselected;?> ><?php echo $centro_costo->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead> 
															<tr> 
																<th>C de Beneficio:</th> 
																<th>Número de Celular:</th>
																		
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="beneficio" id="beneficio" class="form-control1" placeholder="C de Beneficio" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="fono" id="fono" class="form-control1" placeholder="Número de Celular">
															</td>
														</tbody>
													</table>
												</section>
											</div>
											<!--Datos de la Empresa-->
											<div class="tab-pane" id="datosempresa">
												<section class="empresa">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Clase:</th>
																<th>Sueldo Base:</th> 
																<th>Tipo C.C:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="clase" class="form-control1" id="clase" placeholder="Clases" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="sueldo_base" class="form-control1" id="sueldo_base" placeholder="Sueldo Base">
															</td>
															<td>
																<input type="text" name="tipo_cc" class="form-control1" id="tipo_cc" placeholder="Tipo CC" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Categoria:</th> 
																<th>Lugar de Pago:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																
																<select name="categoria" id="categoria" class="form-control1">
																	<option value="">Seleccione Categoria</option>
						                                    		<?php foreach ($categorias as $categoria) { ?>
								                                      <?php $categoriaselected = $categoria->id == $datos_form['idcategoria'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $categoria->id_categoria;?>" <?php echo $categoriaselected;?> ><?php echo $categoria->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="lugar_pago" id="lugar_pago" class="form-control1">
																	<option value="">Seleccione Lugar de Pago</option>
						                                    		<?php foreach ($lugar_pago as $lugar_pagos) { ?>
								                                      <?php $lugarpagosselected = $lugar_pagos->id == $datos_form['idlugarpago'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $lugar_pagos->id_lugar_pago;?>" <?php echo $lugarpagosselected;?> ><?php echo $lugar_pagos->nombre;?></option>
								                                    <?php } ?>
																</select>
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha de Ingreso:</th> 
																<th>Fecha de Retiro:</th>
																<th>Fecha de Finiquito:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Ingreso" class="form-control1" id="datepicker2" name="datepicker2" type="text" required value="">
															</td>
															<td>
																<input placeholder="Fecha Retiro" class="form-control1" id="datepicker3" type="text" value="" >
															</td>
															<td>
																<input placeholder="Fecha de Finiquito" class="form-control1" id="datepicker4" type="text" value="" >
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Inicio Cálculo Vacaciones:</th> 
																<th>Saldo Inicial Días Vacaciones Legales:</th>
																<th>Saldo Inicial Días Vacaciones Progresivas:</th>
																
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Inicio Vacaciones" class="form-control1" id="fecha_inicio_vacaciones"  size="30" type="text" value="">
															</td>
															<td>
																<input type="text" name="seccion" class="form-control1" id="vacaciones_legales" placeholder="Saldo Inicial Vacaciones Legales" size="30" value="0">
															</td>
															<td>
																<input type="text" name="seccion" class="form-control1" id="vacaciones_progresivas" placeholder="Saldo Inicial Vacaciones Progresivas" size="30" value="0">
															</td>
		
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Motivo de Egreso:</th> 
																<th>Tipo de Contrato:</th>
																<th>Jornada de Trabajo:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum minima.</option>
																</select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Sección:</th> 
																<th>Código Ine:</th>
																<th>Sindicato:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="seccion" class="form-control1" id="seccion" placeholder="Sección" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="codigo_ine" class="form-control1" id="codigo_ine" placeholder="Código Ine">
															</td>
															<td>
																<select name="sindicato" id="sindicato" class="form-control1">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>
																
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Rol Privado</th> 
																<th>Semana Corrida</th>  
																<th>Sitio Laboral:</th>
																<th>Zona Brecha:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="regimen_pago" id="regimen_pago" class="form-control1">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>
																
															</td>
															<td>
																<select name="semana_corrida" id="semana_corrida" class="form-control1">
																	<option value="SI">SI</option>
																	<option value="NO">NO</option>
																
																</select>
																
															</td>
															<td>
																<input type="text" name="sitio_laboral" class="form-control1" id="sitio_laboral" placeholder="Sitio Laboral" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="zona_brecha" class="form-control1" id="zona_brecha" placeholder="Zona Brecha" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Real:</th> 
																<th>1er Vencimiento:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Real" class="form-control1" id="fecha_real" type="text" value="">
															</td>
															<td>
																<input placeholder="1er Vencimiento" class="form-control1" id="vencimiento_1" type="text" value="" >
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="datosllss">
												<section class="llss">
													

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>L. Pago Cotiz:</th> 
																<th>A.F.P:</th>
																<th>Pensionado:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="pago_cotiza" class="form-control1" id="pago_cotiza" placeholder="L. Pago Cotiz" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<select name="afp" id="afp" class="form-control1">
																	<option value="">Seleccione AFP</option>
						                                    		<?php foreach ($afps as $afp) { ?>
								                                      <?php $afpselected = $afp->id == $datos_form['idafp'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $afp->id_afp;?>" <?php echo $afpselected;?> ><?php echo $afp->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
															</td>
															<td>
																<input type="checkbox" name="pensionado" id="pensionado" class="minimal" /> 
																
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Fecha Incorporación AFP:</th> 																	

																<th><input class="form-control1" name="seguro_cesantia" id="seguro_cesantia" type="checkbox" onchange="habilitar(this.checked);" > Seguro Cesantia:</th>
																<!--<th>Fecha Seguro Cesantia:</th>-->
															</tr> 
														</thead>
														<tbody>
															<td>
																<input placeholder="Fecha Incorp.AFP" class="form-control1" id="datepicker5"  name="datepicker5" type="text" value="" >
															</td>
															<td>
																<input placeholder="Fecha Ingreso AFC" class="form-control1" id="datepicker6" name="datepicker6" type="text" value="" disabled >
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Cese AFC:</th>
																<th>Isapre:</th>
																<th>Monto Pactado Plan Isapre (UF):</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="cese" class="form-control1" id="cese" placeholder="Cese AFC" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<select name="isapre" id="isapre" class="form-control1">
																	<option value="">Seleccione Isapre</option>
						                                    		<?php foreach ($isapres as $isapre) { ?>
								                                      <?php $isapreselected = $isapre->id == $datos_form['idisapre'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $isapre->id_isapre;?>" <?php echo $isapreselected;?> ><?php echo $isapre->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
															</td>
															<td>
																<input type="number" min="0" max="99" minlength="1" maxlength="2" step="0.01"name="monto_pactado"  class="form-control1" id="monto_pactado" placeholder="">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Número FUN:</th>
																<th>Vencimiento de Plan:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="numero_fun" class="form-control1" id="numero_fun" placeholder="Número FUN">
															</td>

															<td>
																<input placeholder="Vencimiento Plan" class="form-control1" id="datepicker9" type="text" value="" >
															</td>
														</tbody>
													</table>
													<table class="table table-striped">
														<thead>
															<tr>
																<th>A.P.V.</th>
																<th>Numero Contrato A.P.V.:</th>
																<th>Tipo Cotización A.P.V:</th>
																<th>Monto Cotización A.P.V:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="apv" id="apv" class="form-control1" >
																	<option value="">Seleccione APV</option>
						                                    		<?php foreach ($apv as $apvs) { ?>
								                                      <?php $apvselected = $apvs->id_apv == $datos_form['idapv'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $apvs->id_apv;?>" <?php echo $apvselected;?> ><?php echo $apvs->nombre;?></option>
								                                    <?php } ?>
								                                   </select>
																
															</td>
															<td>
																<input type="number" name="numero_contrato_apv" class="form-control1" id="numero_contrato_apv" placeholder="Numero Contrato">
															</td>
															<td>
																<select name="tipo_cotizacion" id="tipo_cotizacion" class="form-control1">
																	<option value="pesos">PESO</option>
																	<option value="uf">UF</option>
																	<option value="porcentaje">PORCENTAJE</option>
																</select>
																
															</td>
															<td>
																<input type="text" name="monto_cotizacion_apv" maxlength="2" class="form-control1" id="monto_cotizacion_apv" placeholder="Monto Cotizacion">
															</td>
														</tbody>
													</table>
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Tramo p/Asig. Fami:</th>
																<th>Trabajo Pesado/Insalub:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="tramo" id="tramo" class="form-control1">
																	<option>Seleccione tramo</option>
						                                    		<?php foreach ($tramos_asig_familiar as $tramo) { ?>
								                                      <?php $tramoselected = $tramo->id_tabla_asig_familiar == $datos_form['id_tabla_asig_familiar'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $tramo->id_tabla_asig_familiar;?>" <?php echo $tramoselected;?> ><?php echo 'TRAMO '.$tramo->tramo;?></option>
								                                    <?php } ?>																
								                                </select>

																
																<!--<input type="text" name="tramo" class="form-control1" id="tramo" placeholder="Tramo p/Asig. Familiar">-->
															</td>
															<td>
																<input type="text" name="trabajo_pesado" class="form-control1" id="trabajo_pesado" placeholder="Trabajo Pesado/Insalub">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Asignación Familiar Individual </th>
																<th>Asignación Familiar por Invalidez</th>
																<th>Asignación Familiar Maternal</th>
																
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="number" name="asig_individual" class="form-control1" id="asig_individual" placeholder="">
															</td>
															<td>
																<input type="number" name="asig_por_invalidez" class="form-control1" id="asig_por_invalidez" placeholder="">
															</td>
															<td>
																<input type="number" name="asig_maternal" class="form-control1" id="asig_maternal" placeholder="">
															</td>
															
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Estado APVC:</th>
																<th>Fecha APVC:</th>
																<th>Término de Subsidio:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="estado_apvc" class="form-control1" id="estado_apvc" placeholder="Estado APVC">
															</td>
															<td>
																<input placeholder="Fecha APVC" class="form-control1" id="datepicker10" type="text" value="" >
															</td>
															<td>
																<input placeholder="Término de Subsidio" class="form-control1" id="datepicker11" type="text" value="" >
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>																
																<th>Zona A. Familiar:</th>
																<th>Jornada de Trabajo:</th>
															</tr>
														</thead>
														<tbody>															
															<td>
																<input type="text" name="zona_familiar" class="form-control1" id="zona_familiar" placeholder="Zona A. Familiar">
															</td>
															<td>
																<select name="jornada_trabajo" id="jornada_trabajo" class="form-control1">
																	<option value="">Seleccione Jornada de Trabajo</option>
						                                    		<?php foreach ($jornada_trabajo as $jornada) { ?>
								                                      <?php $jornadaselected = $jornada->id_jornada == $datos_form['id_jornada'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $jornada->id_jornada;?>" <?php echo $jornadaselected;?> ><?php echo $jornada->nombre;?></option>
								                                    <?php } ?>
																</select>

															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="pago">
												<section class="formapago">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Forma de Pago:</th> 
																<th>Banco:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<select name="forma_pago" id="forma_pago" class="form-control1">
																	<option value="">Seleccione Forma de Pago</option>
						                                    		<?php foreach ($forma_pago as $pago) { ?>
								                                      <?php $pagoselected = $pago->id_forma_pago == $datos_form['id_forma_pago'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $pago->id_forma_pago;?>" <?php echo $pagoselected;?> ><?php echo $pago->descripcion;?></option>
								                                    <?php } ?>
																</select>
															</td>
															<td>
																<select name="banco" id="banco" class="form-control1">
																	<option value="">Seleccione Banco</option>
						                                    		<?php foreach ($bancos as $banco) { ?>
								                                      <?php $bancoselected = $banco->id_banco == $datos_form['id_banco'] ? "selected" : ""; ?>
								                                      <option value="<?php echo $banco->id_banco;?>" <?php echo $bancoselected;?> ><?php echo $banco->cod_sbif.' - '.$banco->nombre;?></option>
								                                    <?php } ?>																
								                                </select>
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Número de Cuenta:</th> 
																<th>Rut:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="cta_bancaria" class="form-control1" id="cta_bancaria" placeholder="Nº Cuenta Bancaria">
															</td>
															<td>
																<input type="text" name="rutfp" class="form-control1" id="rutfp" placeholder="Rut">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Nombre Completo:</th> 
																<th>Email:</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="nombrefp" class="form-control1" id="nombrefp" placeholder="Nombre Completo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
															<td>
																<input type="text" name="emailfp" class="form-control1" id="emailfp" placeholder="Email" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="otros">
												<section class="otros">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Número Funcionario SAP:</th>
																<th>Número de Tarjeta:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="funcionario" class="form-control1" id="funcionario" placeholder="Número Funcionario SAP">
															</td>
															<td>
																<input type="text" name="tarjeta" class="form-control1" id="tarjeta" placeholder="Número de Tarjeta">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Imprime Tickets:</th>
																<th>Horas de Trabajo:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<input type="text" name="horas_trabajo" class="form-control1" id="horas_trabajo" placeholder="Horas de Trabajo">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Código de Anexo:</th>
																<th>2do Vencimiento:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="codigo_anexo" class="form-control1" id="codigo_anexo" placeholder="Código de Anexo">
															</td>
															<td>
																<input placeholder="2do Vencimiento" class="form-control1" id="datepicker12" type="text" value="" >
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Anticipo Ind Monto:</th>
																<th>Anticipo Ind Días:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="anticipo_monto" class="form-control1" id="anticipo_monto" placeholder="0">
															</td>
															<td>
																<input type="text" name="anticipo_dias" class="form-control1" id="anticipo_dias" placeholder="0">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Autoriz Firma Doc:</th>
																<th>Sucursal Entrenam:</th>
																<th>Código Ocupación:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<select name="selector1" id="selector1" class="form-control1">
																	<option>Seleccione.</option>
																	<option>Dolore, ab unde modi est!</option>
																	<option>Illum, fuga minus sit eaque.</option>
																	<option>Consequatur ducimus maiores voluptatum min</option>
																</select>
															</td>
															<td>
																<input type="text" name="sucursal_entrenamiento" class="form-control1" id="sucursal_entrenamiento" placeholder="Sucursal Entrenamiento">
															</td>
															<td>
																<input type="text" name="codigo_ocupacion" class="form-control1" id="codigo_ocupacion" placeholder="0">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Evaluador:</th>
																<th>Usuario Windows:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="evaluador" class="form-control1" id="evaluador" placeholder="Evaluador">
															</td>
															<td>
																<input type="text" name="usuario_windows" class="form-control1" id="usuario_windows" placeholder="Usuario Windows">
															</td>
														</tbody>
													</table>

													<table class="table table-striped">
														<thead>
															<tr>
																<th>Cuenta Contable:</th>
																<th>Nivel de Sence:</th>
																<th>Franquicia Sence %:</th>
															</tr>
														</thead>
														<tbody>
															<td>
																<input type="text" name="cuenta_contable" class="form-control1" id="cuenta_contable" placeholder="0">
															</td>
															<td>
																<input type="text" name="nivel_sence" class="form-control1" id="nivel_sence" placeholder="0">
															</td>
															<td>
																<input type="text" name="franquicia" class="form-control1" id="franquicia" placeholder="0,00 %">
															</td>
														</tbody>
													</table>
												</section>
											</div>

											<div class="tab-pane" id="configuracion">
												<section class="configuracion">
													<table class="table table-striped">
    													<thead> 
															<tr> 
																<th>Vacaciones:</th> 
																<th>Cheque Restaurante:</th>
																<th>Licencias Médicas</th>
															</tr> 
														</thead>
														<tbody>
															<td>
																<input type="text" name="vacaciones" class="form-control1" id="vacaciones" placeholder="Vacaciones" data-toggle="modal" data-target="#myModal12">
															</td>
															<td>
																<input type="text" name="cheque_restau" class="form-control1" id="cheque_restau" placeholder="Cheque Restaurante" data-toggle="modal" data-target="#myModal9">
															</td>
															<td>
																<input type="text" name="licencia_medica" class="form-control1" id="licencia" placeholder="Licencias Médicas" data-toggle="modal" data-target="#myModal10">
															</td>
														</tbody>
													</table>
												</section>
											</div>
										</div>
										<br>
										<br>
										<button type="submit" class="btn btn-info">Guardar</button>
										
										<a href="<?php echo base_url();?>rrhh/mantencion_personal" class="btn btn-success">Volver</a>	
									</div>
								</div>

							</form>
<script>
function VerificaRut(rut) {
    if (rut.toString().trim() != '') {
      
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 1);
        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }
 
        var sumatoria = 0;
        var k = 0;
        var resto = 0;
 
        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }
 
        resto = sumatoria % 11;
        dv = 11 - resto;
 
        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return false;
    }
  }


  function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}




$(document).ready(function(){

  $('.numeros').keypress(function(event){
    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode != 46){
      event.preventDefault();
    } 
  })



});


/*

$(document).ready(function() {
    $('#basicBootstrapForm').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            lectura: {
                // The children's full name are inputs with class .childFullName
                selector: '.apaterno',
                // The field is placed inside .col-xs-6 div instead of .form-group
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Informaci&oacute;n de Horas Extraordinarias es requerida'
                    },
                },

            },
        }
    })
    
});*/
</script>

<!--date-piker-->
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-ui.js"></script>
<script>
	$(function() {
		$( "#datepicker,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6,#datepicker7,#datepicker8,#datepicker9,#datepicker10,#datepicker11,#datepicker12,#feriados,#fecha_real,#vencimiento_1,#fechanacimiento,#fecha_inicio_vacaciones").datepicker({
  dateFormat: "dd/mm/yy"
});
	});
</script>
<!--date-piker-->								

<script>
	 $(function(){
	 	$("#nacionalidad").val('46');
	 	$("#idioma").val('1');
	 	$("#tiporenta").val('Mensual');
	 	
	 })


</script>

<script language="JavaScript">

		function calculaedad(Fecha){
			var fecha_nueva = Fecha.split("/");

			fecha = new Date(fecha_nueva[2],fecha_nueva[1],fecha_nueva[0])
			hoy = new Date()
			
			ed = parseInt((hoy -fecha)/365/24/60/60/1000)
			if (ed >=0){
				$("#edad").text("Edad: "+ ed +" Año(s)");
			}else{
				$("#edad").text("");
			}
		
		
		}

</script>



<script>
		function habilitar(value)
		{
			if(value==true)
			{
				// habilitamos
				document.getElementById("seguro_cesantia").value = 1;
				document.getElementById("datepicker6").disabled=false;
				
			}else if(value==false){
				// deshabilitamos
				document.getElementById("seguro_cesantia").value = 0;
				document.getElementById("datepicker6").disabled=true;
			}
		}
</script>

<script>
function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}
</script>

