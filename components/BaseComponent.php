<?php


namespace app\components;


use yii\base\Component;

class BaseComponent extends Component
{
    public $modelClass;
    public function getModel()
    {
        return new $this->modelClass;
    }
}