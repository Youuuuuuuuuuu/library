<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Author;
use yii\helpers\ArrayHelper;


$this->title = 'Добавить книгу';
?>

<div class="site-add-books">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($bookForm, 'title')->textInput() ?>
    <?= $form->field($bookForm, 'author_id')
    ->dropDownList(ArrayHelper::map($authors, 'id', 'surname'), 
    ['prompt' => 'Выберите автора']) ?>
    <?= $form->field($bookForm, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
