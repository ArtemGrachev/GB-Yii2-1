<?php


namespace app\controllers;


use app\models\ContactForm;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionHeading()
    {
        return $this->render('heading', [
            'name' => 'Артём',
            'color' => 'green'
        ]);
    }
}