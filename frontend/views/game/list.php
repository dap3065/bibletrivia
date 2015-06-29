<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;

$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">
  <div id="box-shadow-object" style="margin-left: auto; margin-right:auto; padding: 10px; color: white;box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75); background-color: rgb(51, 51, 51);">
      <h1>Bible Trivia Now</h1>
	<p style="font-size:larger;">Question: <?php echo $question; ?></p>
	<p>Answers:</p>
	<div>
	<?php for($i=0; $i<count($answers); $i++) { ?>
		<span style="font-size:larger;margin:3px;padding:3px;"><?php echo ($i +1) . ". " . $answers[$i]; ?></span><br/>
	<?php } ?>
	</div>
	<div style="margin:10px;padding:10px;">
	<p>
	  <input type="text" name="answer" /> 
	</p>
	<p>
	<input type="submit" value="Submit Answer" style="color:black; font-size:larger;"/>
	</p>
	</div>
	
    </div>
</div>
