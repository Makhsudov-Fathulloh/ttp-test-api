<?php

namespace common\models;

use Yii;

class UploadFile  extends \yii\db\ActiveRecord
{
    public function uploadFile()
    {
        if ($this->document) {
            $file = new File();
            $file->title = $this->document->baseName . '_' . uniqid();
            $file->ext = $this->document->extension;
            $file->size = $this->document->size;
            $file->user_id = Yii::$app->user->id ?? null;
            $file->downloads = 0;

            $uploadDir = Yii::getAlias('@static/uploads/');
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                    Yii::$app->session->setFlash('error', 'Katalog yaratishda xatolik.');
                    return false;
                }
            }

            $fileName = $file->title . '.' . $file->ext;
            $filePath = $uploadDir . $fileName;
            $file->path = '/static/uploads/' . $fileName;
            $file->domain = Yii::$app->request->hostInfo;
            $file->folder = '/static/uploads';

            if (!file_exists($this->document->tempName)) {
                Yii::$app->session->setFlash('error', 'Fayl yo‘qolib qoldi.');
                return false;
            }

            if ($this->document->saveAs($filePath)) {
                $file->path = '/static/uploads/' . $fileName;
                if ($file->save()) {
                    $this->file_id = $file->id;
                    return true;
                }
            }
        }

        return false;
    }
}