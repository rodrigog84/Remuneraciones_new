<form id="formotros" action="<?php echo base_url();?>rrhh/submit_mut_caja" method="post" role="form" enctype="multipart/form-data">
                            <div class="panel panel-inverse">                       
                                <div class="panel-heading">
                                      <h4 class="panel-title">Impuesto &Uacute;nico</h4>
                                  </div>
                      <div class="panel-body">
                        <div class='row'>
                          <div class='col-md-6'>
                            <div class="form-group">
                                  <label for="caja">Caja de Compensaci&oacute;n Comunidad</label>    
                                  <select name="caja" id="caja"  class="form-control"  >
                                      <option value="">Sin Caja de Compensaci&oacute;n</option>
                                      <?php foreach ($cajas as $caja) { ?>
                                        <?php $cajaselected = $caja->id_cajas_compensacion == $empresa->idcaja ? "selected" : ""; ?>
                                        <option value="<?php echo $caja->id_cajas_compensacion;?>" <?php echo $cajaselected;?> ><?php echo $caja->nombre;?></option>
                                      <?php } ?>                             
                                  </select>
                            </div>  
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-md-6'>
                            <div class="form-group">
                                  <label for="mutual">Mutual de Seguridad</label>    
                                  <select name="mutual" id="mutual"  class="form-control"  >
                                      <option value="">Seleccione Mutual de Seguridad</option>
                                      <?php foreach ($mutuales as $mutual) { ?>
                                        <?php $mutualselected = $mutual->id_mutual_seguridad == $empresa->idmutual ? "selected" : ""; ?>
                                        <option value="<?php echo $mutual->id_mutual_seguridad;?>" <?php echo $mutualselected;?> ><?php echo $mutual->nombre;?></option>
                                      <?php } ?>                             
                                  </select>
                            </div>
                          </div>
                          <div class='col-md-6'>
                            <div class="form-group">
                                  <label for="porcmutual">Porcentaje</label>    
                                  <input type="text" class="form-control" name="porcmutual" id="porcmutual" placeholder="Ingrese Porcentaje" value="<?php echo is_null($empresa->idmutual) || $empresa->idmutual == 1 ? '' : $empresa->porcmutual; ?>"  <?php echo is_null($empresa->idmutual) || $empresa->idmutual == 1 ? 'disabled' : ''; ?> >
                            </div>   
                          </div>


                        </div>      
                                                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;&nbsp;
                      </div>
                      </div><!-- /.box-body -->

                 
                  </div> 
                  </div>
    </form>                   

<script>

    $(document).ready(function() {
        <?php if(isset($message)){ ?>

        $.gritter.add({
            title: 'Atención',
            text: '<?php echo $message;?>',
            sticky: false,
            image: '<?php echo base_url();?>images/logos/alert-icon.png',
            time: 5000,
            class_name: 'my-sticky-class'
        });
        /*setTimeout(redirige, 1500);
        function redirige(){
            location.href = '<?php //echo base_url();?>welcome/dashboard';
        }*/
        <?php } ?>


    });
</script>                  