<?php

namespace app\modules\photo\modules\pictures\controllers;

use  app\modules\photo\modules\admin\models\SubCategoryModel;
use  app\modules\photo\modules\admin\models\CategoryModel;
use  app\modules\photo\modules\admin\models\ImageUpload;
use  app\modules\photo\modules\admin\models\ImageModel;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use Yii;

class CategoryController extends \yii\web\Controller
{
     public function actionIndex($slug)
    {

         $model = CategoryModel::find()->where(['slug' => $slug])->one();
         $myUserId = Yii::$app->user->id;
         $categoryTitle = $model->slug;



         if($myUserId == null)
         {
              if($model->status == 'admin' || $model->status == 'user')
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }else{
              if($model->status == 'admin' && $myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }


         $query = ImageModel::find();

             $pageSize = 10;   // изменять количество разбиений тут

             $count = clone $query;
             $pagination = new Pagination(['totalCount' => $count->where(['category' => $model->title])->count(), 'pageSize' => $pageSize, 'pageSizeParam' => false]);
             $articles = $query->offset($pagination->offset)
                   ->limit($pagination->limit)
                   ->where(['category' => $model->title])
                   ->all();
               $title = $model->title;
               $model = ImageModel::find()->where(['category' => $model->title])->one();
               if($model == null)
               {
                    $title = "Error";
               }
               $result = 0;
               if($pageSize == 1)
               {
                    $result = floor(($pagination->totalCount/$pageSize)) - 1;
               }elseif (($pagination->totalCount) > $pageSize){
                    $result = floor(($pagination->totalCount/$pageSize));
               }elseif (($pagination->totalCount) == $pageSize) {
                    $result = 0;
               }elseif (($pagination->totalCount) < $pageSize) {
                    $result =  0;
               }


               $result_models = [];
               if($myUserId == null)
               {
                 for($i = 0; $i < count($articles); $i++){
                      if($articles[$i]['status'] == 'guest')
                      {
                           array_push($result_models, $articles[$i]);
                      }
                 }

             }elseif($myUserId == 101){

                  for($i = 0; $i < count($articles); $i++){
                       if($articles[$i]['status'] == 'guest' || $articles[$i]['status'] == 'user')
                       {
                            array_push($result_models, $articles[$i]);
                       }
                  }

               }else{
                    for($i = 0; $i < count($articles); $i++){
                         if($articles[$i]['status'] == 'guest' || $articles[$i]['status'] == 'user' || $articles[$i]['status'] == 'admin')
                         {
                              array_push($result_models, $articles[$i]);
                         }
                    }
               }
               // var_dump($articles);die;

              // var_dump($articles);die;
             return $this->render('index', [
                 'images' => $result_models,
                 'pagination' => $pagination,
                 'title' => $title,
                 'pageSize' => $result,
                 'categoryTitle' => $categoryTitle,
             ]);
    }

}
