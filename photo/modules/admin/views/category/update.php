<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CategoryModel */

$this->title = 'Update Category Model: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Category Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'statusList' => $statusList,
        'selectItem' => $selectItem,
    ]) ?>

</div>
