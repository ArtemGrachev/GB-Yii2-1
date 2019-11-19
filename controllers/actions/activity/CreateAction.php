<?php


namespace app\controllers\actions\activity;


use app\components\ActivityComponent;
use app\controllers\actions\BaseAction;
use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class CreateAction extends BaseAction
{
    public function run()
    {
        $comp=\Yii::createObject(['class'=>ActivityComponent::class,'modelClass' => Activity::class]);
        $model = $comp->getModel();
        if (\Yii::$app->request->isPost) { // Есть полученные данные
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->request->isAjax){ // ajax-валидация
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($idAct = \Yii::$app->activity->createActivity($model)) {
                return $this->controller->render('watch',['model'=>$model, 'repeatValues' => $model::REPEAT_VALUES, 'id' => $idAct]);
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->controller->render('create', ['model' => $model, 'repeatValues' => $model::REPEAT_VALUES]);
    }
}
