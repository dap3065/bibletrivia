<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \app\models\Game;
use \app\models\GameUser;
use \app\models\Question;
use \app\models\Answer;
use frontend\models\AnswerForm;


/**
 * Game controller
 */
class GameController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list', 'stats', 'search', 'help'],
                'rules' => [
                    [
                        'actions' => ['help', 'search'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['list', 'stats'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
	$games = Yii::$app->user->identity->games;
	if (count($games)) {
		foreach($games as $g) {
			if ($g->status == 1) {
			  $game = $g;
			  break;
			}
		}
		if (!isset($game)) {
		   $game = new Game();
		   $game->score = 0;
	   	   $game->status = 1;
	   	   $game->save();
	   	   Yii::$app->user->identity->link('games', $game);
		}
	} else {
	   $game = new Game();
	   $game->score = 0;
	   $game->status = 1;
	   $game->save();
	   Yii::$app->user->identity->link('games', $game);
	}
	$file = "/var/lib/openshift/558c7768500446990400012e/app-root/repo/bibletrivia/booksofthebible.xml";
	$data = "";
	if (file_exists($file)) {
		try {
	    		$xml = simplexml_load_file($file);
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			$book = rand(1, 66);
			$nodes = $xml->xpath("//entry[@handle='$book']");
			if (is_array($nodes)) {
				foreach ($nodes as $n) {
					if (is_object($n))
					  $node = $n;
				}
				if (!isset($node)) {
					error_log("$book =book" . print_r($nodes, true) . "\n" . print_r($xml, true));
				}
				if (!isset($node)) {
					error_log("stop me" . print_r($node, true));
					$this->redirect("/game/list");
				}
				$bookName = (string)$node->name;
				$chapters = (string)$node->chapters;
				$data = $this->getVerse($bookName, $chapters);
				error_log(print_r($data, true));
				if (isset($data['scripture']) && !empty($data['scripture'])) {
					$words = explode(" ", $data['scripture']);
					$count = count($words);
					if ($count < 10) {
						$check = 0;
						while ($count < 10 && $check < 10) {
							error_log("$count = word count $check");
							$data = $this->getVerse($bookName, $chapters);
							$words = explode(" ", $data['scripture']);
							$count = count($words);
							$check++;
						}
					}
					$indexes = array();
					while (count($indexes) < 4) {
						$ind = rand(0, $count);
						if (isset($words[$ind]) && !in_array($ind, $indexes) && strlen($words[$ind]) > 2) {
							$indexes[] = $ind;
						}
					}
					$question = "";
					for ($i = 0; $i<$count; $i++) {
						if (in_array($i, $indexes)) {
							$question .= "_______ ";
						} else {
							$question .= $words[$i] . " ";
						}
					}

					$question = trim($question);

					sort($indexes);
					$check = implode(",", $indexes);
					$answer = "";
					foreach ($indexes as $i) {
						$answer .= str_replace(array(",", ".", "?", "!"), "", $words[$i]) . ",";
					}
					$answers[] = substr($answer, 0, strlen($answer)-1);
					shuffle($indexes);
					$test = implode(",", $indexes);
					if ($test != $check) {
						$answer = "";
						foreach ($indexes as $i) {
							$answer .= str_replace(array(",", ".", "?", "!"), "", $words[$i]) . ",";
						}
						$answers[] = substr($answer, 0, strlen($answer)-1);
					}
					while(count($answers) < 4) {
						$indexes = array();
						while (count($indexes) < 4) {
							$ind = rand(0, $count);
							if (isset($words[$ind]) && !in_array($ind, $indexes) && strlen($words[$ind]) > 2) {
								$indexes[] = $ind;
							}
						}
						$test = implode(",", $indexes);
						if ($test != $check) {
							$answer = "";
							foreach ($indexes as $i) {
								$answer .= str_replace(array(",", ".", "?", "!"), "", $words[$i]) . ",";
							}
							$answers[] = substr($answer, 0, strlen($answer)-1);
						}
					}
					$q = new Question();
					shuffle($answers);
					$index = 1;
					$answer = 0;
					$indexes = explode(",", $check);
					$realAnswer = "";
					foreach($indexes as $i) {
						$realAnswer .= str_replace(array(",", ".", "?", "!"), "", $words[$i]) . ",";
					}
					$realAnswer = substr($realAnswer, 0, strlen($realAnswer)-1);

					foreach($answers as $a) {
						if ($a == $realAnswer) {
							$answer = $index;
							break;
						}
						$index++;
					}

					$q->value = $question;
					$q->answers = serialize($answers);
					$q->answer = $answer;
					$q->hint = "$bookName " .  $data['chapter'] . ":" . $data['verse'];
					$q->game_id = $game->id;
					$q->save();
					$form = new AnswerForm();
					$form->questionId = $q->id;
					$form->userId = \Yii::$app->user->identity->id;
					$form->points = 30;
				} else {
					$question = $answer = "";
					$answers = array();
					$form = new AnswerForm();
	                		Yii::$app->session->setFlash('error', "There was an error $book " . print_r($nodes, true));
				}
			} else if (is_null($nodes) || !is_array($nodes)) {
                		Yii::$app->session->setFlash('error', "There was an error $book " . print_r($nodes, true));
			}
		} catch (Exception $ex) {
//		  $data = $ex;
                	Yii::$app->session->setFlash('error', 'There was an error.' . print_r($ex, true));
		}
	} else {
                Yii::$app->session->setFlash('error', 'There was an error getting your question.');
	}

        return $this->render('list', array('node'=>array($book, $bookName, $chapters, $data), 'question'=>$question, 'answers'=>$answers,'bookName'=> $bookName, 'model'=>$form, 'hint'=>(isset($q) ? $q->hint : "")));
    }

    public function getVerse($bookName, $chapters) {
    	$str = "we were not able to find that passage";
	$cnt = 0;
	$obj = array();
	$httpCode = 404;
	while (((stristr($str, 'we were not able to find that passage')  !== false)
		|| $httpCode == 404)
		&& $cnt < 20) {
		$verse = rand(1,100);
		$chapter = rand(1, intval($chapters));
		$urlBookName = strtolower(str_replace(" ", "_", $bookName));
		$url = "http://biblehub.com/$urlBookName/$chapter-$verse.htm";
		error_log($url);
		$handle = curl_init($url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($handle, CURLOPT_TIMEOUT, 400); //timeout in seconds
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);

		$cnt++;

		if($httpCode == 404) {
    			continue;
		} else {
			$str = $response;
		}


		//$str = file_get_contents("http://biblehub.com/$bookName/$chapter-$verse.htm");
//		$str = file_get_contents("https://www.biblegateway.com/passage/?search=$bookName+$chapter:$verse");
	}
	if (stristr($str, 'we were not able to find that passage') === false) {
		$dom = new \DomDocument();

		# Parse the HTML from Google.
		# The @ before the method call suppresses any warnings that
		# loadHTML might throw because of invalid HTML in the page.
		@$dom->loadHTML($str);
		$title = "";
		foreach($dom->getElementsByTagName('title') as $t) {
			$title = (string)$t->nodeValue;
		}
		$str = $title;
		$obj['scripture'] = trim(str_replace("$bookName $chapter:$verse", "", $title));
		$obj['verse'] = $verse;
		$obj['chapter'] = $chapter;
		$obj['book'] = $bookName;
	}
	return $obj;
    }

    public function actionAnswer()
    {
	$answer = new AnswerForm();
	if ($answer->load(Yii::$app->request->post()) && ($answerId = $answer->checkAnswer())) {
		$answer = Answer::findOne($answerId);
		if ($answer->correct) {
			$game = $answer->question->game;
			if ($game->score > 200 || count($game->questions) > 30) {
				$game->status = 2;
				$game->save();
		        	return $this->render('gameover', array('answer'=>$answer, 'question'=>$answer->question, 'game'=>$game));
			} else { 
		        	return $this->render('correct', array('answer'=>$answer, 'question'=>$answer->question, 'game'=>$answer->question->game));
			}
		} else {
	         	return $this->render('wrong', array('answer'=>$answer, 'question'=>$answer->question, 'game'=>$answer->question->game));
		}
	} else {
         	return $this->redirect('game/list');
	}
    }

    public function actionStats()
    {
        return $this->render('stats');
    }

    public function actionHelp()
    {
        return $this->render('help');
    }

    public function actionSearch()
    {
        return $this->render('search');
    }

}
