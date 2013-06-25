<?php

/**
 * This is the model base class for the table "inv_product_image".
 *
 * Columns in table "inv_product_image" available as properties of the model:
 * @property integer $int
 * @property string $image_path
 * @property string $thumb_path
 * @property integer $product_id
 * @property integer $display_order
 *
 * Relations of table "inv_product_image" available as properties of the model:
 * @property InvProduct $product
 */
abstract class BaseInvProductImage extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'inv_product_image';
    }

    public function rules() {
        return array_merge(
                parent::rules(), array(
            array('image_path, thumb_path', 'required'),
            array('display_order', 'default', 'setOnEmpty' => true, 'value' => null),
            array('display_order', 'numerical', 'integerOnly' => true),
            array('image_path, thumb_path', 'length', 'max' => 255),
            array('int, image_path, thumb_path, product_id, display_order', 'safe', 'on' => 'search'),
                )
        );
    }

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
            'savedRelated' => array(
                'class' => 'gii-template-collection.components.CSaveRelationsBehavior'
            )
                )
        );
    }

    public function relations() {
        return array(
            'product' => array(self::BELONGS_TO, 'InvProduct', 'product_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'int' => Yii::t('oims', 'Int'),
            'image_path' => Yii::t('oims', 'Image Path'),
            'thumb_path' => Yii::t('oims', 'Thumb Path'),
            'product_id' => Yii::t('oims', 'Product'),
            'display_order' => Yii::t('oims', 'Display Order'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.int', $this->int);
        $criteria->compare('t.image_path', $this->image_path, true);
        $criteria->compare('t.thumb_path', $this->thumb_path, true);
        $criteria->compare('t.product_id', $this->product_id);
        $criteria->compare('t.display_order', $this->display_order);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
