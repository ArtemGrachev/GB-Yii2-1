<?php


namespace app\controllers\actions\day;


use app\components\DayComponent;
use app\controllers\actions\BaseAction;
use app\models\Day;

class IndexAction extends BaseAction
{
    public $test;
    public function run()
    {
        $day = new Day((['date'=>$this->test]));
        $model = new DayComponent();
        $date = $model->getDate($day);
        $isWeekend = $model->isWeekend($day);
        $titleDay = $model->titleDay($day);

        return $this->controller->render('test', ['date' => $date, 'isWeekend' => $isWeekend, 'titleDay' => $titleDay]);
    }
}