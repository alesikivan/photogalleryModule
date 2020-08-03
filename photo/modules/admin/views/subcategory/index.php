<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pictures\models\SubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Создание Subcategory';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-index">

    <h1><b><?= Html::encode($this->title) ?></b></h1>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'slug',
            'title',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
