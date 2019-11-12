<?php


namespace app\components;


class StComponent
{
    /**
     * Проверка того, что переменная существует и не пустая
     * @param string|int|array|bool|float|null $var - переменная для проверки
     * @param string $type - вариант выполнения функции
     *   "common" (по умолчанию) - обычная проверка
     *   "notzero" - переменная не равна нулю
     * @return bool
     */
    public function che($var, $type="common") {
        if ((!isset($var)) || ($var === '') || ($var === []) || ($var === false) || ($var === null) || ($var === 'N;') || ($var === 's:0:"";') || ($var === 'a:0:{}')) {
            return false;
        }
        if (($type === 'notzero') && (($var === 0) || ($var === '0') || ($var === '0.00'))) {
            return false;
        }
        return true;
    }
}