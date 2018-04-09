    <?= $this->Form->create($productoOrientacione, ['url' => '/productoOrientaciones/add','class' => 'form-horizontal']) ?>
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
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
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>