<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;

class ActivityComponent extends BaseComponent
{
    public function init()
    {
        parent::init();
        //todo f
    }
    public function addActivity(Activity $activity): bool
    {
//        $activity->title = null;
        if ($activity->validate()) {
            return true;
        }
        return false;
    }
}