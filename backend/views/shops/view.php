<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Shops */

$this->title = $model->name.' Shop No# '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOPS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'business_id',
             'value'=>$model->business->name
            ],
             ['attribute' => 'area_id',
             'value'=>$model->area->name
            ],
            'name',
            'short_description',
            'address',
            'ar_name',
            'ar_short_description',
            'ar_address',
            'phone',
            [
                'attribute'=>'is_avilable',
                'value' =>  $model->is_avilable == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            'longitude',
            'latitude',
            'estimation_time',
            'min_amount',
            'delivery_expected_time',
            'delivery_charge',
            'promotion_note:ntext',
            'warning_note:ntext',
            [
                'attribute'=>'photo',
                'value' =>  "images/shops/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
            'masteries:ntext',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? Yii::t('app', 'NO') : Yii::t('app', 'YES')
            ],
            'lang',
            'created_at',
            'updated_at',
            'rating',
            'country',
            [
                'attribute'=>'subscribed',
                'value' =>  $model->subscribed == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
        ],
    ]) ?>

    <h4><?= Yii::t('app', 'DELIVERY_AREAS'); ?></h4>
<div class="box-body table-responsive no-padding">
    <table class="table table-striped">
        <tr>
            <th><?= Yii::t('app', 'ID'); ?></th>
            <th><?= Yii::t('app', 'NAME'); ?></th>
            <th><?= Yii::t('app', 'ARABIC'); ?></th>
        </tr>
<?php
    foreach ($deliveryAreas as $area) {
        echo '<tr>
                  <td>'.$area->id.'</td>
                  <td>'.$area->name.'</td>
                  <td>'.$area->ar_name.'</td>
            </tr>';
    }
?>
    </table>
</div>

</div>
