<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<?php

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
            'name' => 'sku',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'toggle',
            'name' => 'is_in_stock',
        ),
        array(
            'name' => 'items_in_stock',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'retail_price',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
          array(
            'name' => 'retail_special_price',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'wholesale_price',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'wholesale_special_price',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),      
        /*
        array(
            'name' => 'special_price_start',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'date',
                'format' => 'yyyy-mm-dd',
                'viewformat' => 'yyyy-mm-dd',
                'placement' => 'bottom'
            )
        ),
        array(
            'name' => 'special_price_end',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'date',
                'format' => 'yyyy-mm-dd',
                'viewformat' => 'yyyy-mm-dd',
                'placement' => 'bottom'
            )         
         
        ),*/
        array(
            'name' => 'manufacturer',          
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
            )
        ),
        array(
            'name' => 'category',
            'value' => '$data->categoryToString',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'source' => $this->createUrl('categories')
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'template' => "{delete}",
            //'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
        ),
    )
));
?>