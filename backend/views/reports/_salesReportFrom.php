<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\Helpers\ArrayHelper;
use backend\models\Shops;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;

?>

<div class="sales-Report-form">
    
     <?php
      // filter shops according to user permissions
        $userShops = Yii::$app->session['userShops'];
        
        $shop_id_val = -1;
        $delivery_user_id = -1;
        $from_date_val=date('Y-m-d' ,strtotime(' -1 day'));
        $to_date_val = date('Y-m-d');
        $order_status='All';
        $params = Yii::$app->request->queryParams;
        foreach ($params as $k => $v) {
            if($k=='SalesReport'){
                $shop_id_val = $params['SalesReport']['shop_id'];
                $from_date_val=$params['SalesReport']['from_date'];
                $to_date_val = $params['SalesReport']['to_date'];
                $order_status = $params['SalesReport']['order_status'];
                $delivery_user_id = $params['SalesReport']['delivery_user_id'];
                break;
            }
        }
        $model->from_date = $from_date_val;
        $model->to_date = $to_date_val;
        $model->shop_id = $shop_id_val;
        $model->order_status = $order_status;
        $model->delivery_user_id = $delivery_user_id;
     ?>  
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'action' => ['salesreport'],'method' => 'get',]);

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

    $result = [];
    array_push($result,['id'=>-1,'name'=>'All']);
    $shops = Shops::find()->where(['in','id',$userShops])->all();
    foreach($shops as $shop){
        $record = ['id'=>$shop->id, 'name'=>$shop->name];
        array_push($result,$record);
    }

    $userShops = Yii::$app->session['userShops'];
    $query = \backend\models\User::find();
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
    ]);
    $query->joinWith('userShops');
    $query->orWhere([
        'and',
        ['user.user_type'=>'CR_DELIVERY_MAN'],
        // ['in','user_shops.shop_id',$userShops],
    ]);
    $query->orWhere([
        'and',
        //['user.user_type'=>'CR_DELIVERY_MAN'],
         ['in','user_shops.shop_id',$userShops],
    ]);
    $query->distinct();
    $result2 = [];
    array_push($result2,['id'=>-1,'name'=>'All']);
    foreach($dataProvider->getModels() as $xxx ){
        $record = ['id'=>$xxx->id, 'name'=>$xxx->first_name.' '.$xxx->last_name];
        array_push($result2,$record);
    }
    echo Form::widget([       
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'shop_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($result,'id','name'),],
            'hint'=>Yii::t('app', 'SELECT_SHOPS'),
            'style' => 'width:300px'
        ],
         'order_status'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2',
             'options'=>['data'=>[ 'ALL'=>'All', 'OPEN' => 'Open', 'PENDING' => 'Pending',
                 'CANCEL' => 'Cancel', 'CLOSED' => 'Closed','READY'=>'Ready','ON-DELIVERY' => 'On-Delivery', ],],
            'hint'=>Yii::t('app', 'SELECT_ORDER_STATUS'),
            'style' => 'width:300px'
            ],
        'delivery_user_id'=>[
            'type'=>Form::INPUT_WIDGET,
            'widgetClass'=>'\kartik\widgets\Select2',
            'options'=>['data'=>ArrayHelper::map($result2,'id','name'),],
            'hint'=>Yii::t('app', 'SELECT_SHOPS'),

        ]
        ]
    ]);
 ?>

 <div class="form-group">
    <?= Html::submitButton( Yii::t('app', 'GENERATE_REPORT'), ['class' => 'btn btn-primary']) ?>
</div>
    <?php ActiveForm::end(); ?>
</div>

