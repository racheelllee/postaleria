<?php 
$this->Html->addCrumb(__('Editar Diseño'), ['controller' => 'Productos', 'action' => 'edit','plugin' => false]);
?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">
			<?php echo __('Editar Diseño'); ?>
		</span>
		<span class="panel-title-right">
			
		</span>
	</div>
	<div class="panel-body">
		<?= $this->Form->create($producto, ['type' => 'file']); ?>		
	    <div class="ca-form">
        	<div class="row">
    			<div class="col-md-6">
    				<div class="um-form-row form-group">
    					<label class="col-sm-2 control-label"><?php echo __('Nombre'); ?></label>
    					<div class="col-sm-10">
    						<?php echo $this->Form->input('nombre', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
    					</div>
    				</div>
    			</div>
    			
    			<div class="col-md-6">
    				<div class="um-form-row form-group">
    					<label class="col-sm-2 control-label"><?php echo __('Codigo'); ?></label>
    					<div class="col-sm-10">
    						<?php echo $this->Form->input('codigo', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
    					</div>
    				</div>
    			</div>
    		</div>
        	<div class="row">
    	    	<div class="col-md-6">
    	    		<div class="um-form-row form-group">
    	    			<label class="col-sm-2 control-label"><?php echo __('Precio'); ?></label>
    	    			<div class="col-sm-10">
    	    				<?php echo $this->Form->input('precio', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
    	    			</div>
    	    		</div>
    	    	</div>
    	    	<div class="col-md-6">
    	    		<div class="um-form-row form-group">
    	    			<label class="col-sm-2 control-label"><?php echo __('URL'); ?></label>
    	    			<div class="col-sm-10">
    	    				<?php echo $this->Form->input('url', ['type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
    	    			</div>
    	    		</div>
    	    	</div>
    	    </div>
        	<div class="row">
    			<div class="col-md-6">
    				<div class="um-form-row form-group">
    					<label class="col-sm-2 control-label"><?php echo __('Foto'); ?></label>
    					<div class="col-sm-10">
    	                    <?= $this->Form->input('producto_tipo_foto_id', [ 'id'=> 'select_foto', 'div'=>false, 'class'=>'form-control',  'label' => false, 'options' => $tipoFotos]); ?>
    	                </div>
    				</div>	
    			</div>
    			<div class="col-md-6">
    				<div class="um-form-row form-group">
    					<label class="col-sm-2 control-label"><?php echo __('Tipo'); ?></label>
    					<div class="col-sm-10">
    	                    <?= $this->Form->input('tipo', [ 'id'=> 'select_tipo', 'div'=>false, 'class'=>'form-control',  'label' => false, 'options' => ['horizontal'=>'hotizonal', 'vertical'=>'vertical']]); ?>
    	                </div>
    				</div>	
    			</div>
	    		</div>
	        	<div class="row">
	    			<div class="col-md-6">
	    				<!-- <div class="um-form-row form-group">
	    					<label class="col-sm-2 control-label"><?php echo __('Orientación'); ?></label>
	    					<div class="col-sm-10">
	    	                    <?= $this->Form->input('producto_orientacion_id', [ 'id'=> 'select_orientacion', 'div'=>false, 'class'=>'form-control',  'label' => false, 'options' => $orientaciones]); ?>
	    	                </div>
	    				</div> -->	
	    			</div>
	    			<div class="col-md-6">
	    				<div class="um-form-row form-group">
	    					<label class="col-sm-2 control-label"><?php echo __('Color'); ?></label>
	    	                <div class="col-sm-10">
	    	    				<?php echo $this->Form->input('color', ['id'=>"select_color", 'type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'form-control']); ?>
	    	    			</div>
	    				</div>	
	    			</div>
	    		</div>
	        	<div class="row">
	    			<div class="col-md-6">
	    				<div class="um-form-row form-group">
	    					<label class="col-sm-2 control-label">Diseño  Principal</label>
	    					<div class="col-sm-11">
	    						<div class="fileinput fileinput-new" data-provides="fileinput">
	    						    <div class="input-group input-large">
	    						        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
	    						            <i class="fa fa-picture-o fileinput-exists"></i>&nbsp;
	    						            <span class="fileinput-filename"> <?=$producto->photo?></span>
	    						        </div>
	    						        <span class="input-group-addon btn default btn-file" style="font-size: 10px;">
	    						            <span class="fileinput-new"> Selecciona una Imagen </span>
	    						            <span class="fileinput-exists"> Cambiar </span>
	    						            <input type="file" name="photo" id="imgInp" accept=".jpg,.png" value='<?=$producto->photo?>'>
	    						        </span>
	    						        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
	    						    </div>
	    						</div>
	    					</div>
	    				</div>
	    				<div>
	    					<?php echo $this->Html->image('/files/productos/photo/' . $producto->photo_dir . '/' . $producto->photo , ['id'=>'blah', 'style'=>"max-width:100%;height:auto;max-height:475px;"]);?>

	    				
	    				</div>
	    				<div class="um-form-row form-group">
	    					<label class="col-sm-2 control-label">Diseño  Secundario</label>
	    					<div class="col-sm-11">
	    						<div class="fileinput fileinput-new" data-provides="fileinput">
	    						    <div class="input-group input-large">
	    						        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
	    						            <i class="fa fa-picture-o fileinput-exists"></i>&nbsp;
	    						            <span class="fileinput-filename"> </span>
	    						        </div>
	    						        <span class="input-group-addon btn default btn-file" style="font-size: 10px;">
	    						            <span class="fileinput-new"> Selecciona una Imagen </span>
	    						            <span class="fileinput-exists"> Cambiar </span>
	    						            <input type="file" name="images[]" id="imgInp1" accept=".jpg,.png" multiple>
	    						            </span>
	    						        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
	    						    </div>
	    						</div>
	    					</div>
	    				</div>
	    				<div>
	    				<?php 
	    					if(!$flagEmpty){
	    						foreach ($diseno_sec as $key => $diseno) {
	    							echo $this->Html->image('/files/disenossecundarios/image/' . $diseno->image_dir . '/' . $diseno->image , ['style'=>"max-width:100%;height:auto;max-height:475px;"]);
	    						}
	    					}
	    				?>
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="um-form-row form-group">
	    					<label class="col-sm2 control-label">Texto</label>
	    					<div class="col-sm-10">
	    						<?php echo $this->Tinymce->textarea('texto',['type'=>'textarea', 'label'=>false, 'div'=>false, 'style'=>'height:300px', 'class'=>'form-control tinymce'], ['language'=>'en'], 'umcode'); ?>
	    					</div>
	    				</div>
	    			</div>
	    		</div>

		</div>
		
		<div class="col-md-12 split-btn">

            <?php echo $this->Form->Submit(__('Guardar'), ['div'=>false, 'class'=>'btn btn-submit']); ?>
			
		</div>
		<?php echo $this->Form->end(); ?>



		
		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/jqColorPicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/colors.min.js"></script>
<script type="text/javascript">



    $('#nombre').keyup(function () {

	    var url = slug($('#nombre').val());
	    $('#url').val(url);

    });

    function readURL(input) {
    	console.log(input);
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
	
	function readURL1(input) {
		console.log(input);
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#blah1').attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	  }
	}

    $("#imgInp").change(function() {
      readURL(this);
    });

    $("#imgInp1").change(function() {
      readURL1(this);
    });

    $(document).ready(function(){
    	$('#select_color').colorPicker();
    });


</script>