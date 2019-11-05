<?php


namespace app\components;


use app\models\Day;

class DayComponent extends BaseComponent
{
    public function getDayRus($timestamp='')
    {
        $days = array(
            'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
            'Четверг', 'Пятница', 'Суббота'
        );
        return ($timestamp === '') ? $days[(date('w'))] : $days[(date('w', $timestamp))];
    }

    public function isWeekend(Day $day):bool {
        $dayOfWeek = $this->getDayRus($this->getTimestamp($day));
        return in_array($dayOfWeek, ['Суббота', 'Воскресенье']);
    }

    private function testDate (Day $day) {
        if (!preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $day->date)) {
            throw new \yii\base\Exception( "Дата должна быть в формате дд.мм.гггг (".$day->date.")." );
        } elseif (!strtotime($day->date)) {
            throw new \yii\base\Exception( "Не удалось распарсить дату (".$day->date.")." );
        }
    }

    public function getTimestamp(Day $day):int {
        $this->testDate($day);
        return strtotime($day->date);
    }

    public function getDate(Day $day):array {
        $this->testDate($day);
        return date_parse ($day->date);
    }

    public function storageOfActivity(Day $day) {
        return [];
    }
    /**
     * @return Day[]
     */
    public function getActivitesByDay(Day $day):array {
        return $this->storageOfActivity->findActivityBytDay($day->date());
    }
}