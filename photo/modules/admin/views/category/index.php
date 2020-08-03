<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\modules\photo\modules\admin\models\ImageUpload;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //$this->registerJsFile('@web/../modules/photo/web/js/addmyclass.js', ['depends' => 'yii\web\YiiAsset']) ?>
<?php //$this->registerJsFile('basic/modules/photo/web/js/fullScreen.js', ['depends' => 'yii\web\YiiAsset']) ?>
<?php //$this->registerJsFile('@web/../modules/photo/web/js/fullScript2.js', ['depends' => 'yii\web\YiiAsset']) ?>
<?php //$this->registerJsFile('@web/../modules/photo/web/js/test.js', ['depends' => 'yii\web\YiiAsset']) ?>
<?php //$this->registerCssFile('@web/../modules/photo/web/css/imageview.css',  ['depends' => 'yii\web\YiiAsset']) ?>
<?php //$this->registerCssFile('@web/../modules/photo/web/css/full2.css', ['depends' => 'yii\web\YiiAsset']) ?>
<style media="screen">
table, tr, td, th {
 border: 1px solid black;
 text-align: center;
}
th.prim{
     display: flex;
     flex-direction: row;
     justify-content: space-around;
}
  table{
    width: 100%;
  }
  .sp:hover{
  	color: #fff;
     text-decoration: none;
     cursor:auto;
  }
</style>


<div class="article-index">

    <h1 class="category-title"><b><?= Html::encode($this->title) ?></b></h1>

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
       <?= Html::a('Создать новую фотографию', ['image/create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
  $counter = 0;
 ?>
      <table>
        <tr>
              <th>#</th>
              <th>ID</th>
              <th>slug</th>
              <th>name</th>
              <th>images amount</th>
              <th style="width: 300px;">actions</th>
        </tr>
           <?php foreach ($articles as $element): ?>
             <tr>
                       <th><?=$counter?></th>
                       <th><?=$element->id?>
                       <th><?=$element->slug?>
                            <div id="myNav" class="overlay">

                              <!-- Button to close the overlay navigation -->
                              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                              <!-- Overlay content -->
                              <div class="overlay-content">
                               <?php // Html::submitButton('Удалить все фото', ['class' => 'myBtn2', 'name' => 'move2']) ?>
                               <?php $form = ActiveForm::begin(['id' => 'i9']); ?>
                                    <?= Html::submitButton('Удалить категорию', ['class' => 'myBtn2', 'name' => 'move2']) ?>
                               <?php ActiveForm::end(); ?>

                                              <div class="line"></div>

                                             <?php $form = ActiveForm::begin(['class' => 'main-form']); ?>
                                                  <?= Html::dropDownList('category', 0, $list, ['class' => 'select-tag']) ?>
                                                  <?= Html::submitButton('Move', ['class' => 'myBtn', 'name' => 'move']) ?>
                                             <?php ActiveForm::end(); ?>
                              </div>

                            </div>
                       </th>
                       <th><?= Html::a($element->title, ['image/index', 'slug' => $element->slug,], ['class' => 'category-title']) ?></th>
                       <th><?=$img_count[$counter]?></th>
                       <th class="prim" style="border: none;margin:2px auto; ">

                             <?= Html::a('Update', ['update', 'id' => $element->id], ['class' => 'btn btn-primary blue']) ?>
                             <button onclick="openNav()" class="delete btn-danger" id="<?=$element->title ?>">Delete</button>

                       </th>
            </tr>
            <?php $counter++; ?>
           <?php endforeach; ?>
      </table>




     <?php
     echo LinkPager::widget([
       'pagination' => $pagination,
       'class' => 'pagination',
     ]);
      ?>
</div>
