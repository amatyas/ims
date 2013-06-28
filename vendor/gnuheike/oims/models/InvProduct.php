<?php

// auto-loading
Yii::setPathOfAlias('InvProduct', dirname(__FILE__));
Yii::import('InvProduct.*');

class InvProduct extends BaseInvProduct {

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        return parent::init();
    }

    public function get_label() {
        return (string) $this->sku;
    }

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
            'galleryBehavior' => array(
                'class' => 'GalleryBehavior',
                'idAttribute' => 'id',
                'versions' => array(
                    'small' => array(
                        'centeredpreview' => array(98, 98),
                    ),
                    'medium' => array(
                        'resize' => array(800, null),
                    )
                ),
                'name' => true,
                'description' => true,
            )
        ));
    }

    public function rules() {
        return array_merge(
                parent::rules()
                /* , array(
                  array('column1, column2', 'rule1'),
                  array('column3', 'rule2'),
                  ) */
        );
    }

    public function getHint($name) {
        return '';//("help.{$name}" != $help = Yii::t('oims.{$name}', "help.")) ? $help : null;
    }

    public function isAttributeSafe($attribute) {
        return ('discount' == $attribute || 'category' == $attribute ) ? true : parent::isAttributeSafe($attribute);
    }

    public function getDiscount() {
        return 1;
    }

    public function getCategoryToString() {
        return isset($this->category->name) ? $this->category->name : 'Empty';
    }

}
