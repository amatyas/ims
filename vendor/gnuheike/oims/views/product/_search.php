<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'sku'); ?>
        <?php echo $form->textField($model, 'sku', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'short_description'); ?>
        <?php echo $form->textArea($model, 'short_description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'is_in_stock'); ?>
        <?php echo $form->checkBox($model, 'is_in_stock'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'items_in_stock'); ?>
        <?php echo $form->textField($model, 'items_in_stock'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'wholesale_price'); ?>
        <?php echo $form->textField($model, 'wholesale_price', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'wholesale_special_price'); ?>
        <?php echo $form->textField($model, 'wholesale_special_price', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'retail_price'); ?>
        <?php echo $form->textField($model, 'retail_price', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'retail_special_price'); ?>
        <?php echo $form->textField($model, 'retail_special_price', array('size' => 15, 'maxlength' => 15)); ?>
    </div>                   

    <div class="row">
        <?php echo $form->label($model, 'manufacturer'); ?>
        <?php echo $form->textField($model, 'manufacturer', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'last_update_date'); ?>
        <?php echo $form->textField($model, 'last_update_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'is_published'); ?>
        <?php echo $form->checkBox($model, 'is_published'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'is_validated'); ?>
        <?php echo $form->checkBox($model, 'is_validated'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'supplier_id'); ?>
        <?php echo $form->textField($model, 'supplier_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'category_id'); ?>
        <?php echo $form->dropDownList($model, 'category_id', CHtml::listData(InvProductCategory::model()->findAll(), 'id', 'name'), array('prompt' => 'all')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('OimsModule.oims', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
