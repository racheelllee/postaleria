<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
?>
    <CakePHPBakeOpenTag= $this->Form->create($<?= $singularVar ?>, ['url' => '/<?= $pluralVar ?>/add','class' => 'form-horizontal']) CakePHPBakeCloseTag>
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
<?php
                                                    // <CakePHPBakeOpenTagphp
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
?>
            <div class="form-group">
              <label class="col-md-4 control-label"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></label>
                <div class="col-md-6">
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', [
                        'options' => $<?= $keyFields[$field] ?>, 
                        'class'=>'form-control', 
                        'empty' => true,
                        'label'=>false, 
                        'div'=>false, 
                    ]); CakePHPBakeCloseTag>
                </div>
            </div>
<?php
                } else {
?>
            <div class="form-group">
              <label class="col-md-4 control-label"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></label>
                <div class="col-md-6">
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', [
                        'options' => $<?= $keyFields[$field] ?>,
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false,                         
                    ]); CakePHPBakeCloseTag>
                </div>
            </div>

<?php
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
?>
            <div class="form-group">
              <label class="col-md-4 control-label"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></label>
                <div class="col-md-6">
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', [
                        'class'=>'form-control', 
                        'empty' => true
                        'label'=>false, 
                        'div'=>false, 
                    ]); CakePHPBakeCloseTag>
                </div>
            </div>

<?php
                } else {
?>
            <div class="form-group">
              <label class="col-md-4 control-label"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag></label>
                <div class="col-md-6">
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', [
                        'data-validation' => 'required',
                        'class'=>'form-control', 
                        'label'=>false, 
                        'div'=>false, 
                    ]); CakePHPBakeCloseTag>
                </div>
            </div>
<?php
                }
            }
        }

        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
?>
            <CakePHPBakeOpenTag= $this->Form->input('<?= $assocData['property'] ?>._ids', ['options' => $<?= $assocData['variable'] ?>]); CakePHPBakeCloseTag>
<?php
            }
        }
?>
        </div>
    </div>
    <CakePHPBakeOpenTag= $this->Form->button(__('Submit')) CakePHPBakeCloseTag>
    <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>