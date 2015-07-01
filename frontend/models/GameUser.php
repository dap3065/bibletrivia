<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_to_user".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $user_id
 * @property string $created
 * @property Game $games
 * @property User $users
 */
class GameUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'user_id'], 'integer'],
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
            'game_id' => 'Game ID',
            'user_id' => 'User ID',
            'created' => 'Created',
        ];
    }

    public function getGames()
    {
        return $this->hasMany(Game::className(), ['id' => 'game_id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }
}
