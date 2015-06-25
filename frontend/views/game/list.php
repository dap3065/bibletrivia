<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;

$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">
  <div id="box-shadow-object" style="margin-left: auto; margin-right:auto; padding: 10px; color: white;box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75); background-color: rgb(51, 51, 51);">
      <h1>Bible Trivia Now</h1>
	<p>Question: <?php print_r($node); ?></p>
	<p>Answer:<br/>
	  <input type="text" name="answer" /> 
	</p>
	
    </div>
</div>
