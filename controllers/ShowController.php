<?php

/**
 * 
 */
class ShowController extends Controller {

    public $defaultAction = "show";
    public $scenario = "crud";
    public $scope = "crud";

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array(
                    'Fancybox',
                ),
                'roles' => array('audittrail'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * show fancybox with history
     * @param string $model_name
     * @param int $model_id
     */
    public function actionFancybox($model_name,$model_id) {

        $model = new AuditTrail();
        $model->unsetAttributes();
        $model->model = $model_name;
        $model->model_id = $model_id;

        //perform only autoload
        class_exists($model_name);

        //import module for translations
        Yii::setPathOfAlias($model_name.'Module', Yii::getPathOfAlias($model_name).'/../');
        Yii::import($model_name.'Module.*');
        
        $this->renderpartial(
            'fancybox', array(
            'model' => $model,
            'model_name' => $model_name,
            'model_id' => $model_id,
                )
        );
    }
}