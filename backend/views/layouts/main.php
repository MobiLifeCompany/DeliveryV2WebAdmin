<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\AppAssetRTL;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

if(Yii::$app->language == 'ar')
    AppAssetRTL::register($this);
else
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="
                      <?php
        if(Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN'
            || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
        { echo 'index.php';}
        else{ echo 'index.php?r=dashboards/dashboard1';}?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>DE</b>A</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><small>Delivery Express Admin</small></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less
                    <li class="dropdown messages-menu">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       <i class="fa fa-envelope-o"></i>
                       <span class="label label-success">4</span>
                       </a>
                       <ul class="dropdown-menu">
                          <li class="header">You have 4 messages</li>
                          <li>
                             <!-- inner menu: contains the actual data
                             <ul class="menu">
                                <li>
                                   <!-- start message
                                   <a href="#">
                                      <div class="pull-left">
                                         <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                         Support Team
                                         <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                   </a>
                                </li>
                                <!-- end message
                                <li>
                                   <a href="#">
                                      <div class="pull-left">
                                         <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                         AdminLTE Design Team
                                         <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                   </a>
                                </li>
                                <li>
                                   <a href="#">
                                      <div class="pull-left">
                                         <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                         Developers
                                         <small><i class="fa fa-clock-o"></i> Today</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                   </a>
                                </li>
                                <li>
                                   <a href="#">
                                      <div class="pull-left">
                                         <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                         Sales Department
                                         <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                   </a>
                                </li>
                                <li>
                                   <a href="#">
                                      <div class="pull-left">
                                         <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                         Reviewers
                                         <small><i class="fa fa-clock-o"></i> 2 days</small>
                                      </h4>
                                      <p>Why not buy a new awesome theme?</p>
                                   </a>
                                </li>
                             </ul>
                          </li>
                          <li class="footer"><a href="#">See All Messages</a></li>
                       </ul>
                    </li>-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning" id="dropdown-pending-orders-count"></span>
                        </a>
                        <ul class="dropdown-menu" id="dropdown-pending-orders-content">

                        </ul>
                    </li>

                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-success" id="dropdown-open-orders-count"></span>
                        </a>
                        <ul class="dropdown-menu" id="dropdown-open-orders-content">

                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-language"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- inner menu: Languages -->
                                <ul class="menu">
                                    <li>
                                        <a href="#" class="language" id="en">
                                            <i  class="fa fa-cubes text-aqua" > </i>English
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="language" id="ar">
                                            <i  class="fa fa-user text-red" > </i>Arabic
                                        </a>
                                    </li>
                                </ul>
                                <!-- inner menu: contains the actual data -->
                            </li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less
                    <li class="dropdown tasks-menu">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       <i class="fa fa-flag-o"></i>
                       <span class="label label-danger">9</span>
                       </a>
                       <ul class="dropdown-menu">
                          <li class="header">You have 9 tasks</li>
                          <li>
                             <!-- inner menu: contains the actual data
                             <ul class="menu">
                                <li>
                                   <!-- Task item
                                   <a href="#">
                                      <h3>
                                         Design some buttons
                                         <small class="pull-right">20%</small>
                                      </h3>
                                      <div class="progress xs">
                                         <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">20% Complete</span>
                                         </div>
                                      </div>
                                   </a>
                                </li>
                                <!-- end task item
                                <li>
                                   <!-- Task item
                                   <a href="#">
                                      <h3>
                                         Create a nice theme
                                         <small class="pull-right">40%</small>
                                      </h3>
                                      <div class="progress xs">
                                         <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">40% Complete</span>
                                         </div>
                                      </div>
                                   </a>
                                </li>
                                <!-- end task item
                                <li>
                                   <!-- Task item
                                   <a href="#">
                                      <h3>
                                         Some task I need to do
                                         <small class="pull-right">60%</small>
                                      </h3>
                                      <div class="progress xs">
                                         <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">60% Complete</span>
                                         </div>
                                      </div>
                                   </a>
                                </li>
                                <!-- end task item
                                <li>
                                   <!-- Task item
                                   <a href="#">
                                      <h3>
                                         Make beautiful transitions
                                         <small class="pull-right">80%</small>
                                      </h3>
                                      <div class="progress xs">
                                         <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">80% Complete</span>
                                         </div>
                                      </div>
                                   </a>
                                </li>
                                <!-- end task item
                             </ul>
                          </li>
                          <li class="footer">
                             <a href="#">View all tasks</a>
                          </li>
                       </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= Yii::$app->user->identity->username;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    <?= Yii::$app->session['realUser']['first_name'].' '.Yii::$app->session['realUser']['last_name'];;?> - <?= Yii::$app->session['realUser']['user_type'];?>
                                    <small>Member since  <?= Yii::$app->formatter->asDate(Yii::$app->session['realUser']['created_at'], 'php:Y-m-d');?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- <li class="user-body">
                               <div class="row">
                                  <div class="col-xs-4 text-center">
                                     <a href="#">Followers</a>
                                  </div>
                                  <div class="col-xs-4 text-center">
                                     <a href="#">Sales</a>
                                  </div>
                                  <div class="col-xs-4 text-center">
                                     <a href="#">Friends</a>
                                  </div>
                               </div>
                               < /.row
                            </li> -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php?r=user/profile&id=<?=Yii::$app->session['realUser']['id']?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <?php
                                $menuItems = ''
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout',
                                        ['class' => 'btn btn-default btn-flat']
                                    )
                                    . Html::endForm()
                                    . '';
                                ?>
                                <div class="pull-right">
                                    <?php echo $menuItems; ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel is-rtl">
                <div class="pull-left image">
                    <img src="dist/img/logo.png" class="img-circle" alt="DE Logo">
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->username;?></p>
                    <?php if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                            Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                        && ( Yii::$app->session['realUser']['live_status']=='On-Line')) { ?>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    <?php } else if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                            Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                        && ( Yii::$app->session['realUser']['live_status']=='Off-Line')) {  ?>
                        <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                    <?php } else { ?>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    <?php }
                    ?>
                    <?php if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                            Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                        && ( Yii::$app->session['realUser']['work_status']=='Ready')) { ?>
                        <a href="#"><i class="fa fa-square text-blue"></i> Ready</a>
                    <?php } else if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                            Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                        && ( Yii::$app->session['realUser']['work_status']=='Waiting')) {  ?>
                        <a href="#"><i class="fa fa-square text-yellow"></i> Waiting</a>
                    <?php }
                    ?>
                </div>
            </div>
            <div class="user-panel is-ltr">
                <div class="pull-right image">
                    <img src="dist/img/logo.png" class="img-circle" alt="DE Logo">
                </div>
                <div class="pull-right info">
                    <p><?= Yii::$app->user->identity->username;?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form
            <form action="#" method="get" class="sidebar-form">
               <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                  </span>
               </div>
            </form>
             /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"><?= Yii::t('app', 'MAIN_NAVIGATION') ?></li>

                <!-- BEGIN OF USER Dashboard ITEM -->
                <?php
                if((Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN') && (Yii::$app->user->can('show_dashboard1') || Yii::$app->user->can('show_dashboard3') || Yii::$app->user->can('show_dashboard3')))
                {
                    ?>
                    <li class="treeview  <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='dashboards')){
                        echo "active";
                    }
                    ?>">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span><?= Yii::t('app', 'DASHBOARDS') ?></span>
                            <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right is-rtl"></i>
                      <i class="fa fa-angle-left pull-left is-ltr"></i>
                      </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->user->can('show_dashboard1'))
                            {
                                ?>
                                <li <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='dashboard1')
                                        echo "class='active'";
                                }
                                ?>><a href="index.php?r=dashboards/dashboard1"><i class="fa fa-circle-o text-yellow"></i> <?= Yii::t('app', 'DASHBOARD') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_dashboard2'))
                            {
                                ?>
                                <li <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='dashboard2')
                                        echo "class='active'";
                                }
                                ?>><a href="index.php?r=dashboards/dashboard2"><i class="fa fa-circle-o text-blue"></i> <?= Yii::t('app', 'MAP_DASHBOARD') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN' && Yii::$app->user->can('show_dashboard3'))
                            {
                                ?>
                                <li <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='dashboard3')
                                        echo "class='active'";
                                }
                                ?>><a href="index.php?r=dashboards/dashboard3"><i class="fa fa-circle-o text-green"></i> <?= Yii::t('app', 'TOP_TEN_DASHBOARDS') ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER Dashboard ITEM -->

                <!-- BEGIN OF USER REPORTS ITEM -->
                <?php
                if((Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN') && (Yii::$app->user->can('show_sales_report') || Yii::$app->user->can('show_items_report')))
                {
                    ?>
                    <li class="treeview <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='reports')){
                        echo "active";
                    }
                    ?>" >
                        <a href="#">
                            <i class="fa fa-suitcase"></i> <span><?= Yii::t('app', 'REPORTS') ?></span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right is-rtl"></i>
                        <i class="fa fa-angle-left pull-left is-ltr"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->user->can('show_sales_report'))
                            {
                                ?>
                                <li <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='salesreport')
                                        echo "class='active'";
                                }
                                ?>><a href="index.php?r=reports/salesreport"><i class="fa fa-circle-o text-red"></i> <?= Yii::t('app', 'SALES_REPORT') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_items_report'))
                            {
                                ?>
                                <li <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='itemsreport')
                                        echo "class='active'";
                                }
                                ?>> <a href="index.php?r=reports/itemsreport"><i class="fa fa-circle-o text-green"></i> <?= Yii::t('app', 'ITEMS_REPORT') ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER REPORTS ITEM -->

                <!-- BEGIN OF USER PERMISSION ITEM -->
                <?php
                if((Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN') && (Yii::$app->user->can('show_permission_groups') || Yii::$app->user->can('show_permissions') || Yii::$app->user->can('show_users')))
                {
                    ?>
                    <li class="treeview <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='user' || $this->params['currentPage']=='auth-item' || $this->params['currentPage']=='auth-item-child')){
                        echo "active";
                    }
                    ?>">
                        <a href="#">
                            <i class="fa fa-user"></i> <span><?= Yii::t('app', 'USERS_PERMISSIONS') ?></span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right is-rtl"></i>
                        <i class="fa fa-angle-left pull-left is-ltr"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->user->can('show_users'))
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='user')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=user"><i class="fa fa-user"></i> <?= Yii::t('app', 'USERS') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_permissions'))
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='auth-item')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=auth-item"><i class="fa fa-unlock-alt"></i> <?= Yii::t('app', 'PERMISSIONS') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_permission_groups'))
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='auth-item-child')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=auth-item-child"><i class="fa fa-users"></i> <?= Yii::t('app', 'PERMISSIONS_GROUP') ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER PERMISSION ITEM -->

                <!-- BEGIN OF USER LOGISTICS ITEM -->
                <?php
                if((Yii::$app->user->can('show_countries') || Yii::$app->user->can('show_cities') || Yii::$app->user->can('show_areas') || Yii::$app->user->can('show_shops')))
                {
                    ?>
                    <li class="treeview  <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='countries' || $this->params['currentPage']=='cities' || $this->params['currentPage']=='areas' || $this->params['currentPage']=='businesses'  ||  $this->params['currentPage']=='shops')){
                        echo "active";
                    }
                    ?>">
                        <a href="#">
                            <i class="fa fa-map"></i> <span><?= Yii::t('app', 'LOGISTICS') ?></span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right is-rtl"></i>
                        <i class="fa fa-angle-left pull-left is-ltr"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->user->can('show_businesses') && Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='businesses')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=businesses"><i class="fa fa-usd"></i> <?= Yii::t('app', 'BUSINESSES') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_countries') && Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='countries')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=countries"><i class="fa fa-globe"></i> <?= Yii::t('app', 'COUNTRIES') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_cities') && Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='cities')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=cities"><i class="fa fa-map-signs"></i> <?= Yii::t('app', 'CITIES') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_areas') && Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='areas')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=areas"><i class="fa fa-map-pin"></i> <?= Yii::t('app', 'AREAS') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->user->can('show_shops') && (Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN'))
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='shops')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=shops"><i class="fa fa-home"></i> <?= Yii::t('app', 'SHOPS') ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER LOGISTICS ITEM -->

                <!-- BEGIN OF Categories and items ITEM -->
                <?php
                if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN')
                {
                    ?>
                    <!-- Categories and items -->
                    <li class="treeview  <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='categories' || $this->params['currentPage']=='items')){
                        echo "active";
                    }
                    ?>">
                        <a href="#">
                            <i class="fa fa-sitemap"></i> <span><?= Yii::t('app', 'PRODUCTS') ?></span>
                            <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right is-rtl"></i>
                      <i class="fa fa-angle-left pull-left is-ltr"></i>
                      </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='categories')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=item-categories"><i class="fa fa-object-group"></i> <?= Yii::t('app', 'CATEGORIES') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='items')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=items"><i class="fa fa-list-ul"></i> <?= Yii::t('app', 'ITEMS') ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER LOGISTICS ITEM -->

                <!-- BEGIN OF Customers and Orders items ITEM -->
                <?php
                if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN')
                {
                    ?>
                    <!-- Customers and Orders -->
                    <li class="treeview <?php
                    if(isset($this->params['currentPage']) && ($this->params['currentPage']=='customers' || $this->params['currentPage']=='customer-addresses'  || $this->params['currentPage']=='orders' || $this->params['currentPage']=='order-items')){
                        echo "active";
                    }
                    ?>">
                        <a href="#">
                            <i class="fa fa-cart-plus"></i> <span><?= Yii::t('app', 'ORDERS') ?></span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right is-rtl"></i>
                        <i class="fa fa-angle-left pull-left is-ltr"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                            if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='customers')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=customers"><i class="fa fa-user"></i> <?= Yii::t('app', 'CUSTOMERS') ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                            {
                                ?>
                                <li
                                    <?php
                                    if(isset($this->params['currentPage'])){
                                        if($this->params['currentPage']=='customer-addresses')
                                            echo "class='active'";
                                    }
                                    ?>
                                ><a href="index.php?r=customer-addresses"><i class="fa fa-building-o"></i> <?= Yii::t('app', 'CUSTOMERS_ADDRESSES') ?></a></li>
                                <?php
                            }
                            ?>
                            <li
                                <?php
                                if(isset($this->params['currentPage'])){
                                    if($this->params['currentPage']=='orders')
                                        echo "class='active'";
                                }
                                ?>
                            ><a href="index.php?r=orders"><i class="fa fa-shopping-basket"></i> <?= Yii::t('app', 'ORDERS') ?></a></li>
                            <li
                                <?php
                                if(isset($this->params['currentPageAction'])){
                                    if($this->params['currentPageAction']=='workingorders')
                                        echo "class='active'";
                                }
                                ?>
                            ><a href="index.php?r=orders/workingorders"><i class="fa fa-shopping-basket"></i> <?= Yii::t('app', 'WORKING_ORDERS') ?></a></li>
                            <li
                                <?php
                                if(isset($this->params['currentPage'])){
                                    if($this->params['currentPage']=='order-items')
                                        echo "class='active'";
                                }
                                ?>
                            ><a href="index.php?r=order-items"><i class="fa fa-cart-plus"></i> <?= Yii::t('app', 'ORDERS_ITEMS') ?></a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <!-- END OF USER Customers and Orders ITEM -->

                <!-- BEGIN OF USER PERMISSION ITEM -->
                <?php
                if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
                {
                    ?>
                    <li
                        <?php
                        if(isset($this->params['currentPage'])){
                            if($this->params['currentPage']=='shop-offers')
                                echo "class='active'";
                        }
                        ?>
                    >
                        <a href="index.php?r=shop-offers"><i class="fa fa-tags"></i> <span> <?= Yii::t('app', 'SHOPS_OFFERS') ?></span></a>
                    </li>
                    <li
                        <?php
                        if(isset($this->params['currentPage'])){
                            if($this->params['currentPage']=='shop-rates')
                                echo "class='active'";
                        }
                        ?>
                    >
                        <a href="index.php?r=shop-rates"><i class="fa fa-star-half-o"></i> <span> <?= Yii::t('app', 'SHOPS_RATING') ?></span></a>
                    </li>
                    <li
                        <?php
                        if(isset($this->params['currentPage'])){
                            if($this->params['currentPage']=='contact-us')
                                echo "class='active'";
                        }
                        ?>
                    >
                        <a href="index.php?r=contact-us"><i class="fa fa-envelope"></i> <span> <?= Yii::t('app', 'CONTACT_US') ?></span></a>
                    </li>
                    <?php
                    if(Yii::$app->user->can('show_push_notification')){
                        ?>
                        <li
                            <?php
                            if(isset($this->params['currentPage'])){
                                if($this->params['currentPage']=='push-notification')
                                    echo "class='active'";
                            }
                            ?>
                        >
                            <a href="index.php?r=site/push-notification"><i class="fa fa-rocket"></i> <span> <?= Yii::t('app', 'GLOBAL_PUSH_NOTIFICATION') ?></span></a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=Yii::t('app', 'DELIVERY_EXPRESS')?>
                <small><?=Yii::t('app', 'CONTROL_PANEL')?></small>
            </h1>
            <ol class="breadcrumb" style="background-color:#ecf0f5">
                <li>
                    <?php
                    echo Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => Yii::t('app', 'DASHBOARD'),
                            'url' => Yii::$app->homeUrl,
                            'links'			=> isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'tag'		=>'ul', // container tag
                            'htmlOptions'	=>[], // no attributes on container
                            'separator'		=>'', // no separator
                            'homeLink'		=>'<li><a href="'.Yii::$app->homeUrl.'">Home</a></li>', // home link template
                            'activeLinkTemplate'	=>'<li><a href="{url}">{label}</a></li>', // active link template
                            'inactiveLinkTemplate'	=>'<li class="selected"><a>{label}</a></li>', // in-active link template
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <?= $content ?>
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b><?=Yii::t('app', 'VERSION');?></b> <?=Yii::t('app', 'VERSION_NO');?>
        </div>
        <strong> <?=Yii::t('app', 'COPY_RIGHT');?>  &copy; 2015-<?= date('Y');?>  <a href="http://www.mobilifeco.com/">MobiLife Co </a>.</strong> <?=Yii::t('app', 'COPY_RESERVED');?>
    </footer>
    <!-- Control Sidebar -->
</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php

$checkNewOrdersScript = <<< JS
var checkNewOrders_call = function() {
        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "index.php?r=site/checktopmenuorders",             
            dataType: "text",   //expect html to be returned                
            success: function(response)
            {    
               // alert(response);
                var n = response.indexOf("-");
                openOrdersCount = response.substring(0,n);
                pendingOrdersCount = response.substring(n+1);
                
                if(parseInt(openOrdersCount)!=0){
                    $('#dropdown-open-orders-count').html(openOrdersCount);
                    $('#dropdown-open-orders-content').html('<li class="header">You have '+openOrdersCount+' Open Orders</li>'+
                                                      '<li class="footer"><a href="index.php?r=orders/workingorders">View all</a></li>');
                }
                 if(parseInt(pendingOrdersCount)!=0){
                    $('#dropdown-pending-orders-count').html(pendingOrdersCount);
                    $('#dropdown-pending-orders-content').html('<li class="header">You have '+pendingOrdersCount+' Pending Orders</li>'+
                                                      '<li class="footer"><a href="index.php?r=orders/workingorders">View all</a></li>');
                }
            }
         });
    }
