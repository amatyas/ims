<?php

/**
 * This is the model base class for the table "inv_product_category".
 *
 * Columns in table "inv_product_category" available as properties of the model:
 * @property integer $id
 * @property string $name
 * @property integer $parent_cat_id
 *
 * Relations of table "inv_product_category" available as properties of the model:
 * @property InvProduct[] $invProducts
 * @property InvProductCategory $parentCat
 * @property InvProductCategory[] $invProductCategories
 */
abstract class BaseInvProductCategory extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'inv_product_category';
    }

    public function rules() {
        return array_merge(
                parent::rules(), array(
            array('id, name', 'required'),
            array('parent_cat_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, parent_cat_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('id, name, parent_cat_id', 'safe', 'on' => 'search'),
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
            'products' => array(self::HAS_MANY, 'InvProduct', 'category_id'),
            'parentCat' => array(self::BELONGS_TO, 'InvProductCategory', 'parent_cat_id'),
            'categories' => array(self::HAS_MANY, 'InvProductCategory', 'parent_cat_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('oims', 'ID'),
            'name' => Yii::t('oims', 'Name'),
            'parent_cat_id' => Yii::t('oims', 'Parent Cat'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.parent_cat_id', $this->parent_cat_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
