<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;

class BaseController extends Controller {
    public function beforeAction($action)
    {
        $this->view->params['lastPage'] = \Yii::$app->session->getFlash('lastPage');
        return parent::beforeAction($action);
    }
    public function afterAction($action, $result) {
        \Yii::$app->session->setFlash('lastPage', "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        return parent::afterAction($action, $result);
    }
}