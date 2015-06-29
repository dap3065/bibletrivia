<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tracking".
 *
 * @property integer $id
 * @property string $ip
 * @property string $created
 * @property string $browser
 * @property string $location
 * @property string $referrer
 * @property string $misc
 */
class Tracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['misc'], 'string'],
            [['ip'], 'string', 'max' => 50],
            [['browser', 'location', 'referrer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'created' => 'Created',
            'browser' => 'Browser',
            'location' => 'Location',
            'referrer' => 'Referrer',
            'misc' => 'Misc',
        ];
    }
}
