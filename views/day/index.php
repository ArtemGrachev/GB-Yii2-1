<?php
/**
 * @var $date - массив данных даты
 * @var $isWeekend - выходной или будний
 */
$this->title = 'Тест дня';
?>
<p><?php var_dump($date) ?></p>
<p><?=(($isWeekend) ? 'Выходной' : 'Будний')?></p>
