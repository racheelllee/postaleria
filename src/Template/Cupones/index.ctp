<div class="portlet light bordered " >   
  <div class="portlet-title">
    <div class="actions">

<?php 
$this->Html->addCrumb(__('Listado de Cupones'), ['controller' => 'Cupones', 'action' => 'index','plugin' => false]);
?>

<?php $this->assign('title', __('Listado de Cupones')   );  ?>
<?php $this->assign('header_title', __('Listado de Cupones')   );  ?>
        <?php if($this->UserAuth->HP('Cupones', 'add', false)){ ?>
            <?= $this->Html->link(__('Add Page'), ['action' => 'add'],['class'=>'ca-add', 'escape'=>false] ); ?>
        <?php } ?>
    </div>
  </div>
  <div class="portlet-body">
    <?php echo $this->element('all_cupones');?>
  </div>
</div>

