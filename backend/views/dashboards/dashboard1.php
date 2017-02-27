<?php
   use yii\helpers\Html;
   use yii\helpers\ArrayHelper;
   use yii\bootstrap\Modal;
   use yii\Helpers\Url;
   
   $this->title = Yii::t('app', 'STATISTICS_DASHBOARD');
   $this->params['breadcrumbs'][] = $this->title;
   
   $curpage = Yii::$app->controller->id;
   $this->params['currentPage'] = $curpage;
   $this->params['currentPageAction'] = Yii::$app->controller->action->id;
   
   $currentYear = date('Y');
   $currentMonth = date('F');
   
   $openOrdersCount = 0;
   $cancelOrderCount = 0;
   $pendingOrderCount = 0;
   $closedOrderCount = 0;
   
   $openOrdersSum = 0;
   $cancelOrderSum = 0;
   $pendingOrderSum = 0;
   $closedOrderSum = 0;
   
   $openOrdersCountM = 0;
   $cancelOrderCountM = 0;
   $pendingOrderCountM = 0;
   $closedOrderCountM = 0;
   
   $openOrdersSumM = 0;
   $cancelOrderSumM = 0;
   $pendingOrderSumM = 0;
   $closedOrderSumM = 0;
   
   foreach ($dailyOrdersCount as $var) {
     if($var['order_status']=='OPEN' || $var['order_status']=='RE-OPEN'){
       $openOrdersCount = $var['countNum'];
       $openOrdersSum = $var['sumNum'];
     }else if($var['order_status']=='CANCEL'){
       $cancelOrderCount = $var['countNum'];
       $cancelOrderSum = $var['sumNum'];
     }else if($var['order_status']=='PENDING'){
       $pendingOrderCount = $var['countNum'];
       $pendingOrderSum = $var['sumNum'];
     }else if($var['order_status']=='CLOSED'){
       $closedOrderCount = $var['countNum'];
       $closedOrderSum = $var['sumNum'];
     }
   }
   
   foreach ($monthlyOrdersCount as $var) {
     if($var['order_status']=='OPEN' || $var['order_status']=='RE-OPEN'){
       $openOrdersCountM = $var['countNum'];
       $openOrdersSumM = $var['sumNum'];
     }else if($var['order_status']=='CANCEL'){
       $cancelOrderCountM = $var['countNum'];
       $cancelOrderSumM = $var['sumNum'];
     }else if($var['order_status']=='PENDING'){
       $pendingOrderCountM = $var['countNum'];
       $pendingOrderSumM = $var['sumNum'];
     }else if($var['order_status']=='CLOSED'){
       $closedOrderCountM = $var['countNum'];
       $closedOrderSumM = $var['sumNum'];
     }
   }
   
   ?>
<br/>
<br/>
<!-- Info boxes -->
<?php 
if(Yii::$app->user->can('show_orders_statistics') || Yii::$app->user->can('show_dashbaord1') )
  {
?>
<div class="row">
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-green"><i class="fa fa-cart-arrow-down"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'OPEN_ORDERS');?></span>
            <span class="info-box-number"><?=Yii::t('app', 'DAILY');?>: <?=$openOrdersCount;?></span>
            <span class="info-box-number"><?=Yii::t('app', 'MONTHLY');?>: <?=$openOrdersCountM;?></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-arrow-circle-right"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'PENDING_ORDERS');?></span>
            <span class="info-box-number"><?=Yii::t('app', 'DAILY');?>: <?=$pendingOrderCount;?></span>
            <span class="info-box-number"><?=Yii::t('app', 'MONTHLY');?>: <?=$pendingOrderCountM;?></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <!-- fix for small devices only -->
   <div class="clearfix visible-sm-block"></div>
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-aqua"><i class="fa fa-times"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'CANCEL_ORDERS');?></span>
            <span class="info-box-number"><?=Yii::t('app', 'DAILY');?>: <?=$cancelOrderCount;?></span>
            <span class="info-box-number"><?=Yii::t('app', 'MONTHLY');?>: <?=$cancelOrderCountM;?></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-red"><i class="fa fa-check-circle-o"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'CLOSED_ORDERS');?></span>
            <span class="info-box-number"><?=Yii::t('app', 'DAILY');?>: <?=$closedOrderCount?></span>
            <span class="info-box-number"><?=Yii::t('app', 'MONTHLY');?>: <?=$closedOrderCountM?></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
</div>
<?php
  }
