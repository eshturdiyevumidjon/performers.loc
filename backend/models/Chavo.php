<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chavo".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $text Текст
 * @property int $sorting Сортировка
 */
class Chavo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chavo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['sorting'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'sorting' => 'Sorting',
        ];
    }
}
