<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerAddressesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CUSTOMERS_ADDRESSES');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="customer-addresses-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'CUSTOMER_ADDRESSES').'</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
    <?php Pjax::begin(['id'=>'modalGridSpecial']);?>
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

            'id',
             ['attribute' => 'customer_id',
             'value'=>'customer.full_name'
            ],
             ['attribute' => 'city_id',
             'value'=>'city.name'
            ],
             ['attribute' => 'area_id',
             'value'=>'area.name'
            ],
            'street',
             'building',
             'floor',
            // 'details',
             'phone',
             'email:email',
            // 'latitude',
            // 'longitude',
            // 'is_default',
              [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted ==0){
		                return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }    
	            }
	        ],
            [
	            'attribute' => Yii::t('app', 'POSITION'),
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->latitude =='0' || $model->latitude =='0' ){
		                return "<span class= 'label label-danger'>".Yii::t('app', 'NOT_SET')."</span>";
                    }
                    else {
                       return "<span class= 'label label-success'>".Yii::t('app', 'SET')."</span>";
                    }    
	            }
	        ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('','index.php?r=customer-addresses/map&id='.$model->id,['class'=>'glyphicon glyphicon-map-marker']); },
            ],
            // 'created_at',
            // 'updated_at',
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
