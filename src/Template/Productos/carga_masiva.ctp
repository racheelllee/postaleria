<?php
$this->Html->addCrumb(__('Carga Masiva de Productos'), ['controller' => 'Productos', 'action' => 'cargaMasiva','plugin' => false]);
?>

<div id="myTabContent" class="tab-content" style="min-height: 700px">

    <div role="tabpanel" class="tab-pane fade in active" id="Productos" aria-labelledBy="Productos-tab">
        <div class="row ca-form">
            <div class="row" style="margin:20px;">
                <div class="col-xs-6 w-title w-color666" style="margin-top:35px;">

                    <span><?php echo __('Listado de Cargas'); ?></span>

                </div>

                <div class="col-xs-6">

                    <a href="/productos/productos" class="btn btn-submit pull-right" style="height: 37px; margin-left:10px;">
                        Descargar Productos
                    </a>

                    <?= $this->Form->create(null, ['id' => 'upload-excel', 'type' => 'file', 'url' => '/productos/cargaMasiva']); ?>

                    <span id="upload-file-spinner" style="display:none;" class="pull-right"><i class='fa fa-spinner fa-spin fa-5x fa-fw' style='font-size:15px;'></i></span>
                    <div class="fileinput fileinput-new pull-right" data-provides="fileinput">
                        <span class="btn btn-submit btn-file pull-right">
                            <span class="fileinput-new" style="font-size: 12px;"> <?= __('Cargar Productos') ?> </span>
                            <span class="fileinput-exists" style="font-size: 12px;"> <?= __('Cargar Productos') ?> </span>
                            <input name="upload-file" type="file" id="upload-file"> </span>
                    </div>

                    <?= $this->Form->end() ?>

                    <a href="/files/Layout_de_Carga_de_Productos.xlsx" class="btn btn-default pull-right" style="height: 37px; margin-right:10px;" download="Layout_de_Productos_de_Promociones.xlsx">
                        Descargar Layout
                    </a>

                </div>

                <div class="col-lg-12" style="margin-top:20px;">
                    
                    <div id="updateProductosIndex">                         
                        <table class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline w-AvenirLight">
                            <thead>
                                <tr>
<!--                                    <th class="psorting"><?= $this->Paginator->sort('sku', 'SKU') ?></th>
                                    <th class="psorting"><?= $this->Paginator->sort('nombre') ?></th>
                                    <th class="psorting"><?= $this->Paginator->sort('precio', 'Precio Lista') ?></th>
                                    <th class="psorting"><?= $this->Paginator->sort('precio_promocion', 'Precio Promoción') ?></th>
                                    <th class="psorting"><?= $this->Paginator->sort('precio_meses_sin_intereses', 'Precio MSI') ?></th>
                                    <th class="psorting"><?= $this->Paginator->sort('estatus_id', 'Estatus') ?></th>
                                    <th><?php echo __('Acciones'); ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                    echo "<tr><td colspan=9><br/><br/>" . __('No se encontraron resultados') . "</td></tr>";
                                
                                ?>
                            </tbody>
                        </table>                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="vista-previa-Productos">
        <div class="modal-dialog modal-lg" style="width: 96%;">
            <div class="modal-content row">
                <div class="col-xs-12 w-title w-color666" style="margin-top:35px;">

                    <span"><?php echo __('Vista Previa de Carga'); ?></span>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <?php echo $this->element('productos_cargados', ['productos' => $productosArray]); ?>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();

            var productosArray = <?= json_encode($productosArray) ?>;

            if(productosArray.length > 0){
                    $('#vista-previa-Productos').modal('show');
            }
        });

        $('#upload-file').change(function(){
        var file = this.files[0];
        var name = file.name;
        var ext = name.split('.').pop().toLowerCase();

        if(ext == 'xlsx' || ext == 'xls'){
            $('#upload-file-spinner').css({'display': 'block'});
            $('#upload-excel').submit();
        }else{
            alert('Tipo de archivo no valido.');
        }
    });
    </script>


</div>