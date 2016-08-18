<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopOffers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOP_OFFERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-offers-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
	            'attribute' => 'shop_id',
	            'value' => $model->shop->name
	        ],
            [
	            'attribute' => 'shop_id',
	            'value' => $model->item->name
	        ],
            'name',
            'short_description',
            'ar_name',
            'ar_short_description',
            [
                'attribute'=>'photo',
                'value' =>  "images/offers/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
            'from_date',
            'to_date',
            [
                'attribute'=>'active',
                'value' =>  $model->active == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            [
                'attribute'=>'offer_type',
                'value' =>  $model->offer_type == 'GOLDEN' ? Yii::t('app', 'GOLDEN') : Yii::t('app', 'SILVER')
            ],
            [
                'attribute'=>'lang',
                'value' =>  $model->lang == 'en' ? Yii::t('app', 'EN') : Yii::t('app', 'AR')
            ],
            'created_at',
            'updated_at',
            [
                'attribute'=>'clickable',
                'value' =>  $model->clickable == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
        ],
    ]) ?>

</div>
