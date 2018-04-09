<?php 
   
    $nombre_reporte="Layout_de_Carga_de_Productos-".date('Y-m-d_H_i_s');
    $this->Excel->set_header('productos');

    $row=1;
    $col=0;

            
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('SKU'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Precio Regular'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Mostrar Precio Regular'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Precio de Promoción'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Mostrar Precio de Promoción'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Precio MSI'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Mostrar Precio MSI'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Cantidad de MSI'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Mostrar Cantidad de MSI'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Porcentaje de Descuento'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Mostra Porcentaje de Descuento'));
    
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Categorías'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Nombre'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Url'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Descripción Corta'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Descripción Larga'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Meta Título'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Meta Descripción'));
    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Meta Keywords'));
//    $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row,__('Complementos'));

    $this->Excel->objWorksheet->getColumnDimension('A')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('B')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('C')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('D')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('E')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('F')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('G')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('H')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('I')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('J')->setWidth(30);
    $this->Excel->objWorksheet->getColumnDimension('K')->setWidth(30);
    
//    $this->Excel->objWorksheet->getColumnDimension('L')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('M')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('N')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('Ñ')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('O')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('P')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('Q')->setWidth(30);
//    $this->Excel->objWorksheet->getColumnDimension('R')->setWidth(30);
////    $this->Excel->objWorksheet->getColumnDimension('S')->setWidth(30);

    foreach ($productos as $producto){
        $row++;
        $col=0;

        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['sku']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['precio']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, ( ($producto['ver_precio'])? 'Si' : 'No' ));
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['precio_promocion']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, ( ($producto['ver_precio_promocion'])? 'Si' : 'No' ));
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['precio_meses_sin_intereses']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, ( ($producto['ver_precio_meses_sin_intereses'])? 'Si' : 'No' ));
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['meses_sin_intereses']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, ( ($producto['ver_meses_sin_intereses'])? 'Si' : 'No' ));
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['porcentaje_descuento_promocion']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, ( ($producto['ver_porcentaje_descuento_promocion'])? 'Si' : 'No' ));
//
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['categorias']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['nombre']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['url']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['descripcion_corta']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['descripcion_larga']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['meta_titulo']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['meta_descripcion']);
        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['meta_keywords']);
//        $this->Excel->objWorksheet->setCellValueByColumnAndRow($col++, $row, $producto['complementos']);
    }

    $this->Excel->do_print($nombre_reporte.'.xlsx');
                
    exit;
?>
