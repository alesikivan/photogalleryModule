<?php

namespace app\modules\photo\modules\admin\controllers;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use Yii;
use app\modules\photo\modules\admin\models\SubCategoryModel;
use app\modules\photo\modules\admin\models\CategoryModel;

/**
 * Default controller for the `admin` module
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
         if($myUserId == null)
         {

                   throw new NotFoundHttpException('Только для администраторов!');

         }else{
              if($myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }
        return $this->render('index');
    }



}
