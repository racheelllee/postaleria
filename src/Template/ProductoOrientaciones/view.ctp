<?php
/**
 * @var \\View\AppView $this
 * @var \ $productoOrientacione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Producto Orientacione'), ['action' => 'edit', $productoOrientacione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Producto Orientacione'), ['action' => 'delete', $productoOrientacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productoOrientacione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Producto Orientaciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producto Orientacione'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productoOrientaciones view large-9 medium-8 columns content">
    <h3><?= h($productoOrientacione->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($productoOrientacione->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($productoOrientacione->id) ?></td>
        </tr>
    </table>
</div>
