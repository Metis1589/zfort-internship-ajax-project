<?php
use common\models\Brand;
use common\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2><?= Yii::t('app', 'Category') ?></h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php foreach($categories = Category::findAll(['status' => 1]) as $category): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= Html::a(Html::tag('span','('.$category['productCount'].')',['class' => 'pull-right']) . ' ' . $category['name'], Url::to(['category/index', 'slug' => $category['slug']])) ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2><?= Yii::t('app', 'Brands') ?></h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach($brands = Brand::findAll(['status' => 1]) as $brand): ?>
                        <li><?= Html::a(Html::tag('span','('.$brand['productCount'].')',['class' => 'pull-right']) . ' ' . $brand['name'], Url::to(['brand/index', 'slug' => $brand['slug']])) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="shipping text-center"><!--shipping-->
            <img src="/images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->

        <br>

    </div>
</div>