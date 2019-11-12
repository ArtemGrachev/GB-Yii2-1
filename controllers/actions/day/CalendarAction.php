<?php


namespace app\controllers\actions\day;


use app\components\DayComponent;
use app\controllers\actions\BaseAction;
use app\models\Day;

class CalendarAction extends BaseAction
{
    public function run()
    {
        $thisYear =
        $day = new Day((['date'=>$this->test]));
        $model = new DayComponent();
        $date = $model->getDate($day);
        $isWeekend = $model->isWeekend($day);

        return $this->controller->render('test', ['date' => $date, 'isWeekend' => $isWeekend]);
    }
}