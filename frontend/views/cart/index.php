<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<section id="cart_items">
    <div class="container">
        <?php if($orderItems): ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($orderItems as $orderItem): ?>
                <tr>
                    <td class="cart_product">
                        <?= Html::a(Html::img('/images/products/'.$orderItem->product->image, ['style' => 'max-width:100px']), Url::toRoute('product/index',['slug' => $orderItem->product->slug])) ?>
                    </td>
                    <td class="cart_description">
                        <h4><?= Html::a($orderItem->product->name, Url::toRoute('product/index',['slug' => $orderItem->product->slug])) ?></h4>
                    </td>
                    <td class="cart_price">
                        <p>$<?= $orderItem->product->price ?></p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <?= Html::input('number', 'quantity', $orderItem->amount, ['class' => 'cart_quantity_input', 'autocomplete'=>'off', 'size'=>2]) ?>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?= $orderItem->amount * $orderItem->product->price ?></p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <?php else: ?>
            <h4><?= Yii::t('app', 'No items were added to the cart') ?></h4>
        <?php endif; ?>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="pull-right col-sm-6">
                <div class="total_area">
                    <ul>
                        <li><?= Yii::t('app', 'Total') ?> <span>$<?= $order['fullPrice'] ?></span></li>
                        <li><?= Yii::t('app', 'Discount') ?> <span><?= $order['discount'] ? '$'.$order['discount'] : Yii::t('app', 'No discount') ?></span></li>
                        <li><?= Yii::t('app', 'Delivery Cost') ?> <span><?= $order['deliveryCost'] ? '$'.$order['deliveryCost'] : Yii::t('app', 'Free') ?></span></li>
                        <li><?= Yii::t('app', 'Tax Cost') ?> <span><?= $order['taxCost'] ? '$'.$order['taxCost'] : Yii::t('app', 'Included') ?></span></li>
                        <li><?= Yii::t('app', 'Grand Total') ?> <span>$<?= $order['totalPrice'] ?></span></li>
                    </ul>
                    <a class="btn btn-default update" href=""><?= Yii::t('app', 'Check Out') ?></a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->