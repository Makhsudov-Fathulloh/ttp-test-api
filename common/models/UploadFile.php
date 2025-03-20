<?php

namespace common\models;

use common\behaviors\SlugBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class UploadFile extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'date_filter' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ]);
    }


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