<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Библиотека';
?>
<?= Html::a('Назад', ['/all-books'], ['class' => 'btn btn-danger']) ?>
<h3><?= $search->surname?></h3>
<div class="site-search-book">
    <? foreach($books as $book): ?>
        <?= $book->title; ?><br>
    <?php endforeach; ?>
</div>

