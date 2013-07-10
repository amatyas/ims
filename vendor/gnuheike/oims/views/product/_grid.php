<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<?php

$pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
$this->widget('TbExtendedSummaryGrid', array(
    'id' => 'inv-product-grid',
    'type' => 'striped bordered',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{summary}\n{items}\n{pager}\n{extendedSummary}",
    'redirectRoute' => array('admin', 'ajax' => $this->id),
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => '2',
            'checked' => 'false',
        ),
        array(
            'name' => 'sku',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'name',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'manufacturer',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'category_id',
            'value' => '$data->categoryToString',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'select',
                'source' => $this->createUrl('categories')
            )
        ),
        array(
            'name' => 'wholesale_price',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'retail_price',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'retail_special_price',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'wholesale_special_price',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'class' => 'TbToggleColumnOims',
            'toggleAction' => 'toggle',
            'name' => 'is_in_stock',
        ),
        array(
            'name' => 'items_in_stock',
            'class' => 'TbEditableColumnOims',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'class' => 'TbToggleColumnOims',
            'toggleAction' => 'toggle',
            'name' => 'is_published',
        ), /*
          array(
          'name' => 'details',
          'header' => '',
          'type' => 'raw',
          'value' => 'CHtml::link(
          "details",
          "",
          array(
          \'style\'=>\'cursor: pointer; text-decoration: underline;\',
          \'onclick\'=>\'{load_crud_product_form($(this).parent().parent().attr("data-update-url"));}\'
          )
          );',
          ), */
        array(
            'class' => 'TbButtonColumn',
            'template' => "{delete}",
            //'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
            'header' => CHtml::dropDownList('pageSize', $pageSize, array(25 => 25, 50 => 50, 100 => 100, 200 => 200, 0 => 'all'), array(
                'style' => 'width: 60px;',
                'onchange' => "$.fn.yiiGridView.update('inv-product-grid',{ data:{pageSize: $(this).val() }})",
            ))
        ),
    )
));
?>