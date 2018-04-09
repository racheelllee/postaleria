
<div class="col-md-12">
    <?php if(!empty($productos)) { ?>
        <table class="table table-striped table-hover dt-responsive" width="100%">
            <thead>
                <tr>
                    <th class="promociones-productos-table"><?php echo __('SKU'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Precio Regular'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Mostrar Precio Regular'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Precio de Promoción'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Mostrar Precio de Promoción'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Precio MSI'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Mostrar Precio MSI'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Cantidad de MSI'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Mostrar Cantidad de MSI'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Porcentaje de Descuento'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Mostra Porcentaje de Descuento'); ?></th>
                    
                    <th class="promociones-productos-table"><?php echo __('Categorías'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Nombre'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Url'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Descripción Corta'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Descripción Larga'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Meta Título'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Meta Descripción'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Meta Keywords'); ?></th>
                    <th class="promociones-productos-table"><?php echo __('Complementos'); ?></th>
                    <th style="width:20px;" class="promociones-productos-table"><?php echo __('Action'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $error = false;
                    foreach($productos as $producto) { if(isset($producto['result_upload'])){ $error = true; }

                        echo '<tr>';

                            echo '<td align="center">'.$producto['sku'].'</td>';
                            echo '<td align="center">$'.number_format($producto['precio'],2).'</td>';
                            echo '<td align="center">'.( ($producto['ver_precio'])? 'Si' : 'No' ).'</td>';
                            echo '<td align="center">$'.number_format($producto['precio_promocion'],2).'</td>';
                            echo '<td align="center">'.( ($producto['ver_precio_promocion'])? 'Si' : 'No' ).'</td>';
                            echo '<td align="center">$'.number_format($producto['precio_meses_sin_intereses'],2).'</td>';
                            echo '<td align="center">'.( ($producto['ver_precio_meses_sin_intereses'])? 'Si' : 'No' ).'</td>';
                            echo '<td align="center">'.$producto['meses_sin_intereses'].'</td>';
                            echo '<td align="center">'.( ($producto['ver_meses_sin_intereses'])? 'Si' : 'No' ).'</td>';
                            echo '<td align="center">'.$producto['porcentaje_descuento_promocion'].'</td>';
                            echo '<td align="center">'.( ($producto['ver_porcentaje_descuento_promocion'])? 'Si' : 'No' ).'</td>';


                            echo '<td align="center">'.$producto['categorias'].'</td>';
                            echo '<td align="center">'.$producto['nombre'].'</td>';
                            echo '<td align="center">'.$producto['url'].'</td>';
                            echo '<td align="center">'.$producto['descripcion_corta'].'</td>';
                            echo '<td align="center">'.$producto['descripcion_larga'].'</td>';
                            echo '<td align="center">'.$producto['meta_titulo'].'</td>';
                            echo '<td align="center">'.$producto['meta_descripcion'].'</td>';
                            echo '<td align="center">'.$producto['meta_keywords'].'</td>';
                            echo '<td align="center">'.$producto['complementos'].'</td>';


                            echo '<td align="center">';

                                if(empty($producto['result_upload'])){
                                    echo '<i class="fa fa-check btn btn-primary btn-xs"></i>';
                                }else{

                                    echo '<i data-container="body" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="'.$this->element('errors_popover', ['errors' => $producto['result_upload']] ).'" class="fa fa-times btn btn-danger btn-xs"></i>';
                                }

                            echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>

        <?php } else {
            $error = true;
            echo "<p align='center'><br/><br/>".__('No Records Available')."</p>";
        } ?>
</div>

<script type="text/javascript">  

   $("#table_first").removeClass("dataTable");
   
  });
</script>

<div class="col-md-12" align="center">
    <?php

        if(!$error){
            echo $this->Form->create(null, ['url'=>'/productos/addProducts']);

                echo $this->Form->input('productosFile', ['type'=>'hidden', 'value'=>$productosFile]);

                echo $this->Form->Submit(__('Finalizar'), ['div'=>false, 'class'=>'btn btn-span btn-md btn-submit']);

            echo $this->Form->end();
        }

    ?>
    <br>
</div>