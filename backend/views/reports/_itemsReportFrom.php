<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\Helpers\ArrayHelper;
use backend\models\Items;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;

?>

<div class="sales-Report-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'action' => ['itemsreport'],'method' => 'get',]);

    $item_id_val = -1;
    $from_date_val=date('Y-m-d' ,strtotime(' -1 day'));
    $to_date_val = date('Y-m-d');
    $order_status='CLOSED';
    $params = Yii::$app->request->queryParams;
    foreach ($params as $k => $v) {
        if($k=='SalesReport'){
            $item_id_val = $params['SalesReport']['item_id'];
            $from_date_val=$params['SalesReport']['from_date'];
            $to_date_val = $params['SalesReport']['to_date'];
            $order_status = $params['SalesReport']['order_status'];
            break;
        }
    }
    $model->from_date = $from_date_val;
    $model->to_date = $to_date_val;
    $model->item_id = $item_id_val;
    $model->order_status = $order_status;

    echo Form::widget([      
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'from_date'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'hint'=>Yii::t('app', 'SELECT_FROM_DATE'),
            'inline' => false, 
            'value' => '23-Feb-1982 10:01',
            'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose'=>true, 'todayHighlight' => true, ]]
        ],
        'to_date'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'hint'=>Yii::t('app', 'SELECT_TO_DATE'),
            'format' => 'yyyy-mm-dd',
            'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose'=>true, 'todayHighlight' => true]],
            ],
        ]
    ]);

    $userShops = Yii::$app->session['userShops'];
    $items = Items::find()
    ->joinWith('shopItemCategory', '`Item`.`shop_item_category_id` = `shopItemCategory`.`id`')
    ->where(['in','shop_item_categories.shop_id',$userShops])
    ->all();

    echo Form::widget([       
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'item_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($items,'id','name'),], 
            'hint'=>Yii::t('app', 'SELECT_ITEM'),
            'style' => 'width:300px'
        ],
         'order_status'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>[ 'OPEN' => 'Open', 'PENDING' => 'Pending',
                    'CANCEL' => 'Cancel', 'CLOSED' => 'Closed','RE-OPEN' => 'Re-Open', ],], 
            'hint'=>Yii::t('app', 'SELECT_ORDER_STATUS'),
            'style' => 'width:300px'
            ],
        ]
    ]);
 ?>

 <div class="form-group">
    <?= Html::submitButton( Yii::t('app', 'GENERATE_REPORT'), ['class' => 'btn btn-primary']) ?>
</div>
    <?php ActiveForm::end(); ?>
</div>

