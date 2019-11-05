<?php


namespace app\controllers;


use yii\web\Controller;

class BaseController extends Controller {
    public function beforeAction($action)  {
        return parent::beforeAction($action);
    }
    public function afterAction($action, $result) {
        return parent::afterAction($action, $result);
    }
}