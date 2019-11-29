<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends BaseComponent
{

    /** Сохранение активности
     * @param Activity $activity
     * @return bool
     */
    public function createActivity(Activity $activity): bool
    {
        $activity->files = UploadedFile::getInstances($activity, 'files');
        if ($activity->validate()) {
            if ($activity->files) {
                $fileComponent = new FileComponent();
                $activity->files = serialize($fileComponent->saveFile($activity->files));
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
            return $id;
        }
        return false;
    }


}