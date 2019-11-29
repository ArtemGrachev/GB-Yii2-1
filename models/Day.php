<?php


namespace app\models;


use app\components\DayComponent;

class Day extends Base
{
    public function init()
    {
        parent::init();
        $this->component->testDate($this);
    }
    
    public $component;
    public $date;
    public $timestampStart;
    public $timestampFinish;
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