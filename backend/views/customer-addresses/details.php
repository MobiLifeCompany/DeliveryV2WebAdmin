<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerAddressesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CUSTOMER_ADDRESSES'). '# '.Yii::$app->request->queryParams['id']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMERS'), 'url' => 'index.php?r=customers'];
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="customer-addresses-index">
    <h3><?= Html::encode('Customer#'.Yii::$app->request->queryParams['id']) ?></h3>
 
<?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'CUSTOMERS').'</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
 ?>
<?php Pjax::begin(['id'=>'modalGrid']);?>   
<?= GridView::widget([
        'dataProvider' => $customerModel,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary'=>"",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
           // 'password_digest',
           // 'confirmation_token',
           // 'auth_token',
             'full_name',
             'phone',
             'mobile',
            // 'photo',
              [
	            'attribute' => 'gender',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->gender =='Male'){
		                return Html::a(Yii::t('app', 'MALE'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'FEMALE'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],
            // 'is_allowed',
            // 'unlock_token',
            // 'confirmed_at',
            // 'locked_at',
            // 'sms_count',
            // 'lang',
             'created_at',
             'updated_at',
             'email:email',
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=customers/view&id='.$model->id,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>'index.php?r=customers/update&id='.$model->id,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

<h3><?= Html::encode('CustomerAddress') ?></h3>

    <?php Pjax::begin(['id'=>'modalGridSpecial']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary'=>"",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
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
		                return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
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
<?php Pjax::end(); ?>


</div>
