<?php
$this->breadcrumbs[] = Yii::t('OimsModule.oims', 'Stock');
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('oims') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'admin.js'));

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
    <?php echo Yii::t('OimsModule.oims', 'Stock'); ?> <small><?php echo Yii::t('OimsModule.oims', 'Manage'); ?></small>
</h1>

<div class="row-fluid">

    <div class="span9" id="oims-grid">
        <?php echo $this->renderPartial('_grid', array('model' => $model)); ?>

    </div>

    <div class="span3" id="oims-form">
        <div class="spin" style="display: none;"><?php echo CHtml::image(CHtml::asset(Yii::app()->basePath . '/../www/images/loader.gif')); ?></div>
        <div class="content"></div>
    </div>

</div>
