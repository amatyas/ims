<div class="">
    <p class="alert">
        <?php echo Yii::t('oims', 'Fields with <span class="required">*</span> are required.'); ?> 
    </p>


    <?php
    $this->widget('echosen.EChosen', array('target' => 'select')
    );
    ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'inv-product-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));

    echo $form->errorSummary($model);
    ?>
    <div class="row">
        <div class="span8"> <!-- main inputs -->


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'sku'); ?>

                    <?php echo $form->textField($model, 'sku', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'sku'); ?>
                    <?php
                    if ('help.sku' != $help = Yii::t('oims', 'help.sku')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'name'); ?>
                    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'name'); ?>
                    <?php
                    if ('help.name' != $help = Yii::t('oims', 'help.name')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'short_description'); ?>
                    <?php echo $form->textArea($model, 'short_description', array('rows' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($model, 'short_description'); ?>
                    <?php
                    if ('help.short_description' != $help = Yii::t('oims', 'help.short_description')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'description'); ?>
                    <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($model, 'description'); ?>
                    <?php
                    if ('help.description' != $help = Yii::t('oims', 'help.description')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'is_in_stock'); ?>
                    <?php echo $form->checkBox($model, 'is_in_stock'); ?>
                    <?php echo $form->error($model, 'is_in_stock'); ?>
                    <?php
                    if ('help.is_in_stock' != $help = Yii::t('oims', 'help.is_in_stock')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'items_in_stock'); ?>
                    <?php echo $form->textField($model, 'items_in_stock'); ?>
                    <?php echo $form->error($model, 'items_in_stock'); ?>
                    <?php
                    if ('help.items_in_stock' != $help = Yii::t('oims', 'help.items_in_stock')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'wholesale_price'); ?>
                    <?php echo $form->textField($model, 'wholesale_price', array('size' => 15, 'maxlength' => 15)); ?>
                    <?php echo $form->error($model, 'wholesale_price'); ?>
                    <?php
                    if ('help.wholesale_price' != $help = Yii::t('oims', 'help.wholesale_price')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'wholesale_special_price'); ?>
                    <?php echo $form->textField($model, 'wholesale_special_price', array('size' => 15, 'maxlength' => 15)); ?>
                    <?php echo $form->error($model, 'wholesale_special_price'); ?>
                    <?php
                    if ('help.wholesale_special_price' != $help = Yii::t('oims', 'help.wholesale_special_price')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'retail_price'); ?>
                    <?php echo $form->textField($model, 'retail_price', array('size' => 15, 'maxlength' => 15)); ?>
                    <?php echo $form->error($model, 'retail_price'); ?>
                    <?php
                    if ('help.retail_price' != $help = Yii::t('oims', 'help.retail_price')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'retail_special_price'); ?>
                    <?php echo $form->textField($model, 'retail_special_price', array('size' => 15, 'maxlength' => 15)); ?>
                    <?php echo $form->error($model, 'retail_special_price'); ?>
                    <?php
                    if ('help.retail_special_price' != $help = Yii::t('oims', 'help.retail_special_price')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'special_price_start'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'special_price_start',
                        'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
                        'htmlOptions' => array('size' => 10),
                        'options' => array(
                            'showButtonPanel' => true,
                            'changeYear' => true,
                            'changeYear' => true,
                            'dateFormat' => 'yy-mm-dd',
                        ),
                            )
                    );
                    ;
                    ?>
                    <?php echo $form->error($model, 'special_price_start'); ?>
                    <?php
                    if ('help.special_price_start' != $help = Yii::t('oims', 'help.special_price_start')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'special_price_end'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'special_price_end',
                        'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
                        'htmlOptions' => array('size' => 10),
                        'options' => array(
                            'showButtonPanel' => true,
                            'changeYear' => true,
                            'changeYear' => true,
                            'dateFormat' => 'yy-mm-dd',
                        ),
                            )
                    );
                    ;
                    ?>
                    <?php echo $form->error($model, 'special_price_end'); ?>
                    <?php
                    if ('help.special_price_end' != $help = Yii::t('oims', 'help.special_price_end')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'manufacturer'); ?>
                    <?php echo $form->textField($model, 'manufacturer', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'manufacturer'); ?>
                    <?php
                    if ('help.manufacturer' != $help = Yii::t('oims', 'help.manufacturer')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'last_update_date'); ?>
                    <?php echo $form->textField($model, 'last_update_date'); ?>
                    <?php echo $form->error($model, 'last_update_date'); ?>
                    <?php
                    if ('help.last_update_date' != $help = Yii::t('oims', 'help.last_update_date')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'is_published'); ?>
                    <?php echo $form->checkBox($model, 'is_published'); ?>
                    <?php echo $form->error($model, 'is_published'); ?>
                    <?php
                    if ('help.is_published' != $help = Yii::t('oims', 'help.is_published')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'is_validated'); ?>
                    <?php echo $form->checkBox($model, 'is_validated'); ?>
                    <?php echo $form->error($model, 'is_validated'); ?>
                    <?php
                    if ('help.is_validated' != $help = Yii::t('oims', 'help.is_validated')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>


            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <?php echo $form->labelEx($model, 'supplier_id'); ?>
                    <?php echo $form->textField($model, 'supplier_id'); ?>
                    <?php echo $form->error($model, 'supplier_id'); ?>
                    <?php
                    if ('help.supplier_id' != $help = Yii::t('oims', 'help.supplier_id')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>
            </div>

            <div class="row-fluid input-block-level-container">
                <div class="span12">
                    <label for="category"><?php echo Yii::t('oims', 'Category'); ?></label>
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
                </div>
            </div>

        </div> <!-- main inputs -->


        <div class="span4"> <!-- sub inputs -->

        </div> <!-- sub inputs -->
    </div>


    <div class="form-actions">

        <?php
        echo CHtml::Button(Yii::t('oims', 'Cancel'), array(
            'submit' => (isset($_GET['returnUrl'])) ? $_GET['returnUrl'] : array('invproduct/admin'),
            'class' => 'btn'
        ));
        echo ' ' . CHtml::submitButton(Yii::t('oims', 'Save'), array(
            'class' => 'btn btn-primary'
        ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->