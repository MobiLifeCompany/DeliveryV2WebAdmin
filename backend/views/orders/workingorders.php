<?php
use kartik\dialog\Dialog;
use yii\web\JsExpression;
$this->title = Yii::t('app', 'WORKING_ORDERS');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;

$this->params['currentPageAction'] = Yii::$app->controller->action->id;
?>
<h2 class="page-header"><?=$this->title?></h2>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <?php
    echo Dialog::widget();
    $enter = true;
    $temp_order_id = 0;
    $i = 0;
    foreach ($workingOrdersDataProvider->getModels() as $record)
    {
        $order_id = $record['order_id'];
        $order_total = $record['total'];
        $order_delivery_charge = $record['delivery_charge'];
        $customer_full_name = $record['customer_full_name'];
        $shop_name = Yii::$app->language=='ar'?$record['ar_shop_name']:$record['shop_name'];
        $city_name = Yii::$app->language=='ar'?$record['ar_city_name']:$record['city_name'];
        $area_name = Yii::$app->language=='ar'?$record['ar_area_name']:$record['area_name'];
        $customer_address = $record['customer_address'];
        $customer_phone = $record['customer_phone'];
        $order_status = $record['order_status'];
        $order_date = $record['order_date'];
        $order_user = $record['username'];
        $item_name =  $record['item_name']; ;
        $order_item_qty = $record['order_item_qty'];
        $order_items_price= $record['order_items_price'];
        $order_items_total= $record['order_items_total'];
        $i++;
        if(count($workingOrdersDataProvider->getModels())> $i) {
            $temp_order_id = $workingOrdersDataProvider->getModels()[$i]['order_id'];
        }
        if($enter)
        {
            $enter = false;
        ?>
            <div class="col-md-4" style="padding-top: 20px;">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header <?php if($order_status=='OPEN' || $order_status=='RE-OPEN' || $order_status=='READY') echo 'bg-green'; else if($order_status=='ON-DELIVERY') echo 'bg-blue'; else echo 'bg-yellow';?> ">
                        <div class="widget-user-image">
                            <img class="img-circle" src="dist/img/logo.png" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h4 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app','ORDER_NO');?>: <b><?= $order_id; ?></b> <?=Yii::t('app','TOTAL');?>: <b><?= $order_total + $order_delivery_charge; ?></b></h4>
                        <h4 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><b><?= $shop_name; ?></b></h4>
                        <h4 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'CUSTOMER');?>: <b><?= $customer_full_name; ?></b></h4>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'ADDRESS');?>: <?= $city_name.' - '.$area_name?></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?= $customer_address; ?></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'PHONE');?>: <b><?= $customer_phone;?> </b></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'ORDER_STATUS');?>: <span class="badge bg-red">  <?= Yii::t('app',$order_status);?> </span></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'ORDER_DATE');?>: <?= $order_date; ?></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app','DELIVERY_USER');?>: <span class="badge bg-red"> <b><?= $order_user; ?></b> </span></h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">

        <?php
        }
        ?>
                         <li><a href="javascript:void(0)" style="cursor:default"> <?=$item_name;?> <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>";"> <span class="badge bg-blue"> <?=$order_item_qty;?> </span> <span>*</span> <span class="badge bg-blue"><?=$order_items_price;?></span> = <span class="badge bg-blue"><?=$order_items_total;?></span></span> </a></li>
        <?php
        if($temp_order_id != $order_id || (count($workingOrdersDataProvider->getModels())== $i))
        {
         ?>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b><?=Yii::t('app','DELIVERY_CHARGE');?></b>   <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>"><span class="badge bg-red"> <?=$order_delivery_charge;?>  SYP</span></a></li>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b><?=Yii::t('app','TOTAL');?></b>  <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>"><span class="badge bg-green"> <?=$order_total + $order_delivery_charge;?> SYP</span></a></li>
                        <li>
                            <a href="javascript:void(0)" style="cursor:default">
                                 <span class="input-group-btn">
                                    <button id="reopen-btn-confirm" type="button"  <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> class="btn btn-success  btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'RE-OPEN');"><?php echo Yii::t('app', 'RE-OPEN');?></button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning  btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updatePreparingOrderStatus(<?= $order_id; ?>);"><?php echo Yii::t('app', 'PENDING_ORDER');?></button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success  btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatus(<?= $order_id; ?>,'READY');"><?php echo Yii::t('app', 'READY');?></button>
                                 </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" style="cursor:default">
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatus(<?= $order_id; ?>,'ON-DELIVERY');"><?php echo Yii::t('app', 'ON-DELIVERY');?></button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-danger" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> id="btn-order-close" onclick="return updateOrderStatus(<?= $order_id; ?>,'CLOSED');"><?php echo Yii::t('app', 'CLOSED_ORDER');?></button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-danger" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatusWithPrompt(<?= $order_id; ?>,'CANCEL');"><?php echo Yii::t('app', 'CANCEL_ORDER');?></button>
                                 </span>
                        </li>
         <?php
            $enter = true;
            echo '</ul> </div></div></div>';
        }
     }
        // widget with advanced custom options
        echo Dialog::widget([
            'libName' => 'krajeeDialogCust', // a custom lib name
            'options' => [  // customized BootstrapDialog options
                'size' => Dialog::SIZE_LARGE, // large dialog text
                'type' => Dialog::TYPE_WARNING, // bootstrap contextual color
                'title' => Yii::t('app', 'PENDING_ORDER'),
                'message' => Yii::t('app', 'PENDING_ORDER_MSG'),//'The Order Will be Ready during the following time:',
                'buttons' => [
                    [
                        'id' => 'cust-btn-1',
                        'label' => Yii::t('app', '5_MIN'),
                        'action' => new JsExpression("function(dialog) {
                           updateOrderStatusWithTime(order_id,'PENDING',5);
                }")
                    ],
                    [
                        'id' => 'cust-btn-2',
                        'label' => Yii::t('app', '10_MIN'),
                        'action' => new JsExpression("function(dialog) {
                                updateOrderStatusWithTime(order_id,'PENDING',10);
                }")
                    ],
                    [
                        'id' => 'cust-btn-3',
                        'label' => Yii::t('app', '15_MIN'),
                        'action' => new JsExpression("function(dialog) {
                            updateOrderStatusWithTime(order_id,'PENDING',15);
                }")
                    ],
                    [
                        'id' => 'cust-btn-4',
                        'label' => Yii::t('app', '25_MIN'),
                        'action' => new JsExpression("function(dialog) {
                            updateOrderStatusWithTime(order_id,'PENDING',25);
                }")
                    ],
                ]
            ]
        ]);
    ?>
