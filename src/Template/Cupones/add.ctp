    <?= $this->Form->create($cupon, ['url' => '/cupones/add','class' => 'form-horizontal']) ?>
    <div  style="padding: 50px;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label"><?= __('Nombre') ?></label>
                    <div class="col-md-6">
                        <?= $this->Form->input('nombre', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false, 
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <label class="custom-control custom-checkbox col-sm-3 control-label">
                      <input type="checkbox" name="cupon_unico" value="1" data-validation="required" id="cupon-unico">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"><?= __('Cupon Unico') ?></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label"><?= __('Fecha Inicio') ?></label>
                    <div class="col-md-6">
                        <?= $this->Form->input('fecha_inicio', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false, 
                            'id' => 'fecha-inicio',
                            'type' => 'text',
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label"><?= __('Fecha Fin') ?></label>
                    <div class="col-md-6">
                        <?= $this->Form->input('fecha_fin', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false, 
                            'id' => 'fecha-fin',
                            'type' => 'text',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label"><?= __('Monto') ?></label>
                    <div class="col-md-6">
                        <?= $this->Form->input('monto', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false, 
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label"><?= __('Porcentaje') ?></label>
                    <div class="col-md-6">
                        <?= $this->Form->input('porcentaje', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false, 
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label class="col-md-2 control-label"><?= __('Descripcion') ?></label>
                    <div class="col-md-9">
                        <?= $this->Form->input('descripcion', [
                            'data-validation' => 'required',
                            'class'=>'form-control', 
                            'label'=>false, 
                            'div'=>false,
                            'style'=>'width:100%'
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-submit']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript">

    $('#fecha-inicio').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy",
        language: 'es'

    });

    $('#fecha-fin').datepicker({ 
        autoclose: true,
        format: "dd-mm-yyyy",
        language: 'es'

    });

</script>