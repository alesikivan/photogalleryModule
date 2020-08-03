<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\modules\admin\models\ImageUpload;



/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php //var_dump($articles[0]['id']);die;  ?>
<style media="screen">
table{
     width: 100%;
}
table, tr, td, th {
 border: 1px solid black;
 text-align: center;
}
img{
     heigth:100px;
     width:100px;
}
</style>

<div class="article-index">

    <h1 class="category-title"><b><?= Html::encode($this->title) ?></b></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
  $counter = 0;
 ?>
      <table>
        <tr>
              <th>#</th>
              <th>ID</th>
              <th>file name</th>
              <th>name</th>
              <th>status</th>
              <th style="width: 300px;">actions</th>
        </tr>
           <?php foreach ($articles as $element): ?>
             <tr>
                       <th><?=$counter?></th>
                       <th><?=$element->id?></th>
                       <th><?=$element->image?></th>
                       <th><?=$element->title?></th>
                       <th><?=$element->status?></th>
                       <th class="special" style="border: none;">
                            <?= Html::a('View', ['view', 'id' => $element->id,],['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Update', ['update', 'id' => $element->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $element->id],  [
                                             'class' => 'btn btn-danger',
                                             'data' => [
                                                  'confirm' => 'Are you sure you want to delete this item?',
                                                  'method' => 'post',
                                             ],
                                          ]) ?>
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
