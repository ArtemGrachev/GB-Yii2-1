<?php


namespace app\components;


class UserComponent extends BaseComponent
{
    /**
     * Хэширование пароля
     * @param string $pass - пароль
     * @param string $login - логин
     * @param string $type - вариант выполнения функции
     *   "check" (по умолчанию) - от записи в сессии до записи в БД
     *   "full" - от пароля до записи в БД
     *   "write" - от пароля до записи в сессию
     * @return string
     */
    function hashPass($pass, $login, $type="check") {
        switch ($type) {
            case "write":
                return md5(md5('pA88bn'.$pass).$login);
                break;
            case "full":
                return md5('afDmZM'.md5(md5('pA88bn'.$pass).$login));
                break;
            default:
                return md5('afDmZM'.$pass);
        }
    }
}