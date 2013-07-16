<div id="toolbarHandler">
    <div class="spin"  style="display:none;">
        <?php
        $this->widget('bootstrap.widgets.TbProgress', array(
            'percent' => 100, // the progress
            'striped' => true,
            'animated' => true,
        ));
        ?>
    </div>
    <div class="content">
        <div class="btn-toolbar">
            <div class="btn-group">
                <?php
                switch ($this->action->id) {
                    case "create":
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Manage"),
                            "icon" => "icon-list-alt",
                            "url" => array("admin")
                        ));
                        break;
                    case "admin":
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("oims", "Create"),
                            "icon" => "icon-plus",
                            "url" => "javascript:void(0);",
                            'htmlOptions' => array(
                                "onclick" => "load_crud_product_form('" . Yii::app()->createUrl('/oims/product/create') . "')",
                            ),
                        ));
                        echo CHtml::script('var multirow_edit_url="' . Yii::app()->createUrl('/oims/product/multiedit') . '"');
                        $this->widget('bootstrap.widgets.TbButtonGroup', array(
                            'buttons' => array(
                                array(
                                    'label' => Yii::t("oims", "Multirow Actions"),
                                    "icon" => "icon-th-list",
                                    'htmlOptions' => array('id' => 'ma_quick_actions'),
                                    'items' => array(
                                        array('label' => Yii::t("oims", "All Out of stock"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'modify__is_in_stock__0')),
                                        array('label' => Yii::t("oims", "All In stock"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'modify__is_in_stock__1')),
                                        array('label' => Yii::t("oims", "Publish all"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'modify__is_published__1')),
                                        array('label' => Yii::t("oims", "UnPublish all"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'modify__is_published__0')),
                                        array('label' => Yii::t("oims", "Remove discounts"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'modify__wholesale_special_price__0__retail_special_price__0')),
                                        array('label' => Yii::t("oims", "Delete all"), 'url' => '#', 'htmlOptions' => array('data-modify' => 'delete')),
                                    )),
                            ),
                            'htmlOptions' => array('style' => 'margin-left: 5px;'),
                        ));
                        $this->widget('bootstrap.widgets.TbButtonGroup', array(
                            'buttons' => array(
                                array(
                                    'label' => Yii::t("oims", "Export"),
                                    "icon" => "icon-download",
                                    'items' => array(
                                        array('label' => Yii::t("oims", "Download CSV"), 'url' => $this->createUrl('exportCsv')),
                                        array('label' => Yii::t("oims", "Download PDF"), 'url' => $this->createUrl('exportPdf')),
                                        array('label' => Yii::t("crud", "Download XLS"), 'url' => $this->createUrl('exportXls')),
                                    )),
                            ),
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("oims", "Import"),
                            "icon" => "icon-upload",
                            "url" => $this->createUrl('import'),
                            'htmlOptions' => array(
                                "onclick" => "$('#fileUploadHandler').toggle();return false;"),
                        ));
                        break;
                    case "view":
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Manage"),
                            "icon" => "icon-list-alt",
                            "url" => array("admin")
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Update"),
                            "icon" => "icon-edit",
                            "url" => array("update", "id" => $model->{$model->tableSchema->primaryKey})
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Create"),
                            "icon" => "icon-plus",
                            "url" => array("create")
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Delete"),
                            "type" => "danger",
                            "icon" => "icon-remove icon-white",
                            "htmlOptions" => array(
                                "submit" => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => Yii::app()->request->getParam("returnUrl")),
                                "confirm" => Yii::t("crud", "Do you want to delete this item?"))
                                )
                        );
                        break;
                    case "update":
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Manage"),
                            "icon" => "icon-list-alt",
                            "url" => array("admin")
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "View"),
                            "icon" => "icon-eye-open",
                            "url" => array("view", "id" => $model->{$model->tableSchema->primaryKey})
                        ));
                        $this->widget("bootstrap.widgets.TbButton", array(
                            "label" => Yii::t("crud", "Delete"),
                            "type" => "danger",
                            "icon" => "icon-remove icon-white",
                            "htmlOptions" => array(
                                "submit" => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => Yii::app()->request->getParam("returnUrl")),
                                "confirm" => Yii::t("crud", "Do you want to delete this item?"))
                                )
                        );
                        break;
                }
                ?>    
            </div>
        </div> 
        <div id='fileUploadHandler' style='display: none;'>
            <?php
            $this->widget('bootstrap.widgets.TbFileUpload', array(
                'url' => $this->createUrl('importAjax'),
                'model' => new ImportForm,
                'attribute' => 'importFile', // see the attribute?
                'multiple' => false,
                'previewImages' => false,
                'imageProcessing' => false,
                'formView' => 'oims.views.fileUploadForm',
                'options' => array(
                    'maxFileSize' => 2000000,
                    'acceptFileTypes' => 'js:/(\.|\/)(csv|xls|xlsx)$/i',
                    'maxNumberOfFiles' => 1,
                    'autoUpload' => true,
            )));
            ?>
        </div>
    </div>
</div>