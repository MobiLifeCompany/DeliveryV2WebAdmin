<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ITEMS');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="items-index">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <br/>
    <?php
        Modal::begin([
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false], // important for Select2 to work properly
                'header'=>'<h4>'.Yii::t('app', 'ITEMS').'</h4>',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'responsiveWrap' => false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'layout'=>"{items}\n{summary}\n{pager}",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            //'ar_name',
            [
                'attribute' => 'shop_id',
                'value'=>'shopItemCategory.shop.name'
            ],
            [
                'attribute' => 'item_category_id',
                'value'=>'shopItemCategory.itemCategory.name'
            ],
            'price',
            [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted == 0){
                        return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                       return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }    
	            }
	        ],
            [
	            'attribute' => 'active',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->active == 0){
		                return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }
                    else {
                       return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }    
	            }
	        ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} ',
                'buttons' => [
                    'view' => function ($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton_item_'.$model->id,'onclick'=>'return showViewModalByType('.$model->id.',"item")']);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
