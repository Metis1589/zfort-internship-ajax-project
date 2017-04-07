<?php

/* @var $this yii\web\View */

$this->title = $model->name;
?>

<?= $this->render('@frontend/views/site/products', [
    'dataProvider' => $dataProvider,
    'title' => $model->name
]) ?>