var interval = 1000 * 30 * 1; // where X is your every X minutes
setInterval(checkNewOrders_call, interval);

checkNewOrders_call();
JS;
$this->registerJs($checkNewOrdersScript);

if(Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN'
    || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN'){
    $locationScript = <<< JS
var saveLocation_call = function() {
navigator.geolocation.getCurrentPosition(
    function(position) {
         $.ajax({ 
            type: "POST",
            url: "index.php?r=user/savelocation",             
            dataType: "text",   //expect html to be returned    
            data:{'lat':position.coords.latitude ,'long':position.coords.longitude},            
            success: function (response) {
              //alert(response);                
           }
         });
    },
    function(error){
         //alert(error.message);
    }, {
         enableHighAccuracy: true
              ,timeout : 5000
    }
);
}
var interval = 1000 * 60 * 2; // where X is your every X minutes
setInterval(saveLocation_call, interval);
JS;
    $this->registerJs($locationScript);
}

if(Yii::$app->session['realUser']['show_notification']=='Yes'){
    $script = <<< JS
isRequested = true;
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

      // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "NMOS";
}


var ajax_call = function() {
  //your jQuery ajax code
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") 
  {
    var OS = getMobileOperatingSystem();
    if(OS == 'NMOS')
    {
          $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "index.php?r=site/checkorders",             
            dataType: "html",   //expect html to be returned                
            success: function(response)
            {    
              //alert(response);  
              if(response!='NO_DATA')
              {               
                  var options = 
                  {
                      body: response,
                      icon: 'dist/img/logo.png',
                      lang: 'en-US',
                  };
                  var audio = new Audio('sound/delivery-tone.mp3');
                  audio.play();
                  // If it's okay let's create a notification
                  var notification = new Notification("Delivery Express", options);
                  notification.onclick = function(event) 
                  {
                      event.preventDefault(); // prevent the browser from focusing the Notification's tab
                      window.open('index.php?r=orders/workingorders', '_self');
                      notification.close();
                  }
              }
            }
         });
      }else{
        $.ajax({    //create an ajax request to load_page.php
            type: "GET",
            url: "index.php?r=site/checkorders",             
            dataType: "html",   //expect html to be returned                
            success: function(response)
            {    
              //alert(response);  
              if(response!='NO_DATA')
              {  
                //if (window.confirm(response)){
                     var audio = new Audio('sound/delivery-tone.mp3');
                     audio.play();
                     //player.pause();
                  //}
                  
                 
              }
            }
         });
      }
  }// Otherwise, we need to ask the user for permission
  else if (Notification.permission !== 'denied' && isRequested) {
    isRequested = false;
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
     // if (permission === "granted") {
      //  var notification = new Notification("Hi Request Grant!");
      //}
    });
  }
};

var interval = 1000 * 60 * 1; // where X is your every X minutes
setInterval(ajax_call, interval);

JS;
    $this->registerJs($script);
}
?>
<?php $this->endPage() ?>
