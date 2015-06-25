<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;

$this->title = 'BIBLE TRIVIA NOW';
?>
<div class="site-index">

    <div class="jumbotron">
      <h1>Bible Trivia Now</h1>
<?php
echo Carousel::widget([
    'items' => [
        // the item contains only the image
//        Html::img('images/click.jpg'),
        // equivalent to the above
//        ['content' => Html::img('images/mobile.jpg')],
        // the item contains both the image and the caption
        [
            'content' => Html::img('/images/biblegrab.jpg'),
            'caption' => '<h4>Play on your phone!</h4><p>Try our mobile app!</p>',
            'options' => ['data-interval'=>4000],
        ],
        [
            'content' => Html::img('/images/bibleopen.jpeg'),
            'caption' => '<h4>Play on your tablet!</h4><p>Get the app now!</p>',
            'options' => ['data-interval'=>4000],
        ],
        [
            'content' => Html::img('/images/trivia.jpg'),
            'caption' => '<h4>Test your knowledge!</h4><p>See where you rank!</p>',
            'options' => ['data-interval'=>4000],
        ],
        [
            'content' => Html::img('/images/biblewb.jpeg'),
            'caption' => '<h4>Play against family and friends!</h4><p>Encourage the word of God with others!</p>',
            'options' => ['data-interval'=>4000],
        ],
    ]
]);  
?>

        <p class="lead">Have fun learning the Word of God!</p>
<p>
<?php echo Html::a("Play Now!", "/site/contact", array('class'=>'btn btn-lg btn-success'))?>
</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Check your ranking!</h2>

                <p>We rank our players against each other. Compare yourself and set your goals.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Check your stats</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Compete against family & friends!</h2>

                <p>We have single player or multiplayer games.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Compete Now</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Get the mobile app!</h2>

                <p>Play on the go.  Challenge those around you!  Play against family and friends anytime.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Get the APP</a></p>
            </div>
        </div>

    </div>
</div>
