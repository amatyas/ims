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
                    "label" => Yii::t("crud", "Create"),
                    "icon" => "icon-plus",
                    "url" => "javascript:void(0);",
                    'htmlOptions' => array(
                        "onclick" => "load_crud_product_form('" . Yii::app()->createUrl('/oims/product/create') . "')",
                    ),                    
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

