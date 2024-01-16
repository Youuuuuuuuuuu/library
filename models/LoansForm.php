<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loans".
 *
 * @property int $id
 * @property int|null $book_id
 * @property int|null $user_id
 *
 * @property Books $book
 * @property Users $user
 */
class LoansForm extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'loans';
    }

    public function rules()
    {
        return [
            [['book_id', 'user_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'book_id' => 'Книга',
            'user_id' => 'Пользователь',
        ];
    }

    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
