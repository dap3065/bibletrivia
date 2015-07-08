<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'BIBLE TRIVIA NOW';
$this->registerJs(
"setInterval(function(){ 
	var points = $('#answerform-points').val();
	if ((points - 10) > 0) {
		points = points - 10;
		$('#answerform-points').val(points);
		$('#points-value').html(points);
		$('#points-value')
			.animate({
                    		opacity: 0
               		  }, 1000, function() {
                    		$(this).animate({
                        		opacity: 1,
                    		}, 1000);
               		});
	}
    }, 10000);");
?>
<div class="site-index">
  <div id="box-shadow-object" style="height: 450px;margin-left: auto; margin-right:auto; padding: 10px; color: white;box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75); background-color: rgb(51, 51, 51);">
      <h1>Bible Trivia Now</h1>
	<p style="font-size:larger;">Question: <?php echo $question; ?></p>
	<p><span id="points-label">Points: </span><span id="points-value">30</span></p>
	<p>Answers:</p>
	<div>
	<?php for($i=0; $i<count($answers); $i++) { ?>
		<span style="font-size:larger;margin:3px;padding:3px;"><?php echo ($i +1) . ". " . $answers[$i]; ?></span><br/>
	<?php } ?>
	</div>
	<div style="margin:10px;padding:10px;">
<?php $form = ActiveForm::begin(['id' => 'contact-form', 'action'=> ['game/answer']]); ?>
	<p>
    	  <?php echo $form->field($model, 'questionId')->hiddenInput()->label(false);?>
    	  <?php echo $form->field($model, 'userId')->hiddenInput()->label(false); ?>
    	  <?php echo $form->field($model, 'points')->hiddenInput()->label(false); ?>
    	  <?php echo $form->field($model, 'answer') ?>
	</p>
	<div style="margin:5px;padding:5px;float:left;">
	<p>
	  <?php echo  Html::submitButton('Submit Answer', ['class' => 'btn btn-primary']) ?>
	</p>
	</div>
	<div style="margin:5px;padding:5px;float:left;">
	<p>
	  <?php echo Html::button('Hint', [ 'class' => 'btn btn-primary', 'onclick' => '(function ( $event ) { alert("' . $hint . '"); })();' ]); ?>
	<p>
	</div>	
	<?php ActiveForm::end() ?>
    </div>
</div>
