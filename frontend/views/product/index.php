<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = Yii::t('app', 'Home | E-Shopper');
?>

<section>
    <div class="container">
        <div class="row">
            <?= $this->render('@frontend/views/site/categories') ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="/images/products/<?= $model['image'] ?>" alt="" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2><?= $model['name'] ?></h2>
								<span>
									<span>US $<?= $model['price'] ?></span>
									<label>Quantity:</label>
									<input type="text" value="1" />
									<button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                    <?= Html::input('hidden','slug', $model['slug']) ?>
								</span>
                            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
            </div>
        </div>
    </div>
</section>
