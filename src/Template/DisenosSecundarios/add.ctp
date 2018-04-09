    <?= $this->Form->create($disenosSecundario, ['url' => '/disenosSecundarios/add','class' => 'form-horizontal']) ?>
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Producto Id') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('producto_id', [
                        'options' => $productos,
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false,                         
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><?= __('Diseno Secundario') ?></label>
                <div class="col-md-6">
                    <?= $this->Form->input('diseno_secundario', [
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false, 
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>