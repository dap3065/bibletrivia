<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $score
 * @property integer $question_id
 * @property integer $status
 * @property integer $last_play
 * @property string $created
 * @property GameUser $gameUsers;
 * @property Question $questions;
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score', 'question_id', 'status', 'last_play'], 'integer'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'score' => 'Score',
            'question_id' => 'Question ID',
            'status' => 'Status',
            'last_play' => 'Last Play',
            'created' => 'Created',
        ];
    }

    public function getGameUsers()
    {
	return $this->hasMany(GameUser::className(), ['game_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
		->via(gameUsers);
    }
    

    public function getQuestions()
    {
	return $this->hasMany(Question::className(), ['game_id' => 'id']);
    }

    
}
