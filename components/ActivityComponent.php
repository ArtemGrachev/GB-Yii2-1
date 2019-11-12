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
                $activity->file = $this->saveFile($activity->file);
                if (!$activity->file) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /** Сохранение файла
     * @param UploadedFile $file
     * @return string|null
     * @throws \yii\base\Exception
     */
    private function saveFile(UploadedFile $file): ?string
    {
        $name = $this->genFileName($file);
        $path = $this->getPathToSave() . $name;
        if ($file->saveAs($path)) {
            return $name;
        }
        return null;
    }

    /** Путь для сохранения файлов, загруженных пользователями
     * @return bool|string
     * @throws \yii\base\Exception
     */
    private function getPathToSave()
    {
        $path = \Yii::getAlias('@webroot/files/');
        FileHelper::createDirectory($path);
        return $path;
    }

    /** Генерирует название файла перед сохранением
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    private function genFileName(UploadedFile $file)
    {
        $time = time();
        do {
            $fileName = $time . "_" . $file->getBaseName() . '.' . $file->getExtension();
            $time--;
        } while (file_exists($this->getPathToSave().$fileName));
        return $fileName;
    }
}