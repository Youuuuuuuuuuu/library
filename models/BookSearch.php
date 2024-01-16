<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $author_id
 * @property int $sum
 * @property int $available
 *
 * @property Author $author
 * @property Loans[] $loans
 */
class BookSearch extends \yii\db\ActiveRecord
{
    public $surname;
    
    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['surname'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'surname' => 'Автор'
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getLoans()
    {
        return $this->hasMany(Loans::class, ['book_id' => 'id']);
    }
}
