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

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'login'=>$this->string(100)->notNull(),
            'email'=>$this->string(150)->notNull(),
            'passwordHash'=>$this->string(150)->notNull(),
            'authKey'=>$this->string(150),
            'token'=>$this->string(150),
            'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'timeStart'=>$this->dateTime()->notNull(),
            'timeFinish'=>$this->dateTime()->notNull(),
            'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
            'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'files'=>$this->text()->defaultValue('a:0:{}'),
            'userID'=>$this->integer()->notNull()
        ]);




        $this->insert('users',[
            'id'=>1,
            'login'=>'admin',
            'email'=>'test@test.ru',
            'passwordHash'=>(new UserComponent)->hashPass('qwerty', 'admin', 'full')
        ]);
        $this->batchInsert('activity', ['title', 'description', 'timeStart', 'timeFinish', 'isBlocked', 'userID'],[
            ['Активность 1', 'Проверка описания', mktime (13, 0, 0, 11, 15, 2019), mktime (15, 0, 0, 11, 15, 2019), 0, 1],
            ['Активность 2', '',  mktime (14, 0, 0, 11, 15, 2019), mktime (17, 0, 0, 11, 15, 2019), 0, 1],
            ['Активность 3', '', mktime (18, 0, 0, 11, 15, 2019), mktime (20, 0, 0, 11, 15, 2019), 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        $this->delete('activity');

        return false;
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
