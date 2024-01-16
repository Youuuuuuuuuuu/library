<?php

namespace app\models;

use Yii;

class DeleteBook extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Книга',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Loans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loans::class, ['book_id' => 'id']);
    }
}
