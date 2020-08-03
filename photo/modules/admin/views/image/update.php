<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ImageModel */

$this->title = 'Update Image Model: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Category Models', 'url' => ['category/index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'selectStatus' => $selectStatus,
        'selectCategory' => $selectCategory,
        'categoryList' => $categoryList,
        'statusList' => $statusList,
        'path' => $path,
    ]) ?>

</div>