?>
<!-- /.row -->
<div class="row">
  <?php 
    if(Yii::$app->user->can('show_daily_sales_chart') || Yii::$app->user->can('show_dashbaord1') )
       {
  ?>       
      <div class="col-md-12">
          <div class="box box-primary ui-sortable-handle">
            <div class="box-header with-border" >
                <h3 class="box-title"><?=Yii::t('app', 'DAILY_ORDERS_REPORT');?></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                  </div>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                      <?php 
                        $monthDate = ArrayHelper::getColumn($dailyAmountSeries, 'monthDate');
                        $sumTotal = ArrayHelper::getColumn($dailyAmountSeries, 'sumTotal');
                        $sumTotal = array_map('intval', $sumTotal );
                        ?>
                      <?=
                        \dosamigos\highcharts\HighCharts::widget([
                            'clientOptions' => [
                                'chart' => [
                                        'type' => 'line',
                                ],
                                'title' => [
                                    'text' => Yii::t('app', 'DAILY_ORDERS_REPORT').' ('. $currentMonth.'-'.$currentYear.')'
                                    ],
                                'xAxis' => [
                                    'categories' => $monthDate
                                ],
                                'yAxis' => [
                                    'title' => [
                                        'text' => Yii::t('app', 'ORDER_COUNT')
                                    ]
                                ],
                                'series' => [
                                    ['name' => Yii::t('app', 'COUNT'), 'data' =>$sumTotal],
                                ]
                            ]
                        ]);
                        ?>
                      <!-- /.chart-responsive -->
                  </div>
                </div>
                <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br/>
  <?php
       }
  ?>     
<div class="row">
  <?php 
    if(Yii::$app->user->can('show_monthly_sales_chart') || Yii::$app->user->can('show_dashbaord1') )
       {
  ?> 
    <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
              <h3 class="box-title"><?=Yii::t('app', 'MONTHLY_SALES_REPORT');?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                    <?php 
                      $monthDate = ArrayHelper::getColumn($monthlyAmountSeries, 'monthDate');
                      $sumTotal = ArrayHelper::getColumn($monthlyAmountSeries, 'sumTotal');
                      $sumTotal = array_map('intval', $sumTotal );
                      $sumQty = ArrayHelper::getColumn($monthlyAmountSeries, 'sumQty');
                      $sumQty = array_map('intval', $sumQty );
                      ?>
                    <?=
                      \dosamigos\highcharts\HighCharts::widget([
                          'clientOptions' => [
                              'chart' => [
                                      'type' => 'bar',
                              ],
                              'title' => [
                                  'text' => Yii::t('app', 'TOTTAL_ORDERS_QTY').$currentYear
                                  ],
                              'xAxis' => [
                                  'categories' =>  $monthDate
                              ],
                              'series' => [
                                  ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
                               //   ['name' => Yii::t('app', 'ITEM_QTY'), 'data' => $sumQty]
                              ]
                          ]
                      ]);
                      ?>
                    <!-- /.chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
          </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <br>
<?php
       }
