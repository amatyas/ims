<?php
$this->widget('echosen.EChosen', array('target' => 'select')
);
?>

<?php
$form = $this->beginWidget('TbActiveForm', array(
    'id' => 'inv-product-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'onsubmit' => "return false;",
        'onkeypress' => " if(event.keyCode == 13){ send_product_form(); return false;};  ",
        'action' => Yii::app()->createUrl("/oims/product/update", array('id' => $model->id)),
    )
        )
);

echo $form->errorSummary($model);
?>


<fieldset>
    <legend><?php echo $model->name; ?></legend>
    <?php
    $this->widget('TbAlert', array(
        'block' => false, // display a larger alert block?
        'fade' => true, // use transitions?
        'closeText' => '&times;', // close link text - if set to false, no close link is displayed
        'alerts' => array(// configurations per alert type
            'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
        )
    ));
    ?>


    <?php echo $form->textFieldRow($model, 'sku', array('hint' => $model->getHint('sku'))); ?>
    <?php echo $form->textFieldRow($model, 'name', array('hint' => $model->getHint('sku'))); ?>
    <?php echo $form->textAreaRow($model, 'short_description', array(), array('hint' => $model->getHint('short_description'))); ?>
    <?php echo $form->redactorRow($model, 'description', array(), array('hint' => $model->getHint('description'))); ?>
    <?php echo $form->checkBoxRow($model, 'is_in_stock', array('hint' => $model->getHint('is_in_stock'))); ?>
    <?php echo $form->textFieldRow($model, 'wholesale_price', array('hint' => $model->getHint('wholesale_price'))); ?>
    <?php echo $form->textFieldRow($model, 'retail_price', array('hint' => $model->getHint('retail_price'))); ?>
    <?php echo $form->textFieldRow($model, 'retail_special_price', array('hint' => $model->getHint('retail_special_price'))); ?>
    <?php
    echo $form->datepickerRow($model, 'special_price_start', array(
        'hint' => $model->getHint('special_price_start'),
        'prepend' => '<i class="icon-calendar"></i>',
        'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
        'options' => array(
            'format' => 'yyyy-mm-dd'
        )
    ));
    ?>
    <?php
    echo $form->datepickerRow($model, 'special_price_end', array(
        'hint' => $model->getHint('special_price_end'),
        'prepend' => '<i class="icon-calendar"></i>',
        'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
        'options' => array(
            'format' => 'yyyy-mm-dd'
        )
    ));
    ?>
    <?php echo $form->textFieldRow($model, 'manufacturer', array('hint' => $model->getHint('manufacturer'))); ?>
    <?php echo $form->checkBoxRow($model, 'is_published', array('hint' => $model->getHint('is_published'))); ?>
    <?php echo $form->checkBoxRow($model, 'is_validated', array('hint' => $model->getHint('is_validated'))); ?>   
    <label for="category"><?php echo Yii::t('OimsModule.oims', 'Category'); ?></label>
    <?php
    $this->widget(
            'Relation', array(
        'model' => $model,
        'relation' => 'category',
        'fields' => 'name',
        'allowEmpty' => true,
        'style' => 'dropdownlist',
        'htmlOptions' => array(
            'checkAll' => 'all'),
            )
    )
    ?>
    <?php
    $this->widget('GalleryManager', array(
        'gallery' => $model->galleryBehavior->getGallery(),
        'controllerRoute' => '/oims/gallery'
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