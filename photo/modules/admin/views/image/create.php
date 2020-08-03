<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ImageModel */

$this->title = 'Create Image Model';
$this->params['breadcrumbs'][] = ['label' => 'Category Models', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
        'categoryList' => $categoryList,
        'statusList' => $statusList,
        'waterList' => $waterList,
    ]) ?>

</div>