?>  
<!-- Main row -->
<div class="row">
<!-- Left col -->
<div class="col-md-8">
   <!-- MAP & BOX PANE -->
   <!-- /.box -->
   <div class="row">
   <?php 
    if(Yii::$app->user->can('show_assignment_orders_o_p') || Yii::$app->user->can('show_dashbaord1') )
       {
    ?> 
      <div class="col-md-6">
         <!-- DIRECT CHAT -->
         <div class="box box-danger">
            <div class="box-header with-border">
               <h3 class="box-title"><?=Yii::t('app', 'DAILY_DELIVERY_ASSIGNMENT_TITLE2')?></h3>
               <div class="box-tools pull-right">
                  <!-- <span class="label label-danger">8 New Members</span> -->
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
               <ul class="users-list clearfix">
                  <?php 
                     foreach ($lastDeliveryManOrdersStatus as $itemModel) {
                       $order_status = $itemModel['order_status'];
                         if($order_status=='CLOSED' || $order_status=='CANCEL'){
                           $countNum = $itemModel['countNum'];
                           $username = $itemModel['username'];
                           $photo = $itemModel['photo'];
                         
                           $photo = "dist/img/".$photo;
                           $photo = (empty($itemModel['photo']))?"dist/img/user8-128x128.jpg":$photo;
                     ?>
                  <li>
                     <img src="<?=$photo;?>" alt="User Image">
                     <a class="users-list-name" href="#"><?=$username;?></a>
                     <span class="users-list-date">
                     <?php
                        if($order_status =='CLOSED'){
                             echo Html::a($order_status.'['.$countNum.']','#',['class'=>'label label-danger']);
                         }else if($order_status =='CANCEL'){
                             echo Html::a($order_status.'['.$countNum.']','#',['class'=>'label label-info']);
                         }    
                        ?>
                     </span>
                  </li>
                  <?php 
                     }
                     }
                     ?>
               </ul>
               <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer text-center">
               <a href="javascript:void(0)" class="uppercase">View All Users</a>
               </div> -->
            <!-- /.box-footer -->
         </div>
         <!--/.direct-chat -->
      </div>
    <?php
       }
    ?>  

    <?php 
    if(Yii::$app->user->can('show_assignment_orders_c_c') || Yii::$app->user->can('show_dashbaord1') )
       {
    ?>
      <!-- /.col -->
      <div class="col-md-6">
         <!-- USERS LIST -->
         <div class="box box-danger">
            <div class="box-header with-border">
               <h4 class="box-title"><?=Yii::t('app', 'DAILY_DELIVERY_ASSIGNMENT_TITLE1')?></h4>
               <div class="box-tools pull-right">
                  <!-- <span class="label label-danger">8 New Members</span> -->
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
               <ul class="users-list clearfix">
                  <?php 
                     foreach ($lastDeliveryManOrdersStatus as $itemModel) {
                        $order_status = $itemModel['order_status'];
                         if($order_status=='OPEN' || $order_status=='RE-OPEN' || $order_status=='PENDING'){
                           $countNum = $itemModel['countNum'];
                           $username = $itemModel['username'];
                           $photo = $itemModel['photo'];
                          
                           $photo = "dist/img/".$photo;
                           $photo = (empty($itemModel['photo']))?"dist/img/user8-128x128.jpg":$photo;
                      ?>
                  <li>
                     <img src="<?=$photo;?>" alt="User Image">
                     <a class="users-list-name" href="#"><?=$username;?></a>
                     <span class="users-list-date">
                     <?php
                        if($order_status =='OPEN'){
                            echo Html::a($order_status.'['.$countNum.']','#',['class'=>'label label-success']);
                        }if($order_status =='RE-OPEN'){
                            echo Html::a($order_status.'['.$countNum.']','#',['class'=>'label label-success']);
                        }else if($order_status =='PENDING'){
                            echo Html::a($order_status.'['.$countNum.']','#',['class'=>'label label-warning']);
                        }  
                        ?>
                     </span>
                  </li>
                  <?php 
                     }
                     }
                     ?>
               </ul>
               <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <!--  <div class="box-footer text-center">
               <a href="javascript:void(0)" class="uppercase">View All Users</a>
               </div>-->
            <!-- /.box-footer -->
         </div>
         <!--/.box -->
      </div>
     <?php
       }
       ?> 
      <!-- /.col -->
   </div>
   <!-- /.row -->
   <br/>
   <?php 
    if(Yii::$app->user->can('show_latest_product_report') || Yii::$app->user->can('show_dashbaord1') )
       {
    ?>
   <!-- TABLE: LATEST ORDERS -->
   <div class="box box-info">
      <div class="box-header with-border">
         <h3 class="box-title"><?=Yii::t('app', 'LATEST_ORDER')?></h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
         </div>
      </div>
      <!-- /.box-header -->
      <?php 
         $models =$latestOrderdataProvider->getModels();
         ?>
      <div class="box-body">
         <div class="table-responsive">
            <table class="table no-margin">
               <thead>
                  <tr>
                     <th><?=Yii::t('app', 'ORDER_ID')?></th>
                     <th><?=Yii::t('app', 'PRICE')?> (<?=Yii::$app->params['currency'];?>)</th>
                     <th><?=Yii::t('app', 'ORDER_STATUS')?></th>
                     <th><?=Yii::t('app', 'ORDER_DATE')?></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     foreach ($models as $orderModel) {
                         $id = $orderModel['id'];
                         $url = 'index.php?r=order-items/details&id='.$id;
                     ?>    
                  <tr>
                     <td><a href="<?php echo $url; ?>"><?= $id ?></a></td>
                     <td><?= $orderModel['total']; ?></td>
                     <td>
                        <?php
                           if($orderModel['order_status'] =='OPEN'){
                               echo Html::a('OPEN','#',['class'=>'label label-success']);
                           }if($orderModel['order_status'] =='RE-OPEN'){
                               echo Html::a('RE-OPEN','#',['class'=>'label label-success']);
                           }else if($orderModel['order_status'] =='CLOSED'){
                               echo Html::a('CLOSED','#',['class'=>'label label-danger']);
                           }else if($orderModel['order_status'] =='PENDING'){
                               echo Html::a('PENDING','#',['class'=>'label label-warning']);
                           }else if($orderModel['order_status'] =='CANCEL'){
                               echo Html::a('CANCEL','#',['class'=>'label label-info']);
                           }    
                           ?>
                     <td><?= $orderModel['created_at'] ?></td>
                  </tr>
                  <?php      
                     } 
                     ?>
               </tbody>
            </table>
         </div>
         <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
         <a href="index.php?r=orders" class="btn btn-sm btn-default btn-flat pull-right"><?=Yii::t('app', 'VIEW_ALL_ORDERS')?></a>
      </div>
      <!-- /.box-footer -->
   </div>
   <?php
       }
   ?>
   <!-- /.box -->
