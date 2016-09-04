<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SHOPS_RATING');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;


?>
<div class="shop-rates-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'SHOP_RATING').'</h4>',
                'id' => 'modal',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?php Pjax::begin(['id'=>'modalGrid']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'layout'=>"{items}\n{summary}\n{pager}",
        'responsiveWrap' => false,
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'customer_id',
             'value'=>'customer.full_name'
            ],
            ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
            ['attribute' => 'order_id',
             'value'=>'order.id'
            ],
            [
	            'attribute' => 'rate',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    $i = 0;
                    $stars = '';
                    for(;$i < $model->rate; $i++)
                        $stars .= Html::a('<span class="fa fa-star text-yellow">','#');
                    for(;$i < 5; $i++)
                        $stars .= Html::a('<span class="fa fa-star-o text-yellow">','#');
                    return $stars;
	            }
	        ],

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    }, 
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
