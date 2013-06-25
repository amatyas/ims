<?php
$this->breadcrumbs[] = Yii::t('oims','Stock');


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('inv-product-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('oims', 'Stock'); ?> <small><?php echo Yii::t('oims', 'Manage'); ?></small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<?php
$this->widget('TbExtendedGridView', array(
    'id' => 'inv-product-grid',
    'type' => 'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items}{pager}",
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array('name' => 'id', 'header' => '#'),
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
                'type' => 'text',
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'toggle',
            'name' => 'is_published',
            'header' => 'Is In Stock'
        ),
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
            'class' => 'TbButtonColumn',
            'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
        ),
    )
));
?>