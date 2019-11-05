<?php


namespace app\controllers\actions\day;


use app\components\DayComponent;
use app\models\Day;
use yii\base\Action;

class TestDay extends Action
{
    public $test;
    public function run()
    {
        $day = new Day((['date'=>$this->test]));
        $model = new DayComponent();
        $date = $model->getDate($day);
        $isWeekend = $model->isWeekend($day);

        return $this->controller->render('test', ['date' => $date, 'isWeekend' => $isWeekend]);
    }
}