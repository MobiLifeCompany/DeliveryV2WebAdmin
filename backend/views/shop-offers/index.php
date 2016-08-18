<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopOffersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SHOPS_OFFERS');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="shop-offers-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=shop-offers/create'),'id'=>'modalButton']); ?>
    </p>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'SHOP_OFFERS').'</h4>',
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false] // important for Select2 to work properly
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'layout'=>"{items}\n{summary}\n{pager}",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',
            'ar_name',
            [
	            'attribute' => 'shop_id',
	            'value' => 'shop.name'
	        ],
            [
	            'attribute' => 'item_id',
	            'value' => 'item.name'
	        ],
            'from_date',
            'to_date',
            [
	            'attribute' => 'active',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->active == 1){
		                return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
	        ],
            [
	            'attribute' => 'offer_type',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->offer_type == 'GOLDEN'){
		                return Html::a(Yii::t('app', 'GOLDEN'),'#',['class'=>'label label-warning']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'SILVER'),'#',['class'=>'label label-default']);
                    }    
	            }
	        ],
            [
	            'attribute' => 'clickable',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->clickable == 1){
		                return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
	        ],

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
