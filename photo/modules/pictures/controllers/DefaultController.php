<?php

namespace  app\modules\photo\modules\pictures\controllers;
use  app\modules\photo\modules\admin\models\SubCategoryModel;
use  app\modules\photo\modules\admin\models\CategoryModel;
use  app\modules\photo\modules\admin\models\ImageUpload;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
/**
 * Default controller for the `pictures` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
         $myUserId = Yii::$app->user->id;

         $query = CategoryModel::find();



         if($myUserId == null)
         {

           $query = (new \yii\db\Query())
            ->from('category')
            ->where(['status' => ['guest']]);

       }elseif($myUserId == 101){

                   $query = (new \yii\db\Query())
                    ->from('category')
                    ->where(['status' => ['guest', 'user']]);

         }else{
              $query = (new \yii\db\Query())
               ->from('category')
               ->where(['status' => ['guest', 'user', 'admin']]);
         }
         // категории
         $count = clone $query;
         $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
         $articles = $query->offset($pagination->offset)
              ->limit($pagination->limit)
              ->all();

          // получение пути фотографии
          $img_path = [];
          // получение кол-ва статей
          $img_count = [];

          foreach ($articles as $category) {
               // array_push($img_path, (ImageUpload::imgPath($category->id)));
               array_push($img_path, (ImageUpload::img_by_key($category['id'])));
          }

          foreach ($articles as $category) {
               array_push($img_count, ImageUpload::getCount2($category['title'], $myUserId));
          }

         return $this->render('index', [
              'img_count' => $img_count,
              'path' => $img_path,
              'categories' => $articles,
              'pagination' => $pagination,
         ]);
    }
}
