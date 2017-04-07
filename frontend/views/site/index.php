<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Home | E-Shopper');
?>

<?= $this->render('slider') ?>
<?= $this->render('@frontend/views/site/products', [
    'dataProvider' => $dataProvider,
    'title' => Yii::t('app', 'Featured items')
]) ?>
