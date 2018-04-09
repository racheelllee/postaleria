  <div id="updateCuponesIndex">
    <?php echo $this->Search->searchForm('Cupones', ['legend'=>false, 'updateDivId'=>'updateCuponesIndex']); ?>
    <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('codigo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_inicio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_fin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('monto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('porcentaje') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cupon_unico') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php   if(!empty($cupones)) {
                $page = $this->request->params['paging']['Cupones']['page'];
                $limit = $this->request->params['paging']['Cupones']['perPage'];
                $i = ($page-1) * $limit;

        foreach ($cupones as $cupone): 
                    $i++;

            ?>

             <tr>
                <td><?= h($cupone->codigo) ?></td>
                <td><?= h($cupone->nombre) ?></td>
                <td><?= $this->Time->format($cupone->fecha_inicio, 'Y-M-d') ?></td>
                <td><?= $this->Time->format($cupone->fecha_fin, 'Y-M-d') ?></td>
                <td><?= $this->Number->format($cupone->monto) ?></td>
                <td><?= $this->Number->format($cupone->porcentaje) ?></td>
                <td><?= h($cupone->cupon_unico) ?></td>
                <td><?= $this->Number->format($cupone->status) ?></td>
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
                                <!--a href="#" data-toggle="modal" data-target="#cuponesModal<?=$cupone->id?>">
                                    <?= __('Edit') ?>
                                </a-->
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cupone->id]) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cupone->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cupone->id)]) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; 

      } else {
            echo "<tr><td colspan=9><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    <?php if(!empty($cupones)) {
        echo $this->element('simple_pagination');
    } ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#cupones-cat-id').val('<?php echo $search_categoria; ?>').change();
    });
</script>