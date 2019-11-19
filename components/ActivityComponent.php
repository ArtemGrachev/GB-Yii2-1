<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends BaseComponent
{
    public function init()
    {
        parent::init();
    }

    /** Сохранение активности
     * @param Activity $activity
     * @return bool
     */
    public function addActivity(Activity $activity): bool
    {
        $activity->file = UploadedFile::getInstances($activity, 'file');
        if ($activity->validate()) {
            if ($activity->file) {
                $activity->file = (new FileComponent())->saveFile($activity->file);
                if (!$activity->file) {
                    return false;
                }
            }
            $this->insert('activity',[
                'title'=>$activity->title,
                'description'=>$activity->description,
                'timeStart'=>$activity->date.' '.$activity->timeStart,
                'timeFinish'=>$activity->date.' '.$activity->timeFinish,
                'isBlocked'=>(($activity->isBlocked) ? 1 : 0),
                'files'=>$activity->files,
                'userID'=>1 // !!!!!!!!!!!
            ]);
            if ($activity->repeat) {

            }





        <?=$form->field($model,'title');?>
        <?=$form->field($model,'description')->textarea(['data-des'=>22]);?>
        <?=$form->field($model,'date')->input('date');?>
        <?=$form->field($model,'timeStart')->input('time');?>
        <?=$form->field($model,'timeFinish')->input('time');?>
        <?=$form->field($model,'isBlocked')->checkbox()?>
        <?=$form->field($model,'repeat')->dropDownList($repeatValues)?>
        <?=$form->field($model,'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])?>




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



            return $id;
        }
        return false;
    }


}