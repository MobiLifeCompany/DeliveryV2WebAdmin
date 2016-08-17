<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'TOP_TEN_DASHBOARDS');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;

?>
<div class="row">
   <div class="col-md-5">
      <div class="box box-danger">
         <!-- /.box-header -->
         <div class="box-header with-border">
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <div class="btn-group">
               </div>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <?= GridView::widget([
                        'dataProvider' => $topTenItemsAmount,
                        'summary'=>"",
                        'showPageSummary' => false,
                        'autoXlFormat'=>true,
                        'export'=>[
                            'fontAwesome'=>true,
                            'showConfirmAlert'=>false,
                            'target'=>GridView::TARGET_BLANK
                        ],
                        'panel'=>[
                            'type'=>'primary',
                            'heading'=> Yii::t('app', 'TOP_TEN_ITEM_REPORT'),
                            'footer' =>false,
                        ],
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' => 'item_name',
                                'value'=>'item_name',
                                'width'=>'250px',
                                'hAlign'=>'middle',
                                'pageSummary'=>'Report Summary',
                                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                            ],
                            [
                                'attribute' => 'total',
                                'value'=>'total',
                                'width'=>'50px',
                                'hAlign'=>'middle',
                                'format'=>['decimal', 2],
                                'pageSummary'=>true,
                                'pageSummaryFunc'=>GridView::F_SUM
                                
                            ],
                        ],
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
   <div class="col-md-7">
      <div class="box box-danger">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'TOP_TEN_ITEM_CHART');?></h3>
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
                      $currentYear = date('Y');;
                      $currentMonth = date('F');;
                      $data =$topTenItemsAmount->getModels();
                      $items = ArrayHelper::getColumn($data, 'item_name');
                      $sumTotal = ArrayHelper::getColumn($data, 'total');
                      $sumTotal = array_map('intval', $sumTotal );
                    ?>
                    <?=
                          \dosamigos\highcharts\HighCharts::widget([
                              'clientOptions' => [
                                  'chart' => [
                                          'type' => 'bar',
                                          'width' => 600,
                                          'height' => 520,
                                  ],
                                  'title' => [
                                      'text' => 'Top Ten Items Amount '.$currentYear
                                      ],
                                  'xAxis' => [
                                      'categories' =>  $items
                                  ],
                                  'yAxis' => [
                                      'title' => [
                                          'text' => 'Amount'
                                      ]
                                  ],
                                  'series' => [
                                      ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
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
</div>
<br/>
<div class="row">
   <div class="col-md-5">
      <div class="box box-primary">
         <div class="box-header with-border">
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
                   <?= GridView::widget([
                        'dataProvider' => $topTenShopsAmount,
                        'summary'=>"",
                        'showPageSummary' => false,
                        'autoXlFormat'=>true,
                        'export'=>[
                            'fontAwesome'=>true,
                            'showConfirmAlert'=>false,
                            'target'=>GridView::TARGET_BLANK
                        ],
                        'panel'=>[
                            'type'=>'primary',
                            'heading'=> Yii::t('app', 'TOP_TEN_SHOP_REPORT'),
                            'footer' =>false,
                        ],
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' => 'shop_name',
                                'value'=>'shop_name',
                                'width'=>'250px',
                                'hAlign'=>'middle',
                                'pageSummary'=>'Report Summary',
                                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                            ],
                            [
                                'attribute' => 'total',
                                'value'=>'total',
                                'width'=>'50px',
                                'hAlign'=>'middle',
                                'format'=>['decimal', 2],
                                'pageSummary'=>true,
                                'pageSummaryFunc'=>GridView::F_SUM
                                
                            ],
                        ],
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
   <div class="col-md-7">
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'TOP_TEN_SHOP_REPORT');?></h3>
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
                      $currentYear = date('Y');;
                      $currentMonth = date('F');;
                      $data =$topTenShopsAmount->getModels();
                      $shops = ArrayHelper::getColumn($data, 'shop_name');
                      $sumTotal = ArrayHelper::getColumn($data, 'total');
                      $sumTotal = array_map('intval', $sumTotal );
                    ?>
                    <?=
                          \dosamigos\highcharts\HighCharts::widget([
                              'clientOptions' => [
                                  'chart' => [
                                          'type' => 'bar',
                                          'width' => 600,
                                          'height' => 520,
                                  ],
                                  'title' => [
                                      'text' => 'Top Ten Shops Amount '.$currentYear
                                      ],
                                  'xAxis' => [
                                      'categories' =>  $shops
                                  ],
                                  'yAxis' => [
                                      'title' => [
                                          'text' => 'Amount'
                                      ]
                                  ],
                                  'series' => [
                                      ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
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
</div>
<br/>
<div class="row">
   <div class="col-md-5">
      <div class="box box-info">
         <div class="box-header with-border">
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
                  <?= GridView::widget([
                        'dataProvider' => $topTenCustomersAmount,
                        'summary'=>"",
                        'showPageSummary' => false,
                        'autoXlFormat'=>true,
                        'export'=>[
                            'fontAwesome'=>true,
                            'showConfirmAlert'=>false,
                            'target'=>GridView::TARGET_BLANK
                        ],
                        'panel'=>[
                            'type'=>'primary',
                            'heading'=> Yii::t('app', 'TOP_TEN_CUSTOMER_REPORT'),
                            'footer' =>false,
                        ],
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' => 'customer_name',
                                'value'=>'customer_name',
                                'width'=>'250px',
                                'hAlign'=>'middle',
                                'pageSummary'=>'Report Summary',
                                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                            ],
                            [
                                'attribute' => 'total',
                                'value'=>'total',
                                'width'=>'50px',
                                'hAlign'=>'middle',
                                'format'=>['decimal', 2],
                                'pageSummary'=>true,
                                'pageSummaryFunc'=>GridView::F_SUM
                                
                            ],
                        ],
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
    <div class="col-md-7">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'TOP_TEN_CUSTOMER_CHART');?></h3>
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
                      $currentYear = date('Y');;
                      $currentMonth = date('F');;
                      $data =$topTenCustomersAmount->getModels();
                      $customers = ArrayHelper::getColumn($data, 'customer_name');
                      $sumTotal = ArrayHelper::getColumn($data, 'total');
                      $sumTotal = array_map('intval', $sumTotal );
                    ?>
                    <?=
                          \dosamigos\highcharts\HighCharts::widget([
                              'clientOptions' => [
                                  'chart' => [
                                          'type' => 'bar',
                                          'width' => 600,
                                          'height' => 520,
                                  ],
                                  'title' => [
                                      'text' => 'Top Ten Customers Amount '.$currentYear
                                      ],
                                  'xAxis' => [
                                      'categories' =>  $customers
                                  ],
                                  'yAxis' => [
                                      'title' => [
                                          'text' => 'Amount'
                                      ]
                                  ],
                                  'series' => [
                                      ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
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
</div>
<br/>
<div class="row">
   <div class="col-md-5">
      <div class="box box-success">
         <div class="box-header with-border">
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
                  <?= GridView::widget([
                        'dataProvider' => $topTenMonthDaysAmount,
                        'summary'=>"",
                        'showPageSummary' => false,
                        'autoXlFormat'=>true,
                        'export'=>[
                            'fontAwesome'=>true,
                            'showConfirmAlert'=>false,
                            'target'=>GridView::TARGET_BLANK
                        ],
                        'panel'=>[
                            'type'=>'primary',
                            'heading'=> Yii::t('app', 'TOP_TEN_MONTHLY_DATES_REPORT'),
                            'footer' =>false,
                        ],
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' => 'monthDate',
                                'value'=>'monthDate',
                                'width'=>'250px',
                                'hAlign'=>'middle',
                                'pageSummary'=>'Report Summary',
                                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                            ],
                            [
                                'attribute' => 'total',
                                'value'=>'total',
                                'width'=>'50px',
                                'hAlign'=>'middle',
                                'format'=>['decimal', 2],
                                'pageSummary'=>true,
                                'pageSummaryFunc'=>GridView::F_SUM
                                
                            ],
                        ],
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
   <div class="col-md-7">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'TOP_TEN_MONTHLY_DATES_CHART');?></h3>
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
                      $currentYear = date('Y');;
                      $currentMonth = date('F');;
                      $data =$topTenMonthDaysAmount->getModels();
                      $monthDate = ArrayHelper::getColumn($data, 'monthDate');
                      $sumTotal = ArrayHelper::getColumn($data, 'total');
                      $sumTotal = array_map('intval', $sumTotal );
                    ?>
                    <?=
                          \dosamigos\highcharts\HighCharts::widget([
                              'clientOptions' => [
                                  'chart' => [
                                          'type' => 'bar',
                                          'width' => 600,
                                          'height' => 520,
                                  ],
                                  'title' => [
                                      'text' => 'Top Ten Daily Month Amount ('.$currentMonth.'-'.$currentYear.')'
                                      ],
                                  'xAxis' => [
                                      'categories' =>  $monthDate
                                  ],
                                  'yAxis' => [
                                      'title' => [
                                          'text' => 'Amount'
                                      ]
                                  ],
                                  'series' => [
                                      ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
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
</div>
<br/>
<div class="row">
   <div class="col-md-5">
      <div class="box box-warning">
         <div class="box-header with-border">
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
                   <?= GridView::widget([
                        'dataProvider' => $topTenMonthlyAmount,
                        'summary'=>"",
                        'showPageSummary' => false,
                        'autoXlFormat'=>true,
                        'export'=>[
                            'fontAwesome'=>true,
                            'showConfirmAlert'=>false,
                            'target'=>GridView::TARGET_BLANK
                        ],
                        'panel'=>[
                            'type'=>'primary',
                            'heading'=> Yii::t('app', 'TOP_TEN_MONTHLY_CHART'),
                            'footer' =>false,
                        ],
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' => 'month',
                                'value'=>'month',
                                'width'=>'250px',
                                'hAlign'=>'middle',
                                'pageSummary'=>'Report Summary',
                                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                            ],
                            [
                                'attribute' => 'total',
                                'value'=>'total',
                                'width'=>'50px',
                                'hAlign'=>'middle',
                                'format'=>['decimal', 2],
                                'pageSummary'=>true,
                                'pageSummaryFunc'=>GridView::F_SUM
                                
                            ],
                        ],
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
    <div class="col-md-7">
      <div class="box box-warning">
         <div class="box-header with-border">
            <h3 class="box-title"><?=Yii::t('app', 'TOP_TEN_MONTHLY_REPORT');?></h3>
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
                      $currentYear = date('Y');;
                      $currentMonth = date('F');;
                      $data =$topTenMonthlyAmount->getModels();
                      $monthDate = ArrayHelper::getColumn($data, 'month');
                      $sumTotal = ArrayHelper::getColumn($data, 'total');
                      $sumTotal = array_map('intval', $sumTotal );
                    ?>
                    <?=
                          \dosamigos\highcharts\HighCharts::widget([
                              'clientOptions' => [
                                  'chart' => [
                                          'type' => 'bar',
                                          'width' => 600,
                                          'height' => 520,
                                  ],
                                  'title' => [
                                      'text' => 'Top Ten Monthly Amount ('.$currentMonth.'-'.$currentYear.')'
                                      ],
                                  'xAxis' => [
                                      'categories' =>  $monthDate
                                  ],
                                  'yAxis' => [
                                      'title' => [
                                          'text' => 'Amount'
                                      ]
                                  ],
                                  'series' => [
                                      ['name' => Yii::t('app', 'AMOUNT'), 'data' =>  $sumTotal],
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
</div>
