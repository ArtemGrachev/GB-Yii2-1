<?php


namespace app\models;


use app\components\DayComponent;
use app\models\rules\BlackListRule;
use Yii;

class Activity extends Base
{
    public $title;
    public $description;
    public $date;
    public $timeStart;
    public $timeFinish;
    public $isBlocked;
    public $repeat;
    public $dateFinish;
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

    public function dateFormat($date) {
        if (!empty($date)) {
            $dateCreated = \DateTime::createFromFormat('d.m.Y', $date);
            if ($dateCreated) {
                return $dateCreated->format('Y-m-d');
            }
        }
        return null;
    }

    public function beforeValidate()
    {
        $this->date = $this->dateFormat($this->date);
        $this->dateFinish = $this->dateFormat($this->dateFinish);
        return parent::beforeValidate();
    }

    /** Правила формы создания или изменения активности
     * @return array
     */
    public function rules()
    {
        return [
            ['title', 'trim'],
            [['title', 'timeStart', 'timeFinish', 'repeat'], 'required'],
            ['title', 'string', 'length' => [5, 30]],
            ['description', 'string', 'max' => 250],
            [['title', 'description'], BlackListRule::class],
            [['date', 'dateFinish'], 'date', 'format' => 'php:Y-m-d'],
            ['date', 'checkDate'],
            [['timeStart', 'timeFinish'], 'time', 'format' => 'php:H:i'],
            [['timeStart', 'timeFinish'], function(){
                if(strtotime($this->timeStart) >= strtotime($this->timeFinish)) {
                    $this->addErrors(['timeStart', 'timeFinish'], 'Время окончания должно быть больше времени начала.');
                }
            }],
            ['isBlocked', 'boolean'],
            ['repeat', 'in', 'range' => array_keys(self::REPEAT_VALUES)],
            ['dateFinish', 'required', 'when' => function($model) {
                return $this->repeat !== 'no';
            }],
            [['date', 'dateFinish'], function(){
                if (strtotime($this->date) >= strtotime($this->dateFinish)) {
                    $this->addErrors(['date', 'dateFinish'], 'Дата окончания должна быть больше даты начала.');
                } else {
                    switch ($this->repeat) {
                        case 'daily':
                            $period = 1;
                            break;
                        case 'second':
                            $period = 2;
                            break;
                        case 'weekpart':
                            $dateDay = Yii::createObject([
                                'class' => Day::class,
                                'component' => DayComponent::class,
                                'day' => $this->date
                            ]);;
                            $period = (($dateDay->component->isWeekend($dateDay)) ? 7/2 : 7/5);
                            break;
                        case 'weekly':
                            $period = 7;
                            break;
                        case 'monthly':
                            $period = 30;
                            break;
                        case 'yearly':
                            $period = 365;
                            break;
                    }
                    $repeats = floor(abs(strtotime($this->dateFinish) - strtotime($this->date)) / 86400) / $period;
                    if ($repeats > 1000) {
                        $this->addErrors(['date', 'dateFinish'], 'Количество повторений события не должно быть больше 1000');
                    }
                }
            }, 'when' => function($model) {
                return $this->repeat !== 'no';
            }],
            ['files', 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 10, 'checkExtensionByMimeType' => false]
        ];
    }

    public function checkDate() {
        $this->addError('date', 'Значение: '.$this->date);
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