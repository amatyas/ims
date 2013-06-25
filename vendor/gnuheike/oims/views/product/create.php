<?php
$this->breadcrumbs[Yii::t('oims','Inv Products')] = array('admin');
$this->breadcrumbs[] = Yii::t('oims', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('oims','Inv Product')?> <small><?php echo Yii::t('oims','Create')?></h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php
$this->renderPartial('_form', array(
'model' => $model,
'buttons' => 'create'));

?>

