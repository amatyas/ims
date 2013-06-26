<?php

class ProductController extends Controller {
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view'),
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

        $this->performAjaxValidation($model, 'inv-product-form');

        if (isset($_POST['InvProduct'])) {
            $model->attributes = $_POST['InvProduct'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }
        } elseif (isset($_GET['InvProduct'])) {
            $model->attributes = $_GET['InvProduct'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'inv-product-form');

        if (isset($_POST['InvProduct'])) {
            $model->attributes = $_POST['InvProduct'];

            try {
                if ($model->save() !Yii::app()->request->isAjaxRequest) {
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

    public function actionEditableSaver() {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('InvProduct');  // classname of model to be updated
        $es->update();
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
            throw new CHttpException(400, Yii::t('oims', 'Invalid request. Please do not repeat this request again.'));
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

    public function loadModel($id) {
        $model = InvProduct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('oims', 'The requested page does not exist.'));
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'inv-product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
