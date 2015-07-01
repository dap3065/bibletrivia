<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $game_id
 * @property string $value
 * @property string $answers
 * @property integer $answer
 * @property string $hint
 * @property string $created
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'answer'], 'integer'],
            [['value', 'answers'], 'string'],
            [['created'], 'safe'],
            [['hint'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'value' => 'Value',
            'answers' => 'Answers',
            'answer' => 'Answer',
            'hint' => 'Hint',
            'created' => 'Created',
        ];
    }

    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

}
