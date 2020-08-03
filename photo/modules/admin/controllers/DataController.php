<?php

namespace app\modules\photo\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\modules\photo\modules\admin\models\SubCategoryModel;
use app\modules\photo\modules\admin\models\CategoryModel;

/**
 * Default controller for the `admin` module
 */
class DataController extends Controller
{
    public function actionIndex()
    {
         $list = CategoryModel::find()->where(['id' => 1])->one();
         if(Yii::$app->request->isPost)
         {
              return $list;
         }
    }



}
