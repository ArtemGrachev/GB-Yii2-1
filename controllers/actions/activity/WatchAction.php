<?php


namespace app\controllers\actions\activity;


use app\components\ActivityComponent;
use app\controllers\actions\BaseAction;
use app\models\Activity;

class WatchAction extends BaseAction
{
    public function run() {
        $comp=\Yii::createObject(['class'=>ActivityComponent::class,'modelClass' => Activity::class]);
        $model = $comp->getModel();
        $id = Yii::$app->request->get('id');
        return $this->controller->render('watch',['id'=>$id]);
    }
}