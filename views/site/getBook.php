<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Выдать книгу';
?>

<div class="site-get-books">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($loansForm, 'book_id')
        ->dropDownList(ArrayHelper::map($books, 'id', 'title'), 
        ['prompt' => 'Выберите книгу']) ?>
    <?= $form->field($loansForm, 'user_id')
        ->dropDownList(ArrayHelper::map($users, 'id', 'name'), 
        ['prompt' => 'Выберите пользователя']) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
