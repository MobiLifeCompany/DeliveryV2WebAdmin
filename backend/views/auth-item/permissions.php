<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'VIEW';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'AUTH_ITEMS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

<div class="box-body table-responsive no-padding">
    <table class="table table-striped">
        <tr>
            <th><?= Yii::t('app', 'USER_PERMISSIONS'); ?></th>
        </tr>
<?php
    foreach ($model as $item) {
        echo '<tr>
                  <td>'.$item->child.'</td>
            </tr>';
    }
?>
    </table>
</div>

</div>