</div>
<!-- /.col -->
 <?php 
    if(Yii::$app->user->can('show_products_sales_chart') || Yii::$app->user->can('show_dashbaord1') )
       {
 ?>
      <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <!-- /.info-box -->
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><?=Yii::t('app', 'PRODUCT_SALES')?></h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                        <canvas id="pieChart"  height="250"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                        <?php
                          $nameArray = ArrayHelper::getColumn($dailyItemsAmountSeries, 'name');
                          $arNameArray = ArrayHelper::getColumn($dailyItemsAmountSeries, 'ar_name');
                          $dailyItemsAmount = ArrayHelper::getColumn($dailyItemsAmountSeries, 'sumTotal');
                          $dailyItemsAmount = array_map('intval', $dailyItemsAmount );
                          $colorClassArray = ['text-red','text-green','text-yellow','text-aqua','text-light-blue','text-gray'];
                          $i = 0;
                          foreach ($nameArray as $name) {
                            if($i>=6)
                              break;
                            $displayName = (Yii::$app->language == 'ar')?$arNameArray[$i]:$name;
                          ?>
                        <li><i class="fa fa-circle-o <?=$colorClassArray[$i]?>"></i><?='('.$dailyItemsAmount[$i].') '.$displayName?></li>
                        <?php
                          $i++;
                          }
                          ?>      
                    </ul>
                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                </li>
                <li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
              </ul>
              </div> -->
            <!-- /.footer -->
        </div>
        <br/>
     <?php
       }
   ?> 
