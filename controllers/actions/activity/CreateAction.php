<?php


namespace app\controllers\actions\activity;


use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;

class CreateAction extends Action
{
    public $name;
    public function run()
    {
        $comp=\Yii::createObject(['class'=>ActivityComponent::class,'modelClass' => Activity::class]);
        $model = $comp->getModel();
        if (\Yii::$app->request->isPost) { // Есть полученные данные
            $model->load(\Yii::$app->request->post());
            $success = \Yii::$app->activity->addActivity($model);
            if ($success) { // Обработка успешная
            }
        }
        return $this->controller->render('create', ['name' => $this->name, 'model' => $model, 'success' => $success]);
    }
}
{

}