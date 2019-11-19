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
    public $files;

    const REPEAT_VALUES = [
        'no' => 'Не повторяется',
        'daily' => 'Ежедневно',
        'second' => 'Раз в два дня',
        'weekpart' => 'По будням/по выходным',
        'weekly' => 'Раз в неделю',
        'monthly' => 'Раз в месяц',
        'yearly' => 'Раз в год'
    ];

    public function beforeValidate()
    {
        if (!empty($this->date)) {
            $date = \DateTime::createFromFormat('d.m.Y', $this->date);
            if ($date) {
                $this->date = $date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    /** Правила формы создания или изменения активности
     * @return array
     */
    public function rules()
    {
        return [
            ['title', 'required', 'string', 'trim', 'max' => 30, 'min' => 5, BlackListRule::class, 'enableAjaxValidation' => true,'enableClientValidation' => false],
            ['description', 'string', 'max' => 250, BlackListRule::class, 'enableAjaxValidation' => true,'enableClientValidation' => false],
            ['date', 'required', 'date', 'format' => 'php:Y-m-d'],
            [['timeStart', 'timeFinish'], 'required', 'time', function(){
                if(strtotime($this->timeStart) >= strtotime($this->timeFinish)) {
                    $this->addErrors(['timeStart', 'timeFinish'], 'Время окончания должно быть больше времени начала.');
                }
            }, 'enableAjaxValidation' => true,'enableClientValidation' => false],
            ['isBlocked', 'boolean'],
            ['repeat', 'string', 'in', 'range' => array_keys(self::REPEAT_VALUES)],
            ['dateFinish', 'required', 'date', 'format' => 'php:Y-m-d', function(){
                if (($this->dateStart !== 'no') && (strtotime($this->dateStart) >= strtotime($this->dateFinish))) {
                    $this->addErrors(['dateStart', 'dateFinish'], 'Дата окончания должна быть больше даты начала.');
                }
            }, 'enableAjaxValidation' => true,'enableClientValidation' => false],
            ['files', 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg', 'png'], 'maxFiles' => 10, 'checkExtensionByMimeType'=>false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'date' => 'Дата',
            'timeStart' => 'Время начала',
            'timeFinish' => 'Время окончания',
            'isBlocked' => 'Блокирующее событие',
            'repeat' => 'Повторяется',
            'dateFinish' => 'Повторять до',
            'files' => 'Файлы'
        ];
    }
}