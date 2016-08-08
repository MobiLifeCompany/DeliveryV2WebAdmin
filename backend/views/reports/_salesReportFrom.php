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

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'action' => ['salesreport'],'method' => 'get',]);

    echo Form::widget([      
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'from_date'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'hint'=>'Enter From Date (yyyy-mm-dd)',
            'inline' => false, 
            'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose'=>true, 'todayHighlight' => true, ]]
        ],
        'to_date'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'hint'=>'Enter To Date (yyyy-mm-dd)',
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
        'shop_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map(Shops::find()->all(),'id','name'),], 
            'hint'=>'Type and Select Shop',
            'style' => 'width:300px'
        ],
         'order_status'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>[ 'OPEN' => 'Open', 'PENDING' => 'Pending',
                    'CANCEL' => 'Cancel', 'CLOSED' => 'Closed','RE-OPEN' => 'Re-Open', ],], 
            'hint'=>'Type and Select Order Status',
            'style' => 'width:300px'
            ],
        ]
    ]);
 ?>

 <div class="form-group">
    <?= Html::submitButton( Yii::t('app', 'Genearte Report'), ['class' => 'btn btn-primary']) ?>
</div>
    <?php ActiveForm::end(); ?>
</div>

