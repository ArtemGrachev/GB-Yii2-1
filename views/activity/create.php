<?php
/**
 * @var $model \app\models\Activity
 * @var $success - успешная обработка формы
 * @var $repeatValues - массив значений для выпадающего списка */
?>
<h1>Новая активность</h1>
<?php if ($success): ?>
    <h4 class="st-green">Событие успешно создано!</h4>
<?php endif; ?>
<div class="row">
    <div class="col-md-8">
        <?php $form = \yii\bootstrap\ActiveForm::begin();?>
        <?=$form->field($model,'title');?>
        <?=$form->field($model,'description')->textarea(['data-des'=>22]);?>
        <?=$form->field($model,'date')->input('date');?>
        <?=$form->field($model,'timeStart')->input('time');?>
        <?=$form->field($model,'timeFinish')->input('time');?>
        <?=$form->field($model,'isBlocked')->checkbox()?>
        <?=$form->field($model,'repeat')->dropDownList($repeatValues)?>
        <?=$form->field($model,'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>