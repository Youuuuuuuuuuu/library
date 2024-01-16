<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Библиотека';
?>
<?= Html::a('Назад', ['/'], ['class' => 'btn btn-danger']) ?>
<?php $form = ActiveForm::begin([
    'action' => ['site/search-book'],
    'method' => 'post',
]); ?>

<?= $form->field($search, 'surname')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
<div class="site-all-books">
    <?php foreach ($books as $book): ?>
        <?= $book->title; ?>
        <?= $book->author->surname; ?>
        <?= $book->sum; ?>
        <?= $book->available; ?></br>
    <?php endforeach; ?>
</div>
