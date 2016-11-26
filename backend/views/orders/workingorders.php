<?php
$this->title = 'Working Orders';
?>
<h2 class="page-header"><?=$this->title?></h2>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <?php
    $enter = true;
    $temp_order_id = 0;
    $i = 0;
    foreach ($workingOrdersDataProvider->getModels() as $record)
    {
        $order_id = $record['order_id'];
        $order_total = $record['total'];
        $order_delivery_charge = $record['delivery_charge'];
        $customer_full_name = $record['customer_full_name'];
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
                        <h3 class="widget-user-username">No#: <b><?= $order_id; ?></b> Total: <b><?= $order_total + $order_delivery_charge; ?></b></h3>
                        <h3 class="widget-user-username"><b><?= $customer_full_name; ?></b></h3>
                        <h5 class="widget-user-desc"><?= $customer_address; ?> - <?= $customer_phone; ?></h5>
                        <h5 class="widget-user-desc"><?= $order_date; ?>  <span class="badge bg-red"> <?= $order_status; ?> </span></h5>
                        <h5 class="widget-user-desc">Delivered with: <span class="badge bg-red"> <b><?= $order_user; ?></b> </span></h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">

        <?php
        }
        ?>
                         <li><a href="javascript:void(0)" style="cursor:default"> <?=$item_name;?> <span style="float:right;"> <span class="badge bg-blue"> <?=$order_item_qty;?> </span> <span>*</span> <span class="badge bg-blue"><?=$order_items_price;?></span> = <span class="badge bg-blue"><?=$order_items_total;?></span></span> </a></li>
        <?php
        if($temp_order_id != $order_id || (count($workingOrdersDataProvider->getModels())== $i))
        {
         ?>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b>Delivery Charge</b>   <span style="float:right;"><span class="badge bg-red"> <?=$order_delivery_charge;?>  SYP</span></a></li>
                        <li><a href="javascript:void(0)" style="cursor:default"> <b>Total</b>  <span style="float:right;"><span class="badge bg-green"> <?=$order_total + $order_delivery_charge;?> SYP</span></a></li>
                        <li>
                            <a href="javascript:void(0)" style="cursor:default">
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success  btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'RE-OPEN');">Re-Open</button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning  btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'PENDING');">Pending</button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success  btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'READY');">Ready</button>
                                 </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" style="cursor:default">
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat" onclick="return updateOrderStatus(<?= $order_id; ?>,'ON-DELIVERY');">On Delivery </button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-danger" onclick="return updateOrderStatus(<?= $order_id; ?>,'CLOSE');">Close</button>
                                 </span>
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-danger" onclick="return updateOrderStatus(<?= $order_id; ?>,'CANCEL');">Cancel</button>
                                 </span>
                        </li>
         <?php
            $enter = true;
            echo '</ul> </div></div></div>';
        }
     }
    ?>
</div>

<script>
function updateOrderStatus(id,status) {
    $.ajax({
        type: "POST",
        url: "index.php?r=orders/setworkingorderstatus",
        dataType: "text",
        data: {'id': id, 'status': status},
        success: function (response) {
            if (response == 'ok') {
                window.location.reload();
            } else {
                window.location.reload();
            }
        }
    });
}
</script>

