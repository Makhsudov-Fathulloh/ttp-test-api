<?php

namespace common\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\validators\UniqueValidator;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use Yii;

/**
 * Class SlugBehavior
 * @package jakharbek\core\behaviors
 */
class SlugBehavior extends AttributeBehavior
{
    /**
     * @var string
     */
    public $attribute = "slug";

    /**
     * @var string
     */
    public $attribute_title = "title";

    /**
     * @var bool
     */
    public $force = false;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE  => 'slugEvent',
        ];
    }

    /**
     * @throws \Exception
     */
    public function slugEvent() {

//        if((strlen($this->owner->{$this->attribute}) == 0) || ($this->force)):
//            VarDumper::dump($this->owner->{$this->attribute_title}, 100, true); die();
//            $slug = $this->slug($this->translit($this->owner->{$this->attribute_title}['en']));
////            $slug = $this->slug($this->translit($this->owner->{$this->attribute_title}));
//            if ($this->validateSlug($slug))
//                $this->owner->{$this->attribute} = $slug;
//            else $this->owner->{$this->attribute} = $slug . "-" . rand(0,1000);
//        endif;

        $attributeTitle = $this->owner->{$this->attribute_title};
        if ((strlen($this->owner->{$this->attribute}) == 0) || ($this->force)) {
            if (is_array($attributeTitle) && isset($attributeTitle['en'])) {
                $slug = $this->slug($this->translit($attributeTitle['en']));
            } else {
                $slug = $this->slug($this->translit($this->owner->{$this->attribute_title}));
            }
            if ($this->validateSlug($slug)) {
                $this->owner->{$this->attribute} = $slug;
            } else {
                $this->owner->{$this->attribute} = $slug . "-" . rand(0, 1000);
            }
        }

    }

    protected function validateSlug($slug) {
        /* @var $validator UniqueValidator */
        /* @var $model BaseActiveRecord */
        $validator = Yii::createObject(
            [
                'class' => UniqueValidator::class,
            ]
        );

        $model = clone $this->owner;
        $model->clearErrors();
        $model->{$this->attribute} = $slug;

        $validator->validateAttribute($model, $this->attribute);
        return !$model->hasErrors();
    }

    /**
     * @param $string
     * @param array $replace
     * @param string $delimiter
     * @return mixed|null|string|string[]
     * @throws \Exception
     */
    function slug($string, $replace = array(), $delimiter = '-') {
        $string = $this->translit($string);
        if (!extension_loaded('iconv')) {
            throw new \Exception('iconv module not loaded');
        }
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        if (!empty($replace)) {
            $clean = str_replace((array) $replace, ' ', $clean);
        }
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }

    /**
     * @param $string
     * @return string
     */
    function translit($string){
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'J',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sh',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
}