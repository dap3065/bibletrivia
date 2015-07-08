<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">
      <h1>Bible Trivia Now Statistics</h1>
        <p class="lead">Stats coming soon!</p>
	<p>
		<?php echo Html::a("Contact Us!", Url::to(["/site/contact"]), array('class'=>'btn btn-lg btn-success'))?><br/>
	</p>
	<p>
		<?php echo Html::a("Play Now!", Url::to(["/game/list"]), array('class'=>'btn btn-lg btn-success'))?>
	</p>
</div>
