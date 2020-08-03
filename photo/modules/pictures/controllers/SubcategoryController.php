<?php

namespace app\modules\photo\modules\pictures\controllers;
use app\modules\photo\modules\admin\models\SubCategoryModel;
use app\modules\photo\modules\admin\models\CategoryModel;
use yii\data\Pagination;
use app\modules\photo\modules\admin\models\ImageUpload;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\User;

class SubcategoryController extends \yii\web\Controller
{
     public function actionIndex($slug)
    {
        $model = SubCategoryModel::find()->where(['slug' => $slug])->one();
        $myUserId = Yii::$app->user->id;

          if($myUserId == null)
          {
               if($model->status == 'admin')
               {
                    throw new NotFoundHttpException('Только для администраторов!');
               }
          }else{
               if($model->status == 'admin' && $myUserId == 101)
               {
                    throw new NotFoundHttpException('Только для администраторов!');
               }
          }

             $query = CategoryModel::find();
             $count = clone $query;
             $pagination = new Pagination(['totalCount' => $count->where(['subcategory' => $model->title])->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
             $articles = $query->offset($pagination->offset)
                   ->limit($pagination->limit)
                   ->where(['subcategory' => $model->title])
                   ->all();
               $title = $model->title;

             return $this->render('index', [
                 'categories' => $articles,
                 'pagination' => $pagination,
                 'title' => $title
             ]);
     }
}
