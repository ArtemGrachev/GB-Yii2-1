<?php


namespace app\components;


use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileComponent extends BaseComponent
{
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