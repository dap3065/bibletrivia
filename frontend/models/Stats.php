<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stats".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $fastest_game
 * @property integer $highest_score
 * @property double $avg_game_score
 * @property double $avg_answer_time
 * @property integer $correct_answers
 * @property integer $wrong_answers
 * @property integer $game_count
 * @property string $created
 */
class Stats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fastest_game', 'highest_score', 'correct_answers', 'wrong_answers', 'game_count'], 'integer'],
            [['avg_game_score', 'avg_answer_time'], 'number'],
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
            'user_id' => 'User ID',
            'fastest_game' => 'Fastest Game',
            'highest_score' => 'Highest Score',
            'avg_game_score' => 'Avg Game Score',
            'avg_answer_time' => 'Avg Answer Time',
            'correct_answers' => 'Correct Answers',
            'wrong_answers' => 'Wrong Answers',
            'game_count' => 'Game Count',
            'created' => 'Created',
        ];
    }
}
