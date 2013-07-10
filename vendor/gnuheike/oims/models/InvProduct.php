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
        return ''; //("help.{$name}" != $help = Yii::t('oims.{$name}', "help.")) ? $help : null;
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

    public function afterFind() {
        $this->checkAccess();
        return parent::afterFind();
    }

    public function checkAccess() {
        if (Yii::app()->user->isSuperuser || $this->supplier_id == Yii::app()->user->id)
            return true;

        throw new CHttpException(404, 'You are not authorized to view this product!');
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.sku', $this->sku, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.short_description', $this->short_description, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.is_in_stock', $this->is_in_stock);
        $criteria->compare('t.items_in_stock', $this->items_in_stock);
        $criteria->compare('t.wholesale_price', $this->wholesale_price, true);
        $criteria->compare('t.wholesale_special_price', $this->wholesale_special_price, true);
        $criteria->compare('t.retail_price', $this->retail_price, true);
        $criteria->compare('t.retail_special_price', $this->retail_special_price, true);
        $criteria->compare('t.manufacturer', $this->manufacturer, true);
        $criteria->compare('t.last_update_date', $this->last_update_date, true);
        $criteria->compare('t.is_published', $this->is_published);
        $criteria->compare('t.is_validated', $this->is_validated);
        //$criteria->compare('t.supplier_id', $this->supplier_id);
        $criteria->compare('t.category_id', $this->category_id);

        if (!Yii::app()->user->isSuperuser)
            $criteria->compare('t.supplier_id', Yii::app()->user->id);

        $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        if ($pageSize)
            $pagination = array(
                'pageSize' => $pageSize? : false,
            );
        else
            $pagination = false;

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => $pagination
        ));
    }

}
