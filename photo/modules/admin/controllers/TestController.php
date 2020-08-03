<?php

namespace app\modules\photo\modules\admin\controllers;

use Yii;
use app\modules\photo\modules\admin\models\ImageModel;
use app\modules\photo\modules\admin\models\ImageUpload;
use app\modules\photo\modules\admin\models\CategoryModel;
use app\modules\photo\modules\admin\models\ImageModelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
/**
 * ImageController implements the CRUD actions for ImageModel model.
 */
class TestController extends Controller
{
     public function actionIndex()
     {

          $arr = CategoryModel::find()->all();


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


var_dump($array);die;


          return $this->render('index', [

          ]);
     }
}
