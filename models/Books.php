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
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author_id'], 'required'],
            [['author_id', 'sum', 'available', 'id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'author_id' => 'Author ID',
            'sum' => 'Количество',
            'available' => 'Доступные',
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
