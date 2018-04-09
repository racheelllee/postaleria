<?php
/**
 * @var \\View\AppView $this
 * @var \ $disenosSecundario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Disenos Secundario'), ['action' => 'edit', $disenosSecundario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Disenos Secundario'), ['action' => 'delete', $disenosSecundario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disenosSecundario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Disenos Secundarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Disenos Secundario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="disenosSecundarios view large-9 medium-8 columns content">
    <h3><?= h($disenosSecundario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Producto') ?></th>
            <td><?= $disenosSecundario->has('producto') ? $this->Html->link($disenosSecundario->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $disenosSecundario->producto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diseno Secundario') ?></th>
            <td><?= h($disenosSecundario->diseno_secundario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($disenosSecundario->id) ?></td>
        </tr>
    </table>
</div>
