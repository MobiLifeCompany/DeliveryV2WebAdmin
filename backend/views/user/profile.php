<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\StatisticsDashboard;
use yii\helpers\Url;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

$this->title = Yii::t('app', 'USER_PROFILE');
$this->params['breadcrumbs'][] = $this->title;

$statisticsDashboardModel = new StatisticsDashboard();
$generalOrdersCount = $statisticsDashboardModel->getGeneralOrderCount();

$openOrdersCount = 0;
$cancelOrderCount = 0;
$pendingOrderCount = 0;
$closedOrderCount = 0;
   
foreach ($generalOrdersCount as $var) {
     if($var['order_status']=='OPEN' || $var['order_status']=='RE-OPEN'){
       $openOrdersCount = $var['countNum'];
     }else if($var['order_status']=='CANCEL'){
       $cancelOrderCount = $var['countNum'];
     }else if($var['order_status']=='PENDING'){
       $pendingOrderCount = $var['countNum'];
     }else if($var['order_status']=='CLOSED'){
       $closedOrderCount = $var['countNum'];
     }
   }
?>
<br/>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-3">
         <!-- Profile Image -->
         <div class="box box-primary">
            <div class="box-body box-profile">
               <img class="profile-user-img img-responsive img-circle" src="dist/img/user2-160x160.jpg" alt="User profile picture">
               <h3 class="profile-username text-center"> <?= Yii::$app->session['realUser']['first_name'].' '.Yii::$app->session['realUser']['last_name'];;?></h3>
               <p class="text-muted text-center"> 
                  <?= Yii::$app->session['realUser']['user_type'];?>
                  <br/>
                  <small><?= Yii::t('app', 'MEMBER_SINEC') ?>  <?= Yii::$app->formatter->asDate(Yii::$app->session['realUser']['created_at'], 'php:Y-m-d');?></small>
                  <br/><small><?= Yii::t('app', 'UPDATED_AT') ?>  <?= Yii::$app->formatter->asDate(Yii::$app->session['realUser']['updated_at'], 'php:Y-m-d H:m:s');?></small>
               </p>
               <ul class="list-group list-group-unbordered" dir="ltr">
                  <li class="list-group-item">
                     <b><?= Yii::t('app', 'OPEN_ORDERS') ?></b> <a class="pull-right">(<?= Yii::$app->formatter->format($openOrdersCount,'integer');?>)</a>
                  </li>
                  <li class="list-group-item">
                     <b><?= Yii::t('app', 'PENDING_ORDERS') ?></b> <a class="pull-right">(<?= Yii::$app->formatter->format($pendingOrderCount,'integer');?>)</a>
                  </li>
                  <li class="list-group-item">
                     <b><?= Yii::t('app', 'CLOSED_ORDERS') ?></b> <a class="pull-right">(<?= Yii::$app->formatter->format($closedOrderCount,'integer');?>)</a>
                  </li>
                  <li class="list-group-item">
                     <b><?= Yii::t('app', 'CANCEL_ORDERS') ?></b> <a class="pull-right">(<?= Yii::$app->formatter->format($cancelOrderCount,'integer');?>)</a>
                  </li>
               </ul>
               <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
         <!-- About Me Box -->
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><?= Yii::t('app', 'SETTINGS') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <strong><i class="fa fa-home margin-r-5"></i> <?= Yii::t('app', 'SHOPS') ?></strong>
               <div class="box-body">
                  <?php
                     $shop_name = "";
                     if(Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN'){
                         $shop_name = Yii::$app->session['realUser']['shop_id'];
                         echo '<p> <span class="label label-primary">'.$shop_name.'</span></p>';
                     }else{
                         if(!empty($userShops)){
                             echo '<p>';
                             foreach ($userShops as $shop) {
                                 $shop_name = (Yii::$app->language == 'ar')?$shop->ar_name:$shop->name;
                                 echo '<span class="label label-primary">'.$shop_name.'</span> ';
                             }
                             echo '</p>';
                         }else{
                             echo  '<p> <span class="label label-danger">No Shops are Assigned till Now..</span></p>';
                         }
                     }
                     
                     ?>
               </div>
               <hr>
               <strong><i class="fa fa-unlock-alt margin-r-5"></i> <?= Yii::t('app', 'USER_PERMISSIONS') ?></strong>
                <?php
                     if(!empty($userGroupsPermission))
                    {
                             echo '<p>';
                             foreach ($userGroupsPermission as $perm) {
                                 echo '<span class="label label-success">'.$perm.'</span> ';
                             }
                             echo '</p>';
                         }else{
                             echo  '<p> <span class="label label-danger">No Permissions are Assigned till Now..</span></p>';
                         
                    }
                    if(!empty($userPermission))
                    {
                             echo '<p>';
                             foreach ($userPermission as $perm) {
                                 echo '<span class="label label-warning">'.$perm.'</span> ';
                             }
                             echo '</p>';
                         }else{
                             echo  '<p> <span class="label label-danger">No Permissions are Assigned till Now..</span></p>';
                         
                    }
                   
                ?>
               <hr>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
         <div class="nav-tabs-custom">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title"><?= Yii::t('app', 'USER_PROFILE') ?></h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">

                <?php $form = ActiveForm::begin();?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?php 
                    $secretKey = Yii::$app->params['secretKey'];
                    $decryptedPassword = Yii::$app->getSecurity()->decryptByKey(utf8_decode($model->password_hash), $secretKey);
                    $model->password_hash=$decryptedPassword;    
                ?>

                <?= $form->field($model, 'password_hash',['options' => ['autocomplete' => 'off']])->passwordInput() ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput() ?>

                <?= $form->field($model, 'gender')->dropDownList([ 'Male' => Yii::t('app', 'MALE'), 'Female' => Yii::t('app', 'FEMALE'), ], ['prompt' => '']) ?>

                <?= $form->field($model, 'show_notification')->dropDownList([ 'Yes' => Yii::t('app', 'YES'), 'No' => Yii::t('app', 'NO'), ], ['prompt' => '']) ?>

                <?= $form->field($model, 'live_status')->dropDownList([ 'On-Line' => 'On-Line', 'Off-Line' => 'Off-Line', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'work_status')->dropDownList([ 'Ready' => 'Ready', 'Waiting' => 'Waiting', ], ['prompt' => '']) ?>


                <div class="form-group">
                     <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
               </div>
            </div>
            <!-- /.tab-pane -->
         </div>
         <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
      <!-- /.col -->
   </div>
   <!-- /.row -->
</section>
