<?php

/** @var yii\web\View $this */

use yii\helpers\Html;


$this->title = 'Библиотека';
?>
<div class="site-index">
    <?= Html::a('Список книг', ['/all-books'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Добавить книгу', ['/add-book'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Выдать книгу', ['/get-book'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Списать книгу', ['/delete-book'], ['class' => 'btn btn-danger']) ?>
</div>