</div>
<script>
var order_id = 0;
function updatePreparingOrderStatus(id){
    order_id = id;
    krajeeDialogCust.dialog(
        '<?php echo Yii::t('app', 'PENDING_ORDER_MSG')?>',
        function(result) {
            //alert($id);
        }
    );
}
function updateOrderStatusWithPrompt(id,status) {
    var message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE');?>'+status+' ( #'+id+')';
    var reason = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_CANCEL');?>'+' ( #'+id+')'+', '+'<?php echo Yii::t('app', 'CANCEL_REASON');?>';
    var reason_placeholder = '<?php echo Yii::t('app', 'CANCEL_REASON_PLACEHOLDER');?>';
    krajeeDialog.prompt({label:reason, placeholder:reason_placeholder}, function (result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: "index.php?r=orders/setworkingorderstatus",
                dataType: "text",
                data: {'id': id, 'status': status,'item_in_m':0,'cancel_reason':result},
                success: function (response) {
                    if (response == 'ok') {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                }
            });
        } else {
        }
    });

}
function updateOrderStatus(id,status){
    var message = "";
    if(status == 'RE-OPEN')
        message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_RE_OPEN');?>'+' ( #'+id+')';
    else if(status == 'READY')
        message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_READY');?>'+' ( #'+id+')';
    else if(status == 'CLOSED')
        message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_CLOSED');?>'+' ( #'+id+')';
    else if(status == 'ON-DELIVERY')
        message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_ON_DELIVERY');?>'+' ( #'+id+')';
    else
        message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE');?>'+status+' ( #'+id+')';

    krajeeDialog.confirm(message, function (result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: "index.php?r=orders/setworkingorderstatus",
                dataType: "text",
                data: {'id': id, 'status': status,'item_in_m':0,'cancel_reason':''},
                success: function (response) {
                    if (response == 'ok') {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                }
            });
        } else {
        }
    });

}
function updateOrderStatusWithTime(id,status,time_in_m) {
    var order_time = '';
    if(time_in_m==5)
       order_time = '<?php echo Yii::t('app', '5_MIN');?>';
    else if(time_in_m==10)
       order_time = '<?php echo Yii::t('app', '10_MIN');?>';
    else if(time_in_m==15)
        order_time = '<?php echo Yii::t('app', '15_MIN');?>';
    else if(time_in_m==25)
        order_time = '<?php echo Yii::t('app', '25_MIN');?>';

    var message = '<?php echo Yii::t('app', 'CONFIRM_WORKINGORDERS_MESSAGE_PENDING');?>'+ order_time+'  ( #'+id+')';
    krajeeDialog.confirm(message, function (result) {
        if (result) {
            $.ajax({
                type: "POST",
                url: "index.php?r=orders/setworkingorderstatus",
                dataType: "text",
                data: {'id': id, 'status': status,'item_in_m':time_in_m,'cancel_reason':''},
                success: function (response) {
                    if (response == 'ok') {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                }
            });
        } else {
        }
    });

}
</script>