<?php 
  if(Yii::$app->user->can('show_percentage_orders_chart') || Yii::$app->user->can('show_dashbaord1') )
    {
?>
   <div class="col-md-12">
      <div class="info-box bg-green">
         <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'OPEN_ORDERS');?></span>
            <span class="info-box-number"><?=$openOrdersSum.'/'.$openOrdersSumM?> <?=Yii::$app->params['currency'];?></span>
            <div class="progress">
               <div class="progress-bar" style="width: 
                  <?php $digit = ($openOrdersSumM==0)?0:($openOrdersSum/$openOrdersSumM);
                     $digit = number_format((float)$digit, 2, '.', '');                                  
                     $digit =  $digit * 100;
                     echo $digit;
                     ?>%">
               </div>
            </div>
            <span class="progress-description">
            <?=$digit?>% <?=Yii::t('app', 'DURING');?> <?=$currentMonth.'-'.$currentYear?>
            </span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <div class="info-box bg-yellow">
         <span class="info-box-icon"><i class="fa fa-arrow-circle-right"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'PENDING_ORDERS');?></span>
            <span class="info-box-number"><?=$pendingOrderSum.'/'.$pendingOrderSumM?> <?=Yii::$app->params['currency'];?></span>
            <div class="progress">
               <div class="progress-bar" style="width: 
                  <?php $digit = ($pendingOrderSumM==0)?$pendingOrderSumM:($pendingOrderSum/$pendingOrderSumM);
                     $digit = number_format((float)$digit, 2, '.', '');                                  
                     $digit =  $digit * 100;
                     echo $digit;
                     ?>%">
               </div>
            </div>
            <span class="progress-description">
            <?=$digit?>% <?=Yii::t('app', 'DURING');?> <?=$currentMonth.'-'.$currentYear?>
            </span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <!-- /.info-box -->
      <div class="info-box bg-aqua">
         <span class="info-box-icon"><i class="fa fa-times"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'CANCEL_ORDERS');?></span>
            <span class="info-box-number"><?=$cancelOrderSum.'/'.$cancelOrderSumM?> <?=Yii::$app->params['currency'];?></span>
            <div class="progress">
               <div class="progress-bar" style="width: 
                  <?php $digit = ($cancelOrderSumM==0)?0:($cancelOrderSum/$cancelOrderSumM);
                     $digit = number_format((float)$digit, 2, '.', '');                                  
                     $digit =  $digit * 100;
                     echo $digit;
                     ?>%">
               </div>
            </div>
            <span class="progress-description">
            <?=$digit?>% <?=Yii::t('app', 'DURING');?> <?=$currentMonth.'-'.$currentYear?>
            </span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <div class="info-box bg-red">
         <span class="info-box-icon"><i class="fa fa-check-circle-o"></i></span>
         <div class="info-box-content">
            <span class="info-box-text"><?=Yii::t('app', 'CLOSED_ORDERS');?></span>
            <span class="info-box-number"><?=$closedOrderSum.'/'.$closedOrderSumM?> <?=Yii::$app->params['currency'];?></span>
            <div class="progress">
               <div class="progress-bar" style="width: 
                  <?php $digit = ($closedOrderSumM==0)?0:($closedOrderSum/$closedOrderSumM);
                     $digit = number_format((float)$digit, 2, '.', '');                                  
                     $digit =  $digit * 100;
                     echo $digit;
                     ?>%">
               </div>
            </div>
            <span class="progress-description">
            <?=$digit?>% <?=Yii::t('app', 'DURING');?> <?=$currentMonth.'-'.$currentYear?>
            </span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.box -->
      <br/>
 <?php
       }
   ?> 
