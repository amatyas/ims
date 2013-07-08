<?php
$this->breadcrumbs[] = Yii::t('OimsModule.oims', 'Import');
Yii::app()->clientScript->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('oims') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'admin.js'));
$this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs));
?>

<h1>
    <?php echo Yii::t('OimsModule.oims', 'Stock'); ?> <small><?php echo Yii::t('OimsModule.oims', 'Import'); ?></small>
</h1>

<div class="row-fluid">

    <?php
    $form = $this->beginWidget('TbActiveOimsForm', array(
        'id' => 'inv-product-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'inlineErrors' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
            )
    );
    echo $form->errorSummary($model);
    ?>
    <fieldset>
        <?php echo $form->fileFieldRow($model, 'importFile', array('hint' => Yii::t('OimsModule.oims', 'Excel or CSV files.'))); ?>
    </fieldset>

    <div class="form-actions">
        <?php
        echo CHtml::submitButton(Yii::t('OimsModule.oims', 'Submit'), array(
            'class' => 'btn btn-primary submit-btn',
        ));
        ?>
    </div>
    <?php $this->endWidget() ?>
</div>
