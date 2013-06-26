<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<?php

$this->widget('TbExtendedSummaryGrid', array(
    'id' => 'inv-product-grid',
    'type' => 'striped bordered',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}{pager}",
    'redirectRoute' => array('admin', 'ajax' => $this->id),
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
//array('name' => 'id', 'header' => '#'),
        array(
            'name' => 'sku',
            'header' => 'SKU',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'name',
            'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        /*
          array(
          'name' => 'short_description',
          'header' => 'Short Description',
          'class' => 'bootstrap.widgets.TbEditableColumn',
          'editable' => array(
          'type' => 'textarea',
          )
          ),
          array(
          'name' => 'description',
          'header' => 'Description',
          'class' => 'bootstrap.widgets.TbEditableColumn',
          'editable' => array(
          'type' => 'wysihtml5',
          )
          ),
         */
        array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'toggle',
            'name' => 'is_in_stock',
            'header' => 'Is In Stock'
        ),
        array(
            'name' => 'items_in_stock',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'wholesale_price',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'wholesale_special_price',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'retail_price',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
        array(
            'name' => 'retail_special_price',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'text',
            )
        ),
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
        ),
        array(
            'name' => 'manufacturer',
            //'header' => 'name',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'toggle',
            'name' => 'is_published',
            'header' => 'Is In Stock'
        ), /*
          array(
          'class' => 'bootstrap.widgets.TbToggleColumn',
          'toggleAction' => 'toggle',
          'name' => 'is_validated',
          'header' => 'Is In Stock'
          ),
          'last_update_date',

          array(
          'name' => 'name',
          'header' => 'Region Name',
          'class' => 'bootstrap.widgets.TbEditableColumn',
          'headerHtmlOptions' => array('style' => 'width:80px'),
          'editable' => array(
          'type' => 'text',
          )
          ),

          array(
          'name' => 'details',
          'header' => 'Details',
          'type' => 'raw',
          'value' => 'CHtml::link(
          "details",
          "",
          array(
          \'style\'=>\'cursor: pointer; text-decoration: underline;\',
          \'onclick\'=>\'{updateComment("\'.Yii::app()->controller->createUrl("update", array("id" => $data->id)).\'");}\'
          )
          );',
          ),

         */
        array(
            'class' => 'TbButtonColumn',
            'template' => "{delete}",
            //'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
        ),
    )
));
?>