<?php 
if(Yii::$app->user->can('show_recently_added_products_report') || Yii::$app->user->can('show_dashbaord1') )
  {
?>
      <!-- PRODUCT LIST -->
      <div class="box box-primary ui-sortable-handle">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'RECENTLY_ADDED_PRODUCTS');?></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
         </div>
         <?php
            Modal::begin([
                    'header'=>'<h4>'.Yii::t('app', 'ITEMS').'</h4>',
                    'options' => [
                        'id' => 'modal',
                        'tabindex' => false] // important for Select2 to work properly
                    ]);
              echo "<div id='modalContent'></div>";
            Modal::end();
            ?>
         <!-- /.box-header -->
         <div class="box-body">
            <ul class="products-list product-list-in-box">
               <?php
                  $models =$latestItemsdataProvider->getModels();
                  foreach ($models as $itemModel) {
                      $id = $itemModel['id'];
                      $url = 'index.php?r=order-items/details&id='.$id;
                      $name = (Yii::$app->language == 'ar')?$itemModel['ar_name']:$itemModel['name'];
                      $desc = $itemModel['description'];
                      $price = $itemModel['price'].' '.Yii::$app->params['currency'];
                      $photo = "images/items/".$id."/".$itemModel['photo'];
                      $photo = (empty($itemModel['photo']))?"dist/img/default-50x50.gif":$photo;
                      $updated_at = $itemModel['updated_at'];
                  ?> 
               <li class="item">
                  <div class="product-img">
                     <img src="<?=$photo;?>">
                  </div>
                  <div class="product-info">
                     <?= Html::a($name,'#', ['value'=>Url::to('index.php?r=items/view&id='.$id),'class'=>'product-title','id'=>'viewModalButton'.$id,'onclick'=>'return showViewModal('.$id.')']); ?>
                     <span class="label label-warning <?php if(Yii::$app->language == 'ar') { echo "pull-left";}else{echo "pull-right";}?>"><?=$price;?></span></a>
                     <span class="product-description">
                     <?=$updated_at;?>
                     </span>
                  </div>
               </li>
               <?php } ?>
               <!-- /.item -->
            </ul>
         </div>
         <!-- /.box-body -->
         <div class="box-footer text-center">
            <a href="index.php?r=items" class="uppercase"><?=Yii::t('app', 'VIEW_ALL_PRODUCTS')?></a>
         </div>
         <!-- /.box-footer -->
      </div>
      <!-- /.box -->
<?php
  }
?>      
   </div>
   <!-- /.col -->
</div>
<!-- /.row -->

<?php 
if(Yii::$app->user->can('show_products_sales_chart') || Yii::$app->user->can('show_dashbaord1') )
{
?>
<?php  
  $seriesValues=[0,0,0,0,0,0];
  $seriesNamesValues=['','','','','',''];
  $j=0;
  foreach ($dailyItemsAmount as $variable) {
    $seriesValues[$j] = $variable;
    $seriesNamesValues[$j] = (Yii::$app->language == 'ar')?$arNameArray[$j]:$nameArray[$j];
    $j++;
  }
  $script = <<< JS

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: $seriesValues[0],
        color: "#f56954",
        highlight: "#f56954",
        label: "$seriesNamesValues[0]"
      },
      {
       value: $seriesValues[1],
        color: "#00a65a",
        highlight: "#00a65a",
        label: "$seriesNamesValues[1]"
      },
      {
        value: $seriesValues[2],
        color: "#f39c12",
        highlight: "#f39c12",
        label: "$seriesNamesValues[2]"
      },
      {
        value: $seriesValues[3],
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "$seriesNamesValues[3]"
      },
      {
        value: $seriesValues[4],
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "$seriesNamesValues[4]"
      },
      {
        value: $seriesValues[5],
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "$seriesNamesValues[5]"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 1,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: false,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      //String - A tooltip template
      tooltipTemplate: "<%=value %> <%=label%>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    //-----------------
    //- END PIE CHART -
    //-----------------

    /* jVector Maps
    * ------------
    * Create a world map with markers
    */
JS;
$this->registerJs($script);
}
?>