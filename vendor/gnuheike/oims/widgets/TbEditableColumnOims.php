<?php

/**
 * Description of TbEditableColumnOims
 *
 * @author gnuheike
 */
class TbEditableColumnOims extends TbEditableColumn {

    public function init() {
        $this->editable = CMap::mergeArray(
                        $this->editable, array(
                    'url' => Yii::app()->createUrl('/oims/product/updateProductGrid'),
                    'success' => 'js: function(response, newValue) {
                                                            if(!response.success) return response.msg;
                                                          }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                        )
        );
        return parent::init();
    }

}

?>
