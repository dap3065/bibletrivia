<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

<div style="width:100%;">
<div style="float:left; width:25%;">
<?php echo  Html::img('/images/words.png'); ?>
</div>
<div style="float:left; width:50%; font-size:larger;">
<p>
This was created to help you learn the true Word of God.
</p>
<p>
Through the Word of God... Lives can be changed dramatically.
</p>
<p>
So read... learn... play... and enjoy!</p>
<p>
Contact us!
<br/>
Feel free to call or email us if you have questions or request anything new.
</p>
<p>
</p>
</div>
<div style="text-align:center;width:25%; margin-left:auto;margin-right:auto;padding:15px;float:left;">
<?php echo Html::img('/images/bibleholding.jpeg'); ?>
</div>
<div style="clear:both;">
</div>
<div style="text-align:center;margin-left:auto; margin-right:auto; padding:15px; margin:10px;">
<?php echo Html::img('/images/rock.jpeg'); ?>
</div>
</div>
</div>
