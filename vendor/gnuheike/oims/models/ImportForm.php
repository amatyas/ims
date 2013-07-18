<?php

/**
 * This is the model class for the upload form.
 * 
 * @property CUploadedFile $importFile 
 */
class ImportForm extends CFormModel {

    public $importFile;
    //Key in model, value in file
    private static $attributeNamesMap = array(
        'sku' => 'sku',
        'name' => 'name',
        'short_description' => 'short_description',
        'description' => 'description',
        'is_in_stock' => 'is_in_stock',
        'items_in_stock' => 'items_in_stock',
        'wholesale_price' => 'wholesale_price',
        'wholesale_special_price' => 'wholesale_special_price',
        'retail_price' => 'retail_price',
        'retail_special_price' => 'retail_special_price',
        'manufacturer' => 'manufacturer',
        //'last_update_date' => 11,
        'is_published' => 'is_published',
        'category_id' => 'category_id'
    );

    public function rules() {
        return array(
            array('importFile', 'file', 'types' => 'xls, xlsx, csv'),
        );
    }

    /**
     * Extracts data from XLS file
     * @return type
     */
    public function extractXls() {
        Yii::import('vendor.kogan.yexcel.Yexcel');
        $xlsImporter = new Yexcel();
        return $xlsImporter->readActiveSheet($this->importFile->tempName);
    }

    /**
     * Extracts data from csv file
     * @return type
     * @throws CException
     */
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

    /**
     * Imports data from file
     * @return type
     */
    function import() {
        if ('text/csv' == $this->importFile->type)
            $data = $this->extractCsv();
        else
            $data = $this->extractXls();

        $attributeMap = $productMap = $this->getAttributeMap($data);

        $errors = $this->checkRequiredAttributes($productMap);
        if (true !== $errors)
            return $errors;
        else
            $errors = array();

        unset($productMap['sku']);

        foreach ($data as $id => $row) {

            $implRow = implode('', $row);
            if (0 == $id || empty($implRow))
                continue;

            $sku = $row[$attributeMap['sku']];
            $model = InvProduct::model()->findByAttributes(array('sku' => $sku));
            if (null === $model) {
                $model = new InvProduct;
                $model->supplier_id = Yii::app()->user->id;
                $map = $attributeMap;
            } else {
                $map = $productMap;
            }

            foreach ($map as $attributeName => $cellPosition) {
                $model->{$attributeName} = $row[$cellPosition];
            }

            if (!$model->save()) {
                foreach ($model->errors as $attribute => $merrors) {
                    foreach ($merrors as $error) {
                        $errors[] = 'sku:' . $model->sku . ' ' . $error;
                    }
                }
            }
            unset($model);
        }

        return $errors? : true;
    }

    /**
     * Builds attribute map from file (first row)
     * @param type $data
     * @return type
     */
    private function getAttributeMap($data) {
        $map = array();
        $dataHeader = $data[0];
        foreach (self::$attributeNamesMap as $modelAttributename => $fileAttributeName) {
            $cell = array_search($fileAttributeName, $dataHeader);
            if (false !== $cell)
                $map[$modelAttributename] = $cell;
        }
        return $map;
    }

    /**
     * 
     * @param type $map
     * @return type
     */
    private function checkRequiredAttributes($map) {
        $required = array();
        $errors = array();
        foreach (InvProduct::model()->getValidators() as $validator) {
            if ($validator instanceof CRequiredValidator)
                $required = array_merge($validator->attributes, $required);
        }
        unset($required[array_search('supplier_id', $required)]);
        foreach (array_diff($required, array_keys($map)) as $error) {
            $errors[] = Yii::t('oims', '{name} is required field in the file header', array('{name}' => $error));
        }
        return $errors? : true;
    }

}

?>
