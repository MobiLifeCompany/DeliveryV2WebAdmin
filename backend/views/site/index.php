<?php
  $this->title = Yii::t('app', 'Home');

  $curpage = Yii::$app->controller->id;
  $this->params['currentPage'] = $curpage;
?>

<div  style="text-align:center;">
  <h2> <?php echo Yii::t('app', 'HOME_MESSAGE');?> </h2>
  <br/>
  <img src="dist/img/logo.png" class="img-circle" alt="DE Logo" width="400px" height="400px">
</div> 