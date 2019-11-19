<?php


namespace app\components;


use app\models\Day;

class DAOComponent extends BaseComponent
{
    private function getConnection(): Connection
    {
        return \Yii::$app->db;
    }

    public function getById($table, $id){
        $query=new Query();
        return $query->from($table)
            ->select('*')
            ->andWhere('id=:id', [':id' => $id])
            ->limit(1)
            ->one($this->getConnection());
    }

    public function getActivitiesByDay(Day $day):bool {
        $query=new Query();
        return $query->from($day->)
            ->select('*')
            ->andWhere('id=:id', [':id' => $id])
            ->limit(1)
            ->one($this->getConnection());
    }
}