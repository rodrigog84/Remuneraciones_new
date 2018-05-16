        <!-- Main content -->
      
       
        <form id="basicBootstrapForm" action="<?php echo base_url();?>Carga_masiva/contratos_archivos" id="basicBootstrapForm" method="post"   enctype="multipart/form-data">
        <div class="row">
         <div class="col-md-6">
         <table class="table table-striped">
         <thead> 
          <tr>
            <td>
            <label for="caja">Tipo Documento</label>    
              <select name="tipo" id="tipocontrato" class="form-control1" required >
              <?php foreach ($tipocontrato as $tipo) { ?>
              <?php $paisselected = $tipo->id == $datos_form['id_tipo_doc_colaborador'] ? "selected" : "Tipo Contrato"; ?>
              <option value="<?php echo $tipo->id_tipo_doc_colaborador;?>" <?php echo $paisselected;?> ><?php echo $tipo->tipo;?></option>
              <?php } ?>
              <input type="text" name="tipocontrato" id="rut"  class="form-control1"  placeholder="Nombre Tipo Documento" title="Nombre " required size="100">
              </select>
            </td>                             
          </tr> 
         </thead>
        <tbody>
        </tbody>  
      </table>
         </div>
        </div>
         <div class="row">

            <div class="col-md-6">

              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">Carga Documentos</h4>      
                </div>
                  <div class="panel-body">
                        <div class="form-group">
                              <label for="exampleInputFile">Archivo de Carga  - <a href="<?php echo base_url(); ?>rrhh/exportarExcelanticipos" data-toggle="tooltip" title="Ejemplo" target="_blank"></a></label>
                              <input type="file" id="userfile" name="userfile">
                        </div>  
                  </div><!-- /.box-body -->
                  <div class="panel-footer">
                    <button type="submit" class="btn btn-success" name="cargar">Cargar</button>
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url();?>configuraciones/tipos_contrato" class="btn btn-default">Volver</a>
                  </div>                  
              </div>
            </div>       
          </div>
      </form>          
 <script>
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
            userfile: {
                row: '.form-group',
                validators: {
                    notEmpty: {
                        message: 'Archivo de Carga'
                    }              
                }
            }, 
        }
    })
});
</script>
