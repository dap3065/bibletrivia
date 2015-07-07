<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use \app\models\Answer;
use \app\models\Question;

/**
 * ContactForm is the model behind the contact form.
 */
class AnswerForm extends Model
{
    public $questionId;
    public $answer;
    public $userId;
    public $points;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['questionId', 'answer', 'userId', 'points'], 'required'],
            // email has to be a valid email address
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'answer' => 'Answer:',
        ];
    }

    public function checkAnswer() {
	if ($this->validate()) {
		$answer = new Answer();
		$answer->question_id = $this->questionId;
		$answer->user_id = $this->userId;
		$answer->answer = $this->answer;
		$question = Question::findOne($this->questionId);
		$answer->correct = ($question->answer == $this->answer) ? 1 : 0;
		if ($answer->correct) {
			$question->game->score = $question->game->score + $this->points;
			$question->game->save();
		}
		$answer->save();
		return $answer->id;
	}
	return false;
    }

}
