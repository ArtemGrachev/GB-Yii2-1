<?php

use yii\db\Migration;

/**
 * Class m191114_095315_createBaseTables
 */
class m191114_095315_createBaseTables extends Migration
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
        $this->createIndex('userLoginUniqueInd','users','login',true);
        $this->createIndex('userEmailUniqueInd','users','email',true);
        $this->addForeignKey('activityUSerFK','activity','userID','users','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('emailUniqueInd', 'users');
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_095315_createBaseTables cannot be reverted.\n";

        return false;
    }
    */
}
