<?php


namespace app\models;


use app\components\DayComponent;

class Day extends Base
{
    public $date;
    //new Day(['date'=>'value'])
    public $timestamp;
    public $dateArr;
    public $activities;
    public $dayOfWeek;
    public $isWeekend;
    public $titleDay;
    public function rules()
    {
        return [
            ['year', 'date', 'format' => 'php:Y']
        ];
    }



}