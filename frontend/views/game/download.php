<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">
  <div>
      <h1>Bible Trivia Now Downloads</h1>
<p>Coming Soon</p>
<p><?php echo Html::a("Play Game", Url::to(["/game/list"]), array('class'=>'btn btn-default'))?></p>
  </div>
</div>
