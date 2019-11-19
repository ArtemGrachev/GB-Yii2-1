<?php


namespace app\components;


use app\models\Day;

class DayComponent extends BaseComponent
{
    /** Русское название дня недели
     * @param string $timestamp
     * @return mixed
     */
    public function getDayRus($timestamp='') {
        $days = array(
            'Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'
        );
        return ($timestamp === '') ? $days[date('w')] : $days[date('w', $timestamp)];
    }

    /** Русское название месяца
     * @param string $timestamp
     * @return mixed
     */
    public function getMonthRus($timestamp='') {
        $days = array(
            'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        );
        return ($timestamp === '') ? $days[date('n') - 1] : $days[date('n', $timestamp) - 1];
    }

    /** Название дня
     * @param Day $day
     * @return bool
     */
    public function titleDay(Day $day):bool {
        $timestamp = $this->getTimestamp($day);
        return date('j', $timestamp).' '.$this->getMonthRus($timestamp).' '.date('Y', $timestamp);
    }

    /** Является ли день выходным
     * @param Day $day
     * @return bool
     */
    public function isWeekend(Day $day):bool {
        $dayOfWeek = $this->getDayRus($this->getTimestamp($day));
        return in_array($dayOfWeek, ['Суббота', 'Воскресенье']);
    }

    /** Проверка введённой пользователем даты на правильность
     * @param Day $day
     * @throws \yii\base\Exception
     */
    private function testDate (Day $day) {
        if (!preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $day->date)) {
            throw new \yii\base\Exception( "Дата должна быть в формате дд.мм.гггг (".$day->date.")." );
        } elseif (!strtotime($day->date)) {
            throw new \yii\base\Exception( "Не удалось распарсить дату (".$day->date.")." );
        }
    }

    /** Получить список активностей дня
     * @param Day $day
     * @return array
     */
    public function getActivitesByDay(Day $day):array {
        $date = $day->date;
        return [];
    }

    /**
     * @param Day $day
     * @return Day
     * @throws \yii\base\Exception
     */
    public function today(Day $day) {
        $this->testDate($day);
        $day->timestampStart = strtotime($day->date);
        $day->timestampFinish = $day->timestampStart + 24*60*60 - 1;
        $day->dateArr = date_parse($day->date);
        $day->activities = $this->getActivitesByDay($day);
        $day->dayOfWeek = $this->getDayRus($day->timestamp);
        $day->isWeekend = in_array($day->dayOfWeek, ['Суббота', 'Воскресенье']);
        return $day;
    }

    public function fieldToTimestamp($day, $time) {
        date();
    }
}