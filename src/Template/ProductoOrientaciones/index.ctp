<div class="row">
    <div class="col-xs-6 w-title w-color666">
      <h3 style="position: absolute; margin-top:30px;"><?php echo __('List of Producto Orientaciones');?></h3>
    </div>
    <div class="col-xs-6">
        <button class="btn btn-default w-AvenirLight w-btnNewUsers" data-toggle="modal" data-target="#productoOrientacionesModal">
            +  <?= __('New productoOrientacione') ?>
        </button>
    </div>
</div>
<div class="table-reponsive productoOrientaciones" style="margin-top:30px;">
    <table id="productoOrientacionesTable" >
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productoOrientaciones as $productoOrientacione): ?>
            <tr>
                <td><?= $this->Number->format($productoOrientacione->id) ?></td>
                <td><?= h($productoOrientacione->nombre) ?></td>
                <td class="actions">
                    <div class='btn-group'>
                        <button 
                                class='btn w-btnBorder578EBE btn-xs btn-outline dropdown-toggle dropdown-toggle btn-actions' data-toggle='dropdown' 
                                aria-expanded='false'>
                            <?= __('Actions') ?>
                            <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu pull-right'>
                            <li>
                                <!--a href="#" data-toggle="modal" data-target="#productoOrientacionesModal<?=$productoOrientacione->id?>">
                                    <?= __('Edit') ?>
                                </a-->
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productoOrientacione->id]) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productoOrientacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productoOrientacione->id)]) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#productoOrientacionesTable').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: -1 },
            ]
        });
    });
</script>
<div class="modal fade" id="productoOrientacionesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><?= __('Add productoOrientacione') ?></h4>
      </div>
      <?= $this->render('add', false, compact('dependencies')) ?>
    </div>
  </div>
</div>