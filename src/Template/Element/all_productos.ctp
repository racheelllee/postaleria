  <div id="updateProductosIndex">
    <?php echo $this->Search->searchForm('Productos', ['legend'=>false, 'updateDivId'=>'updateProductosIndex']); ?>
    <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight">
        <thead>
            <tr>
                <th align="center" class="psorting"><?= $this->Paginator->sort('sku', 'Codigo') ?></th>
                <th align="center" class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
                <th align="center" class="psorting"><?= $this->Paginator->sort('precio', 'Precio') ?></th>
                <th align="left" class="psorting"><?= $this->Paginator->sort('estatus_id', 'Estatus')?></th>
                <th><?php echo __('Acciones');?></th>
            </tr>
        </thead>
        <tbody>
    <?php   if(!empty($productos)) {
                $page = $this->request->params['paging']['Productos']['page'];
                $limit = $this->request->params['paging']['Productos']['perPage'];
                $i = ($page-1) * $limit;

         foreach ($productos as $producto): 
                    $i++;

            ?>
            <?php if ($producto->deleted != 1): ?>

             <tr>
                <td><?= h($producto->sku) ?></td>
             
                <td><?= h($producto->nombre) ?></td>
                <td>$<?= number_format($producto->precio,2) ?></td>
                <td align="center">
                    <span class="label w-backgroud578EBE" style="background-color:<?php echo $producto->productos_estatus->color; ?> !important;"><?php echo $producto->productos_estatus->nombre; ?></span>
                </td>


                <td>
                    <div class="btn-group">
                        <button class="btn dropdown-toggle dropdown-toggle btn-actions" data-toggle="dropdown"> Acciones <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">

                            <li><?= $this->Html->link(__('Ver Diseño'), '/p/'.$producto->url, ['target'=>'blank_']) ?></li>

                            <?php if($producto->activo) {
                                echo "<li>".$this->Form->postLink(__('Desactivar Diseño'), ['action'=>'setInactive', $producto['id']], ['escape'=>false, 'confirm'=>__('¿Esta seguro de querer desactivar este diseño?')])."</li>";
                            } else {
                                echo "<li>".$this->Form->postLink(__('Activar Diseño'), ['action'=>'setActive', $producto['id']], ['escape'=>false, 'confirm'=>__('¿Esta seguro de querer activar este diseño?')])."</li>";
                            }?>

                            <li><?= $this->Html->link(__('Editar Diseño'), ['action' => 'edit', $producto->id]) ?></li>
                            <li><?= $this->Form->postLink(__('Borrar Diseño'), ['action' => 'delete', $producto->id], ['confirm' => __('Esta seguro que desea borrar el diseño?')]) ?></li>
                            
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
    <?php endforeach; 

      } else {
            echo "<tr><td colspan=9><br/><br/>".__('No se encontraron resultados')."</td></tr>";
            } 
    ?>
    </tbody>
    </table>
    <?php if(!empty($productos)) {
        echo $this->element('simple_pagination');
    } ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#productos-cat-id').val('<?php echo $search_categoria; ?>').change();
    });
</script>