<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cupone'), ['action' => 'edit', $cupone->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cupone'), ['action' => 'delete', $cupone->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cupone->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cupones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cupone'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Marcas'), ['controller' => 'Marcas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Marca'), ['controller' => 'Marcas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Productos'), ['controller' => 'Productos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producto'), ['controller' => 'Productos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cupones view large-9 medium-8 columns content">
    <h3><?= h($cupone->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($cupone->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Codigo') ?></th>
            <td><?= h($cupone->codigo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cliente') ?></th>
            <td><?= $cupone->has('cliente') ? $this->Html->link($cupone->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $cupone->cliente->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= $cupone->has('categoria') ? $this->Html->link($cupone->categoria->nombre, ['controller' => 'Categorias', 'action' => 'view', $cupone->categoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= $cupone->has('marca') ? $this->Html->link($cupone->marca->id, ['controller' => 'Marcas', 'action' => 'view', $cupone->marca->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Producto') ?></th>
            <td><?= $cupone->has('producto') ? $this->Html->link($cupone->producto->nombre, ['controller' => 'Productos', 'action' => 'view', $cupone->producto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cupone->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto') ?></th>
            <td><?= $this->Number->format($cupone->monto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Porcentaje') ?></th>
            <td><?= $this->Number->format($cupone->porcentaje) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad') ?></th>
            <td><?= $this->Number->format($cupone->cantidad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Compra Minima') ?></th>
            <td><?= $this->Number->format($cupone->compra_minima) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Inicio') ?></th>
            <td><?= h($cupone->fecha_inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Fin') ?></th>
            <td><?= h($cupone->fecha_fin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupon Unico') ?></th>
            <td><?= $cupone->cupon_unico ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripcion') ?></h4>
        <?= $this->Text->autoParagraph(h($cupone->descripcion)); ?>
    </div>
</div>
