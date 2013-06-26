<?php

Yii::import('bootstrap.widgets.TbGridView');
Yii::import('bootstrap.widgets.TbExtendedFilter');

/**
 * Description of TbExtendedSummaryGrid
 *
 * @author gnuheike
 */
class TbExtendedSummaryGrid extends TbExtendedGridView {

    /**
     * We need this attribute in order to fire the saved filter.
     * In fact, you could remove its requirement from TbExtendedFilter but
     * we thought is better to provide 'less' magic.
     */
    public $redirectRoute;

    public function renderTableHeader() {
        if (!$this->hideHeader) {
            // Heads up! We are going to display our filter here
            $this->renderExtendedFilter();
            if ($this->filterPosition === self::FILTER_POS_HEADER)
                $this->renderFilter();

            echo "<tr>\n";
            foreach ($this->columns as $column)
                $column->renderHeaderCell();
            echo "</tr>\n";

            if ($this->filterPosition === self::FILTER_POS_BODY)
                $this->renderFilter();

            echo "</thead>\n";
        }
        elseif ($this->filter !== null && ($this->filterPosition === self::FILTER_POS_HEADER || $this->filterPosition === self::FILTER_POS_BODY)) {
            echo "<thead>\n";
            // Heads up! We are going to display our filter here
            $this->renderExtendedFilter();
            $this->renderFilter();
            echo "</thead>\n";
        }
    }

    protected function renderExtendedFilter() {
        // at the moment it only works with instances of CActiveRecord
        if (!$this->filter instanceof CActiveRecord) {
            return false;
        }
        $extendedFilter = Yii::createComponent(array(
                    'class' => 'TbExtendedFilter',
                    'model' => $this->filter,
                    'grid' => $this,
                    'redirectRoute' => $this->redirectRoute //ie: array('/report/index', 'ajax'=>$this->id)
        ));

        $extendedFilter->init();
        $extendedFilter->run();
    }

    /**
     * ### .renderTableRow()
     *
     * Renders a table body row.
     *
     * @param integer $row the row number (zero-based).
     */
    public function renderTableRow($row) {
        $data = $this->dataProvider->data[$row];
        $htmlOptions = array(
            'id' => 'product_' . $data->id,
            'class' => 'product-grid-tr-trigger',
            'data-update-url' => Yii::app()->createUrl('/oims/product/update', array('id' => $data->id))
        );

        if ($this->rowHtmlOptionsExpression !== null) {
            $data = $this->dataProvider->data[$row];
            $options = $this->evaluateExpression(
                    $this->rowHtmlOptionsExpression, array('row' => $row, 'data' => $data)
            );
            if (is_array($options)) {
                $htmlOptions = $options;
            }
        }

        if ($this->rowCssClassExpression !== null) {
            $data = $this->dataProvider->data[$row];
            $class = $this->evaluateExpression($this->rowCssClassExpression, array('row' => $row, 'data' => $data));
        } elseif (is_array($this->rowCssClass) && ($n = count($this->rowCssClass)) > 0) {
            $class = $this->rowCssClass[$row % $n];
        }

        if (!empty($class)) {
            if (isset($htmlOptions['class'])) {
                $htmlOptions['class'] .= ' ' . $class;
            } else {
                $htmlOptions['class'] = $class;
            }
        }

        echo CHtml::openTag('tr', $htmlOptions) . "\n";
        foreach ($this->columns as $column) {
            echo $this->displayExtendedSummary && !empty($this->extendedSummary['columns']) ? $this->parseColumnValue(
                            $column, $row
                    ) : $column->renderDataCell($row);
        }

        echo "</tr>\n";
    }

}

?>
