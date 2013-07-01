<?php

/**
 * This is the model base class for the table "inv_product".
 *
 * Columns in table "inv_product" available as properties of the model:
 * @property integer $id
 * @property string $sku
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property integer $is_in_stock
 * @property integer $items_in_stock
 * @property string $wholesale_price
 * @property string $wholesale_special_price
 * @property string $retail_price
 * @property string $retail_special_price
 * @property string $manufacturer
 * @property string $last_update_date
 * @property integer $is_published
 * @property integer $is_validated
 * @property integer $supplier_id
 * @property integer $category_id
 *
 * Relations of table "inv_product" available as properties of the model:
 * @property InvProductCategory $category
 * @property InvProductImage[] $invProductImages
 */
abstract class BaseInvProduct extends CActiveRecord {

    public $details;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'inv_product';
    }

    public function rules() {
        return array_merge(
                parent::rules(), array(
            array('sku, name, description, is_in_stock, wholesale_price, retail_price, manufacturer, supplier_id', 'required'),
            array('sku', 'unique', 'message' => Yii::t('oims', 'This sku already exists.')),
            array('short_description, items_in_stock, wholesale_special_price, retail_special_price, is_published, is_validated, category_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('items_in_stock, wholesale_price, retail_price, wholesale_special_price, retail_special_price', 'numerical', 'min' => 0),
            array('is_in_stock, items_in_stock, is_published, is_validated, supplier_id, category_id', 'numerical', 'integerOnly' => true),
            array('wholesale_price, retail_price, wholesale_special_price, retail_special_price', 'type', 'type' => 'float'),
            array('sku, name, manufacturer', 'length', 'max' => 255),
            array('wholesale_price, retail_special_price', 'length', 'max' => 15),
            array('short_description', 'safe'),
            array('id, sku, name, short_description, description, is_in_stock, items_in_stock, wholesale_price, wholesale_special_price, retail_price, retail_special_price, manufacturer, last_update_date, is_published, is_validated, supplier_id, category_id', 'safe', 'on' => 'search'),
                )
        );
    }

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
            'savedRelated' => array(
                'class' => 'gii-template-collection.components.CSaveRelationsBehavior'
            ),
        ));
    }

    public function relations() {
        return array(
            'category' => array(self::BELONGS_TO, 'InvProductCategory', 'category_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('OimsModule.oims', 'ID'),
            'sku' => Yii::t('OimsModule.oims', 'Sku'),
            'name' => Yii::t('OimsModule.oims', 'Name'),
            'short_description' => Yii::t('OimsModule.oims', 'Short Description'),
            'description' => Yii::t('OimsModule.oims', 'Description'),
            'is_in_stock' => Yii::t('OimsModule.oims', 'Is In Stock'),
            'items_in_stock' => Yii::t('OimsModule.oims', 'Items In Stock'),
            'wholesale_price' => Yii::t('OimsModule.oims', 'Wholesale Price'),
            'wholesale_special_price' => Yii::t('OimsModule.oims', 'Wholesale Special Price'),
            'retail_price' => Yii::t('OimsModule.oims', 'Retail Price'),
            'retail_special_price' => Yii::t('OimsModule.oims', 'Retail Special Price'),
            'manufacturer' => Yii::t('OimsModule.oims', 'Manufacturer'),
            'last_update_date' => Yii::t('OimsModule.oims', 'Last Update Date'),
            'is_published' => Yii::t('OimsModule.oims', 'Is Published'),
            'is_validated' => Yii::t('OimsModule.oims', 'Is Validated'),
            'supplier_id' => Yii::t('OimsModule.oims', 'Supplier'),
            'category_id' => Yii::t('OimsModule.oims', 'Category'),
            'category' => Yii::t('OimsModule.oims', 'Category'),
        );
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
        $criteria->compare('t.supplier_id', $this->supplier_id);
        $criteria->compare('t.category_id', $this->category_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
    }

    public function beforeSave() {
        $this->last_update_date = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

}
