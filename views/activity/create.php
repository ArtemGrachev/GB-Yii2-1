<?php
/**
 * @var $model \app\models\Activity
 * @var $success - успешная обработка формы
 * @var $repeatValues - массив значений для выпадаbhvnfgxhsfdg
 * @var $repeatValues - данные для выпадающего списка*/
?>
<h1>Новая активность</h1>
<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
        <?=$form->field($model,'title', ['enableAjaxValidation' => true, 'enableClientValidation' => false]);?>
        <?=$form->field($model,'description', ['enableAjaxValidation' => true, 'enableClientValidation' => false])->textarea();?>
        <?=$form->field($model,'date', ['enableAjaxValidation' => true, 'enableClientValidation' => false])->input('date');?>
        <?=$form->field($model,'timeStart', ['enableAjaxValidation' => true, 'enableClientValidation' => false])->input('time');?>
        <?=$form->field($model,'timeFinish', ['enableAjaxValidation' => true, 'enableClientValidation' => false])->input('time');?>
        <?=$form->field($model,'isBlocked')->checkbox();?>
        <?=$form->field($model,'repeat', [
            'inputOptions' => [
                'data_block' => 'select',
            ],
        ])->dropDownList($repeatValues);?>
        <?=$form->field($model,'dateFinish', [
            'inputOptions' => [
                'data_blocked' => 'select',
            ],
            'enableAjaxValidation' => true,
            'enableClientValidation' => false
        ])->input('date');?>
        <?=$form->field($model,'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>