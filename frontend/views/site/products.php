<section>
    <div class="container">
        <div class="row">
            <?= $this->render('categories') ?>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?= $title ?></h2>
                    <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_product',
                        'summary' => ''
                    ]) ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>