<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderHistoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ORDER_HISTORY');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-histories-index">

    <h3><?= Html::encode($this->title) ?></h3>
  
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary'=> "",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
             'attribute' => 'order_id',
             'value'=>function($model){ return $model->order_id.' #';},
            ],
            [
             'attribute' => 'user_id',
             'value'=>'user.username'
            ],
            'order_status',
            'created_at',
            // 'updated_at',
        ],
    ]); ?>
</div>
