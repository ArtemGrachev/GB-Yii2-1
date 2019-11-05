<?php


namespace app\controllers;


use app\controllers\actions\day\TestDay;

class DayController extends BaseController
{
    public function actions() {
        return [
            'testWeekend'=>['class'=>TestDay::class, 'test' => '03.11.2019'],
            'testWeekday'=>['class'=>TestDay::class, 'test' => '05.11.2019'],
            'testIncorrect'=>['class'=>TestDay::class, 'test' => '123.456.789']
        ];
    }
}