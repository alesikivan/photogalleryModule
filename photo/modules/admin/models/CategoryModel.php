<?php

namespace app\modules\photo\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $status
 * @property string|null $subcategory
 */
class CategoryModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'status'], 'string', 'max' => 255],
            [['slug', 'title', 'status'], 'trim'],
            ['slug', 'required'],
            ['title', 'required'],
            [['slug'], 'unique', 'message' => 'Choose differ slug!'],
            ['slug', 'match', 'pattern'=>'/^[a-zA-Z0-9-_\/]+$/', 'message'=>'Bad format'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'status' => 'Status',
        ];
    }
    public function getStatusList()
    {
         return [
              1 => 'guest',
              2 => 'user',
              3 => 'admin',
         ];
    }

    public function getStatus($key)
    {
         if($key == 1)
         {
              return 'guest';
         } elseif ($key == 2) {
              return 'user';
         } elseif ($key == 3) {
              return 'admin';
         }
    }

    public function getSubCategories($arr)
    {
         $newArr = [];
         for($i = 0; $i < count($arr); $i++)
         {
              array_push($newArr, $arr[$i]['title']);
         }
         return $newArr;
    }

    public function getCategory($num, $arr)
    {
         return $arr[$num]['title'];
    }

    public function findStatus($status)
    {
         if($status == 'guest')
         {
              return 1;
         } elseif ($status == 'user') {
              return 2;
         } elseif ($status == 'admin') {
              return 3;
         }
    }

    public function getSelestSubCategory($sub, $arr)
    {
         for($i = 0; $i < count($arr); $i++)
         {
              if($arr[$i]['title'] == $sub)
              {
                   return $i;
              }
         }
    }

    public function getListCate($arr)
    {
         $array = array();
         $keys = [];
         $values = [];

         for ($i = 0; $i<count($arr); $i++) {
            array_push($keys, $arr[$i]->id);
            array_push($values, $arr[$i]->title);
         }

         for ($i = 0; $i<count($arr); $i++) {
            $array[$keys[$i]] = $values[$i];
         }
         return $array;
    }



}
