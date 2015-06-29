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
}
