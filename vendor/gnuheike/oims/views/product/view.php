<?php
$this->breadcrumbs[Yii::t('oims','Inv Products')] = array('admin');
$this->breadcrumbs[] = $model->id;
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('oims','Inv Product')?> <small><?php echo Yii::t('oims','View')?> #<?php echo $model->id ?></small></h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<h2>
    <?php echo Yii::t('oims','Data')?></h2>

<p>
    <?php
    $this->widget('TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
            'id',
        'sku',
        'name',
        'short_description',
        'description',
        'is_in_stock',
        'items_in_stock',
        'wholesale_price',
        'wholesale_special_price',
        'retail_price',
        'retail_special_price',
        'special_price_start',
        'special_price_end',
        'manufacturer',
        'last_update_date',
        'is_published',
        'is_validated',
        'supplier_id',
        array(
            'name'=>'category_id',
            'value'=>($model->category !== null)?'<span class=label>CBelongsToRelation</span><br/>'.CHtml::link($model->category->name, array('invProductCategory/view','id'=>$model->category->id), array('class'=>'btn')):'n/a',
            'type'=>'html',
        ),
),
        )); ?></p>


<h2>
    <?php echo Yii::t('oims','Relations')?></h2>

