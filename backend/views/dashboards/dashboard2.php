<?php

$this->title = Yii::t('app', 'Map Dashboard');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;
?>


<?php
  echo 'Map Dashboard2..';
  print_r(Yii::$app->controller->action->id);
?>