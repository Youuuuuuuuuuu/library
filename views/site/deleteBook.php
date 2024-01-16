<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Author;
use yii\helpers\ArrayHelper;


$this->title = 'Списать книгу';
?>

<div class="site-delete-books">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($deleteForm, 'id')
    ->dropDownList(ArrayHelper::map($books, 'id', 'title'), 
    ['prompt' => 'Выберите книгу']) ?>

    <div class="form-group">
        <?= Html::submitButton('Списать', ['class' => 'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
