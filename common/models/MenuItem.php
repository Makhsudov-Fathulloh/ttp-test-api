<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_items".
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string|null $url
 * @property int|null $file_id
 * @property int|null $sort
 * @property int|null $menu_id_parent_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 * @property Menu $menu
 * @property MenuItem $menuIdParent
 * @property MenuItem[] $menuItems
 */
class MenuItem extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $document;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            [['file_id', 'sort', 'menu_id_parent_id', 'deleted_at'], 'default', 'value' => null],
            [['url'], 'string', 'max' => 255],
            [['url'], 'default', 'value' => '#'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['menu_id', 'file_id', 'sort', 'menu_id_parent_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['menu_id' => 'id']],
            [['menu_id_parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenuItem::class, 'targetAttribute' => ['menu_id_parent_id' => 'id']],
            [['document'], 'file', 'extensions' => 'jpg, png, pdf, docx', 'maxSize' => 1024 * 1024 * 5]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'file_id' => Yii::t('app', 'File ID'),
            'sort' => Yii::t('app', 'Sort'),
            'menu_id_parent_id' => Yii::t('app', 'Menu Id Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
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


    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FileQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[MenuIdParent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemQuery
     */
    public function getMenuIdParent()
    {
        return $this->hasOne(MenuItem::class, ['id' => 'menu_id_parent_id']);
    }

    /**
     * Gets query for [[MenuItem]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::class, ['menu_id_parent_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MenuItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MenuItemQuery(get_called_class());
    }

    /**
     * @param null $id
     * @return array
     */
    public static function getMenuItemList($menuId, $excludeId = null)
    {
        $query = static::find()->where(['menu_id' => $menuId]);

        if ($excludeId) {
            $query->andWhere(['!=', 'id', $excludeId]);
        }

        return ArrayHelper::map($query->asArray()->all(), 'id', 'title');
    }


}
