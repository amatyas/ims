<?php

/**
 * This is the model class for the upload form.
 * 
 * @property CUploadedFile $importFile 
 */
class ImportForm extends CFormModel {

    public $importFile;
    private static $attributeMap = array(
        'sku' => 0,
        'name' => 1,
        'short_description' => 2,
        'description' => 3,
        'is_in_stock' => 4,
        'items_in_stock' => 5,
        'wholesale_price' => 6,
        'wholesale_special_price' => 7,
        'retail_price' => 8,
        'retail_special_price' => 9,
        'manufacturer' => 10,
        //'last_update_date' => 11,
        'is_published' => 12,
        'category_id' => 13
    );

    public function rules() {
        return array(
            array('importFile', 'file', 'types' => 'xls, xlsx, csv'),
        );
    }

    public function extractXls() {
        Yii::import('vendor.kogan.yexcel.Yexcel');
        $xlsImporter = new Yexcel();
        return $xlsImporter->readActiveSheet($this->importFile->tempName);
    }

    public function extractCsv() {
        $return = array();
        if (($handle = fopen($this->importFile->tempName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);      
                $row = array();
                for ($c = 0; $c < $num; $c++) {
                    $row[] = $data[$c];
                }
                $return[] = $row;
            }
            return $return;
        }
        else
            throw new CException('Cannot open csv file for reading.');
    }

    function import() {
        if ('text/csv' == $this->importFile->type)
            $data = $this->extractCsv();
        else
            $data = $this->extractXls();

        $productMap = self::$attributeMap;
        unset($productMap['sku']);
        foreach ($data as $row) {
            if (empty($row[0]) || ('sku' == strtolower($row[0]) && 'name' == strtolower($row[1])))
                continue;

            $sku = $row[self::$attributeMap['sku']];
            $model = InvProduct::model()->findByAttributes(array('sku' => $sku));
            if (null === $model) {
                $model = new InvProduct;
                $model->supplier_id = Yii::app()->user->id;
                $map = self::$attributeMap;
            } else {
                $map = $productMap;
            }
            foreach ($map as $attribute => $arrayCellId)
                $model->{$attribute} = $row[$arrayCellId];



            if (!$model->save()) {
                var_dump($model->errors);
                die;
            }


            $model = null;
            unset($model);
        }
        return true;
    }

}

?>
