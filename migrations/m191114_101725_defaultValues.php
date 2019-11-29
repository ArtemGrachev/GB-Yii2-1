<?php

use app\components\UserComponent;
use yii\db\Migration;

/**
 * Class m191114_101725_defaultValues
 */
class m191114_101725_defaultValues extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'login'=>'admin',
            'email'=>'test@test.ru',
            'passwordHash'=>(new UserComponent)->hashPass('qwerty', 'admin', 'full')
        ]);
        $this->batchInsert('activity', ['title', 'description', 'timeStart', 'timeFinish', 'isBlocked', 'userID'],[
            ['Активность 1', 'Проверка описания', '2019-11-15 13:00:00', '2019-11-15 15:00:00', 0, 1],
            ['Активность 2', '', '2019-11-15 14:00:00', '2019-11-15 17:00:00', 0, 1],
            ['Активность 3', '', '2019-11-15 18:00:00', '2019-11-15 20:00:00', 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_101725_defaultValues cannot be reverted.\n";

        return false;
    }
    */
}
