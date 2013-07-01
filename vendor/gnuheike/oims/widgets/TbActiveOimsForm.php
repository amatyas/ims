<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TbActiveOimsForm
 *
 * @author gnuheike
 */
class TbActiveOimsForm extends TbActiveForm {

    private $errorOptions = array(
        'class' => 'oims-error help-inline error'
    );
    private $_mergeOptions = array(
        'clientOptions' => array('afterValidateAttribute' => "js:function(form, attribute, data, hasError){
            var element = '#inv-product-form #'+this.inputID;
            console.log(element);
            console.log(hasError);
        if (hasError) {   
                jQuery(element).removeClass('success');
                jQuery(element).addClass('error');
        } else        {
                 jQuery(element).removeClass('error');
                jQuery(element).addClass('success');
        }
        }")
    );

    public function init() {
        foreach ($this->_mergeOptions as $optionName => $value)
            $this->{$optionName} = CMap::mergeArray($this->{$optionName}, $value);
        return parent::init();
    }

    /**
     * ### .inputRow()
     *
     * Creates an input row of a specific type.
     *
     * This is a generic factory method. It is mainly called by various helper methods
     *  which pass correct type definitions to it.
     *
     * @param string $type the input type
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $data the data for list inputs
     * @param array $htmlOptions additional HTML attributes
     *
     * @return string the generated row
     */
    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array()) {
        ob_start();
        Yii::app()->controller->widget(
                $this->getInputClassName(), array(
            'type' => $type,
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'htmlOptions' => $htmlOptions,
            'errorOptions' => $this->errorOptions
                )
        );
        echo "\n";
        return ob_get_clean();
    }

}

?>
