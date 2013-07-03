<?php

class ProductController extends Controller {
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";

    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
            'eexcelview' => array(
                'class' => 'vendor.zen.EExcelBehavior.EExcelBehavior',
            ),
        ));
    }

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'bootstrap.actions.TbToggleAction',
                'modelName' => 'InvProduct',
            )
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view', 'toggle', 'categories', 'updateProductGrid', 'exportCsv', 'exportPdf','exportXls','multiedit'),
                'roles' => array('Product.*'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        // map identifcationColumn to id
        if (!isset($_GET['id']) && isset($_GET['id'])) {
            $model = InvProduct::model()->find('id = :id', array(
                ':id' => $_GET['id']));
            if ($model !== null) {
                $_GET['id'] = $model->id;
            } else {
                throw new CHttpException(400);
            }
        }
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate() {
        $model = new InvProduct;
        $model->scenario = $this->scenario;
        $model->supplier_id = Yii::app()->user->id;

        $this->performAjaxValidation($model, 'inv-product-form');

        if (isset($_POST['InvProduct'])) {
            $model->attributes = $_POST['InvProduct'];

            try {
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', Yii::t('OimsModule.oims', 'Product created.'));
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('update', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }
        } elseif (isset($_GET['InvProduct'])) {
            $model->attributes = $_GET['InvProduct'];
        }
        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_form', array('model' => $model), false, true);
        else
            $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'inv-product-form');

        if (isset($_POST['InvProduct'])) {
            $model->attributes = $_POST['InvProduct'];

            try {
                if ($model->save()) {
                    $link = CHtml::link('View', '#', array('onclick' => "oims_aplly_filter(['sku','{$model->sku}']);return false;"));
                    Yii::app()->user->setFlash('success', Yii::t('OimsModule.oims', 'Product updated. {link}', array('{link}' => $link)));
                    if (!Yii::app()->request->isAjaxRequest)
                        if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                        } else {
                            $this->redirect(array('view', 'id' => $model->id));
                        }
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }
        }

        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_form', array('model' => $model), false, true);
        else
            $this->render('update', array('model' => $model,));
    }

    public function actionUpdateProductGrid() {
        $es = new EditableSaver('InvProduct');
        $es->onBeforeUpdate = function($event) {
                    if (Yii::app()->user->isGuest) {
                        $event->sender->error('You are not allowed to update data');
                    }
                };

        try {
            $es->update();
        } catch (CException $e) {
            echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
            return;
        }

        echo CJSON::encode(array('success' => true));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        }
        else
            throw new CHttpException(400, Yii::t('OimsModule.oims', 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('InvProduct');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new InvProduct('search');
        $model->unsetAttributes();

        if (isset($_GET['InvProduct'])) {
            $model->attributes = $_GET['InvProduct'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function actionExportCsv() {
        Yii::import('vendor.nsbucky.csvexport.ECSVExport');
        $csv = new ECSVExport(new CActiveDataProvider('InvProduct'));
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile('export.csv', $content, "text/csv", false);
        exit();
    }

    public function actionExportPdf() {
        Yii::import('vendor.gnuheike.pdfexport.PdfExport');
        $pdfExporter = new PdfExport();
        $pdfExporter->getPdfFile(new CActiveDataProvider('InvProduct'));
    }

    public function actionExportXls() {
        Yii::import('vendor.zen.EExcelBehavior.*');
        $criteria = new CDbCriteria;
        $criteria->limit = 500;
        $models = InvProduct::model()->findAll($criteria);
        EExcelView::$phpExcelPathAlias = 'vendor.codeplex.phpexcel.Classes.PHPExcel';
        $this->toExcel($models);        
    }

    public function loadModel($id) {
        $model = InvProduct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('OimsModule.oims', 'The requested page does not exist.'));
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'inv-product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCategories() {
        echo json_encode(CHtml::listData(InvProductCategory::model()->findAll(), 'id', 'name'));
        Yii::app()->end();
    }
    
    public function actionMultiedit() {
        if (empty($_POST)||!isset($_POST['action']))
            throw new CHttpException(404);
        
        $action = $_POST['action'];
        $data = $_POST['params'];
        
        if ('delete'==$action) {
            $id = array_keys($data);
            $criteria = new CDbCriteria;
            $criteria->addInCondition('id', $id);
            InvProduct::model()->deleteAll($criteria);
        } elseif('modify'==$action) {
            foreach ($data as $id => $params) {
                $model = InvProduct::model()->findByPk($id);
                $model->setAttributes($params);
                $model->save();
            }
        }
    }

}
