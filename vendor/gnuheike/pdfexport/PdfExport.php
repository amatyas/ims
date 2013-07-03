<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RFormatConverter
 *
 * @author gnuheike
 */
class PdfExport {

    const PDF = 'pdf'; 

    public function getPdfFile(CActiveDataProvider $dataProvider) {
        $dataProvider->totalItemCount = 200;
        $array = $this->convertToArray($dataProvider, $header = true);        
        //echo Yii::app()->controller->renderPartial('pdfOut', array('array' => $array));die;
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = file_get_contents(Yii::getPathOfAlias('application.themes.frontend.css') . '/pdf_tablecss.css');
        $mPDF1->WriteHTML($stylesheet, 1);        
        $mPDF1->WriteHTML(Yii::app()->controller->renderPartial('pdfOut', array('array' => $array), true));
        $mPDF1->Output('export.pdf', 'D');
    }

    private function convertToArray(CActiveDataProvider $dataProvider, $header = false) {
        $return = array();
        $head = array();
        $iterator = new CDataProviderIterator($dataProvider);

        foreach ($iterator as $item) {
            $attributes = $item->getAttributes();
            if (empty($head))
                $head = array_keys($attributes);
            $return[] = array_values($attributes);
        }

        return $header ? array_merge(array($head), $return) : $return;
    }

}

?>
