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

    echo Form::widget([       
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'item_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map(Items::find()->all(),'id','name'),], 
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

