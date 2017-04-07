<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="/images/products/<?= $model['image'] ?>" alt="" />
                <h2>$<?= $model['price'] ?></h2>
                <p><?= Html::a($model['name'], Url::to(['product/index', 'slug' => $model['slug']])) ?></p>
                <?= Html::a(Html::tag('i','',['class' => 'fa fa-shopping-cart']) . ' Add to cart', '#', ['class' => 'btn btn-default add-to-cart']) ?>
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                    <h2>$<?= $model['price'] ?></h2>
                    <p><?= Html::a($model['name'], Url::to(['product/index', 'slug' => $model['slug']])) ?></p>
                    <?= Html::a(Html::tag('i','',['class' => 'fa fa-shopping-cart']) . ' Add to cart', '#', ['class' => 'btn btn-default add-to-cart']) ?>
                </div>
            </div>
            <?= Html::input('hidden','slug', $model['slug']) ?>
        </div>
    </div>
</div>