<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">
  <div>
      <h1>Bible Trivia Now</h1>
	<h2 style="color:green;font-weight:bold;">YOU WERE RIGHT! Great Job!</h2>
	<h3>Your score is <?php echo $game->score; ?></h3>
	<h4>Your answer was <?php echo $answer->answer; ?></h4>
	<h4>Your question was <?php echo $question->hint . " "; echo $question->value; ?></h4>
	<h5>Your choices were: </h5>
	<?php $answers = unserialize($question->answers);
		$index = 1;
		foreach ($answers as $a) {
			if ($index == $question->answer) {
				echo "<span style='color:green;'>$index. $a</span><br/>";
			} else {
				echo "<span style='color:red;'>$index. $a</span><br/>";
			}
			$index++;
		}
	?>
 <p><?php echo Html::a("Next Question", Url::to(["/game/list"]), array('class'=>'btn btn-default'))?></p>
  </div>
</div>
