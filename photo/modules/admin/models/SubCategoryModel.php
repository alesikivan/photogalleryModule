<?php

namespace app\modules\photo\modules\admin\models;
use app\modules\photo\modules\admin\models\CategoryModel;
use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $status
 */
class SubCategoryModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'title', 'status'], 'string', 'max' => 255],
            [['slug', 'title', 'status'], 'trim'],
            ['slug', 'required'],
            // ['slug', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'message'=>'slug must contain uppercase letter.'],
            // ['slug', 'match', 'pattern'=>'/[a-z]+$/', 'message'=>'Username must contain lowercase letter.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Title',
            'status' => 'Status',
        ];
    }

    public function getStatusList()
    {
         return [
              1 => 'admin',
              2 => 'user',
              3 => 'guest',
              4 => 'demo'
         ];
    }

    public function getStatus($key)
    {
         if($key == 1)
         {
              return 'admin';
         } elseif ($key == 2) {
              return 'user';
         } elseif ($key == 3) {
              return 'guest';
         } elseif ($key == 4) {
              return 'demo';
         }
    }
    public function findStatus($status)
    {
         if($status == 'admin')
         {
              return 1;
         } elseif ($status == 'user') {
              return 2;
         } elseif ($status == 'guest') {
              return 3;
         } elseif ($status == 'demo') {
              return 4;
         }
    }

    public function setCount($subTitle)
    {
         $subName = $subTitle->title;
         $result = (new \yii\db\Query())
          ->from('category')
          ->where(['subcategory' => $subName])->all();

         return count($result);
    }

    public function getCategories($subTitle)
    {
         $subName = $subTitle->title;
         $result = (new \yii\db\Query())
         ->from('category')
         ->where(['subcategory' => $subName])->all();

         return $result;
    }

    public function getCategories2($subTitle)
    {
         $subName = $subTitle['title'];
         $result = (new \yii\db\Query())
         ->from('subcategory')
         ->where(['title' => $subName])->all();

         return $result;
    }

}
