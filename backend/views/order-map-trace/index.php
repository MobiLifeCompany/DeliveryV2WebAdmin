<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderMapTraceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Map Traces');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'USERS'), 'url' => 'index.php?r=user'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-map-trace-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
        'dataProvider' => $userModel,
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
            'first_name',
            'last_name',
            'username',
             ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
             'phone',
             'user_type',
              [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted =='Yes'){
		                return Html::a('No','#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a('Yes','#',['class'=>'label label-success']);
                    }    
	            }
	        ],
        ],
    ]); 
?>  
<br>
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
            [
             'attribute' => 'user_id',
             'value'=>'user.username'
            ],
            'Longitude',
            'Latitude',
            'created_at',
        ],
    ]); ?>
</div>
