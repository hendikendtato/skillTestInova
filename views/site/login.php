<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <div class="row justify-content-md-center">
        <div class="col col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3><?= Html::encode($this->title) ?></h3>
                            
                        </div>
                        <p>Please fill out the following fields to login:</p>
                    
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'col-lg-12 col-form-label mr-lg-3'],
                                'inputOptions' => ['class' => 'col-lg-12 form-control'],
                                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                            ],
                        ]); ?>
                    
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    
                            <?= $form->field($model, 'password')->passwordInput() ?>
                    
                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "<div class=\" col-lg-8  custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            ]) ?>
                    
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        
                            <!-- <div class="" style="color:#999;">
                                You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                                To modify the username/password, please check out the code <code>app\models\User::$users</code>.
                            </div> -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>


</div>
