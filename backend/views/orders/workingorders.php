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
        $time_in_m = $record['ready_time'];
        $note = $record['order_note'];
        $hasNote = false;
        if(!empty($note)){
            $hasNote = true;
        }

        $order_time = "";
        if($time_in_m==10)
            $order_time = Yii::t("app", "10_MIN");
        else if($time_in_m==30)
            $order_time = Yii::t('app', "30_MIN");
        else if($time_in_m==60)
            $order_time = Yii::t('app', '60_MIN');
        else if($time_in_m==120)
            $order_time = Yii::t('app', '120_MIN');
        else if($time_in_m==240)
            $order_time = Yii::t('app', '240_MIN');

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
                    <div class="widget-user-header <?php if($order_status=='OPEN' || $order_status=='RE-OPEN') echo 'bg-green'; else if($order_status=='READY') echo 'bg-red'; else if($order_status=='ON-DELIVERY') echo 'bg-blue'; else echo 'bg-yellow';?> ">
                        <!--<div class="widget-user-image">
                            <img class="img-circle" src="dist/img/logo.png" alt="User Avatar">
                        </div>-->
                        <!-- /.widget-user-image -->
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:14px;"';?>># <b><?= $order_id; ?></b> @ <b><?= $order_date; ?></b></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><b><? $shop_name;?></b></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'CUSTOMER');?>: <b><?= $customer_full_name; ?></b>, <?=Yii::t('app', 'PHONE');?>: <b><?= $customer_phone;?> </b></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'ADDRESS');?>: <?= $city_name.' - '.$area_name?></h5>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?= $customer_address; ?></h5>
                        <!--<h5 class="widget-user-desc"      <?php /*if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';*/?>><?/*=Yii::t('app', 'PHONE');*/?>: <b><?/*= $customer_phone;*/?> </b></h5>-->
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'ORDER_STATUS');?>: <?= Yii::t('app',$order_status);?> <?=$order_time;?></h5>
                        <!--<h5 class="widget-user-desc"      <?php /*if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';*/?>><?/*=Yii::t('app', 'ORDER_DATE');*/?>: <?/*= $order_date; */?></h5>-->
                        <?php if ($order_user){ ?>
                        <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app','DELIVERY_USER');?>: <b><?= $order_user; ?></b> </h5>
                        <?php } ?>
                        <?php if ($hasNote){ ?>
                          <h5 class="widget-user-desc"      <?php if(Yii::$app->language=='ar') echo 'style="font-size:13px;"';?>><?=Yii::t('app', 'NOTE');?>:<b><? $note;?></b></h5>
                        <?php } ?>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">

        <?php
        }
        ?>
                         <li><a href="javascript:void(0)" style="cursor:default"> <?=$item_name;?> <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>";"> <?=$order_item_qty;?> * <?=$order_items_price;?> = <?=$order_items_total;?></span> </a></li>
        <?php
        if($temp_order_id != $order_id || (count($workingOrdersDataProvider->getModels())== $i))
        {
         ?>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b><?=Yii::t('app','DELIVERY_CHARGE');?></b>   <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>"><b> <?=$order_delivery_charge;?> </b></span></a></li>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b><?=Yii::t('app','TOTAL');?></b>  <span style="float:<?php if(Yii::$app->language=='ar') echo 'left'; else echo'right';?>"><b> <?=$order_total + $order_delivery_charge;?></b></span></a></li>
                        <li>
                            <a href="javascript:void(0)" style="cursor:default">
                                <!-- <span class="input-group-btn">
                                    <button id="reopen-btn-confirm" type="button"  <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> class="btn btn-success  btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'RE-OPEN');"><?php echo Yii::t('app', 'RE-OPEN');?></button>
                                 </span> -->
                                 <span class="input-group-btn">
                                    <button type="button" <?php if($order_status=='PENDING' || $order_status=='READY' || $order_status=='ON-DELIVERY' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN') echo 'disabled';?> class="btn btn-warning  btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updatePreparingOrderStatus(<?= $order_id; ?>);"><?php if(Yii::$app->language=='ar') echo Yii::t('app', 'PENDING_ORDER'); else echo Yii::t('app', 'PENDING');?></button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" <?php if($order_status=='READY' || $order_status=='ON-DELIVERY' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN') echo 'disabled';?> class="btn btn-danger btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatus(<?= $order_id; ?>,'READY');"><?php echo Yii::t('app', 'READY_ORDER');?></button>
                                 </span>
                                <span class="input-group-btn">
                                    <button type="button" style="background-color: #0073b7; color: #FFFFFF;" <?php if($order_status=='ON-DELIVERY' || ((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN') && $order_status!='READY' )) echo 'disabled';?> class="btn btn-flat" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatus(<?= $order_id; ?>,'ON-DELIVERY');"><?php echo Yii::t('app', 'ON-DELIVERY');?></button>
                                </span>

                            </a>
                        </li>
                       <li>
                            <a href="javascript:void(0)" style="cursor:default; align-content: center">
                                 <span class="input-group-btn">
                                    <button type="button" <?php if($order_status=='CLOSED' || ((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN') && $order_status!='READY' )) echo 'disabled';?> class="btn btn-primary btn-danger" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> id="btn-order-close" onclick="return updateOrderStatus(<?= $order_id; ?>,'CLOSED');"><?php echo Yii::t('app', 'CLOSED_ORDER');?></button>
                                </span>
                                <span class="input-group-btn">
                                    <button type="button" <?php if($order_status=='CANCEL' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN') echo 'disabled';?> class="btn btn-primary btn-danger" <?php if(Yii::$app->language=='ar') echo 'style="font-size:11px;"';?> onclick="return updateOrderStatusWithPrompt(<?= $order_id; ?>,'CANCEL');"><?php echo Yii::t('app', 'CANCEL_ORDER');?></button>
                                </span>
                            </a>
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
                        'label' => Yii::t('app', '10_MIN'),
                        'action' => new JsExpression("function(dialog) {
                           updateOrderStatusWithTime(order_id,'PENDING',10);
                }")
                    ],
                    [
                        'id' => 'cust-btn-2',
                        'label' => Yii::t('app', '30_MIN'),
                        'action' => new JsExpression("function(dialog) {
                                updateOrderStatusWithTime(order_id,'PENDING',30);
                }")
                    ],
                    [
                        'id' => 'cust-btn-3',
                        'label' => Yii::t('app', '60_MIN'),
                        'action' => new JsExpression("function(dialog) {
                            updateOrderStatusWithTime(order_id,'PENDING',60);
                }")
                    ],
                    [
                        'id' => 'cust-btn-4',
                        'label' => Yii::t('app', '120_MIN'),
                        'action' => new JsExpression("function(dialog) {
                            updateOrderStatusWithTime(order_id,'PENDING',120);
                }")
                    ],
                    [
                        'id' => 'cust-btn-5',
                        'label' => Yii::t('app', '240_MIN'),
                        'action' => new JsExpression("function(dialog) {
                            updateOrderStatusWithTime(order_id,'PENDING',240);
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
            krajeeDialog.alert('<?php echo Yii::t('app', 'CANCEL_REASON_DECLINED');?>');
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
    if(time_in_m==10)
        order_time = '<?php echo Yii::t('app', '10_MIN');?>';
    else if(time_in_m==30)
        order_time = '<?php echo Yii::t('app', '30_MIN');?>';
    else if(time_in_m==60)
        order_time = '<?php echo Yii::t('app', '60_MIN');?>';
    else if(time_in_m==120)
        order_time = '<?php echo Yii::t('app', '120_MIN');?>';
    else if(time_in_m==240)
        order_time = '<?php echo Yii::t('app', '240_MIN');?>';

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