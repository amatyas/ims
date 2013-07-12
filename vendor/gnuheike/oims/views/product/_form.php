<?php
$this->widget('echosen.EChosen', array('target' => 'select'));
$this->widget('WNotificator');
$form = $this->beginWidget('TbActiveOimsForm', array(
    'id' => 'inv-product-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'inlineErrors' => true,
    'htmlOptions' => array(
        'onsubmit' => "return false;",
        'data-plus-as-tab' => 'true',
        //'onkeypress' => " if(event.keyCode == 13){ send_product_form(); return false;};  ",
        'action' => Yii::app()->createUrl("/oims/product/update", array('id' => $model->id)),
    )
        )
);
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('oims.js') . DS . 'emulatetab.joelpurra.js'));
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('oims.js') . DS . 'plusastab.joelpurra.js'));
echo $form->errorSummary($model);
?>


<fieldset>
    <legend><?php echo $model->name; ?></legend>    

    <div >
        <?php echo $form->textFieldRow($model, 'sku', array('hint' => $model->getHint('sku'))); ?>
        <?php echo $form->textFieldRow($model, 'name', array('hint' => $model->getHint('sku'))); ?>
        <?php echo $form->textFieldRow($model, 'manufacturer', array('hint' => $model->getHint('manufacturer'))); ?>
        <label for="category"><?php echo Yii::t('OimsModule.oims', 'Category'); ?></label>
        <?php
        $this->widget(
                'Relation', array(
            'model' => $model,
            'relation' => 'category',
            'fields' => 'name',
            'allowEmpty' => 'true',
            'style' => 'dropdownlist',
            'htmlOptions' => array(
                'checkAll' => 'all'),
                )
        )
        ?>
        <?php echo $form->textFieldRow($model, 'wholesale_price', array('hint' => $model->getHint('wholesale_price'))); ?>
        <?php echo $form->textFieldRow($model, 'retail_price', array('hint' => $model->getHint('retail_price'))); ?>
        <?php echo $form->textFieldRow($model, 'retail_special_price', array('hint' => $model->getHint('retail_special_price'))); ?>    
        <?php echo $form->textFieldRow($model, 'wholesale_special_price', array('hint' => $model->getHint('retail_special_price'))); ?>
        <?php echo $form->checkBoxRow($model, 'is_in_stock', array('hint' => $model->getHint('is_in_stock'))); ?>
        <?php echo $form->textFieldRow($model, 'items_in_stock', array('hint' => $model->getHint('items_in_stock'))); ?>
        <?php echo $form->checkBoxRow($model, 'is_published', array('hint' => $model->getHint('is_published'))); ?>    
        <?php echo $form->textAreaRow($model, 'short_description', array('data-plus-as-tab' => 'false'), array('hint' => $model->getHint('short_description'))); ?>
        <?php echo $form->redactorRow($model, 'description', array('data-plus-as-tab' => 'false'), array('hint' => $model->getHint('description'), 'htmlOptions' => array('data-plus-as-tab' => 'false'))); ?>
    </div>
    <?php
    $this->widget('GalleryManager', array(
        'gallery' => $model->galleryBehavior->getGallery(),
        'controllerRoute' => '/oims/gallery',
        'id' => uniqid(),
    ));
    ?>
</fieldset>



</div> <!-- main inputs -->


<div class="span4"> <!-- sub inputs -->

</div> <!-- sub inputs -->

<div class="form-actions">
    <?php
    echo CHtml::submitButton(Yii::t('OimsModule.oims', 'Save'), array(
        'class' => 'btn btn-primary submit-btn',
        'onclick' => 'send_product_form();',
        'id' => uniqid(),
    ));
    ?>
</div>

<?php $this->endWidget() ?>
</div> <!-- form -->