<?php


namespace app\controllers;


use app\controllers\actions\day\TestDay;

class DayController extends BaseController
{
    public function actions() {
        return [
            'testWeekend'=>['class'=>TestDay::class, 'test' => '03.11.2019'],
            'calendar'=>['class'=>CalendarDay::class]
        ];
    }
}