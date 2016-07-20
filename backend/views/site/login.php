<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Delivery Express Admin | Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box">
        <div class="login-logo">
            <p><img src="dist/img/logo.png" class="img-circle" alt="User Image"></p>
            <b>Delivery Express</b> <small>Admin</small></a>
        </div>
        <div class="login-box-body">
            <div class="login-box-message"> Sign In to Start Your Work</div>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username',['options'=>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-username has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span> {error}{hint}'
                        
                    ])->textInput(['autofocus' => true]) ?>

                     <?= $form->field($model, 'password',['options'=>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-password has-feedback required'
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> {error}{hint}'   
                    ])->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
