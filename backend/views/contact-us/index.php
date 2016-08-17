<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\Helpers\StringHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CONTACT_US');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;


?>
<div class="contact-us-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'CONTACT_US').'</h4>',
                'id' => 'modal',
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
            'email:email',
            'phone',
            [
	            'attribute' => 'message',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    return StringHelper::truncateWords($model->message, 10, '...'); 
	            }
	        ],
            [
	            'attribute' => 'is_new',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->is_new == 1){
		                return Html::a(Yii::t('app', 'UNREAD_MESSAGE'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'READ_MESSAGE'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    }, 
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
