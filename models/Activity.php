<?php


namespace app\models;


class Activity extends Base
{
    public $title;
    public $description;
    public $date;
    public $timeStart;
    public $timeFinish;
    public $isBlocked;
    public $repeat;
//    public $errors;
    public function rules()
    {
        return [
            ['title','required'],
            ['description','string','max' => 250],
            ['date','string'],
            ['timeStart','string'],
            ['timeFinish','string'],
            ['isBlocked','boolean'],
            ['repeat','string']
        ];
    }
    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок',
            'description'=>'Описание',
            'date'=>'Дата',
            'timeStart'=>'Время начала',
            'timeFinish'=>'Время окончания',
            'isBlocked'=>'Блокирующее событие',
            'repeat'=>'Повторяется'
        ];
    }
}