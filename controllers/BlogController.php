<?php

namespace app\controllers;

use app\models\BlogArticle;
use app\models\BlogArticleSearch;
use app\models\BlogCategory;
use app\models\utilities\AnalyticsHelper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\GoneHttpException;
use yii\helpers\Url;


/**
 * Class BlogController
 *
 * This is the controller for the public blog pages
 *
 * @package app\controllers
 * @copyright Copyright (c) 2015 Petcloud PTY LTD
 * @author Charles Galvin <charles@petcloud.com.au>
 * @version 2.6.0 2.6.0
 */
class BlogController extends Controller
{
	public $layout = "main";
	use AnalyticsHelper;

	public function actionIndex() {
		//$this->layout = "base";
		$articleSearch = new BlogArticleSearch();
		$articles = $articleSearch->search(Yii::$app->params, 10);
		$categories = BlogCategory::find()->orderBy('name ASC')->all();
		$topSlider = BlogArticle::find()->where('published IS NOT NULL')->orderBy('published DESC')->limit(5)->all();

		return $this->render('index', ['articles' => $articles, 'topSlider' => $topSlider, 'categories' => $categories, 'category' => null]);
	}
	
	public function actionSearch($url) {
		//$this->layout = "base";
		$categories = BlogCategory::find()->all();
		/** @var BlogCategory $category */
		$category = BlogCategory::find()->where(['url'=>$url])->one();
		/** @var BlogArticle $article */
		$article = BlogArticle::find()->where(['url'=>$url])->andWhere("published IS NOT NULL")->one();

		if (empty($article)) {
			if (empty($category)) {
				throw new GoneHttpException();
			} else {
				$articleSearch = new BlogArticleSearch();
				$articles = $articleSearch->search(Yii::$app->request->queryParams, 10);
				return $this->render('index', ['articles' => $articles, 'category' => $category, 'categories' => $categories, 'topSlider' => []]);
			}
		}

		return $this->render('index', ['article' => $article, 'categories' => $categories, 'category' => null]);
	}

	public function actionRss() {
		$dataProvider = new ActiveDataProvider([
			'query' => BlogArticle::find()->where("published IS NOT NULL")->orderBy("published DESC"),
			'pagination' => false,
		]);

		$response = Yii::$app->getResponse();
		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
		$headers = $response->getHeaders();

		$headers->set('Content-Type', 'application/rss+xml; charset=utf-8');

		echo \Zelenin\yii\extensions\Rss\RssView::widget([
			'dataProvider' => $dataProvider,
			'channel' => [
				'title' => function ($widget, \Zelenin\Feed $feed) {
						$feed->addChannelTitle(Yii::$app->name);
				},
				'link' => Url::to(['/'], 'https'),
				'description' => 'PetCloud Blog',
				'language' => function ($widget, \Zelenin\Feed $feed) {
					return Yii::$app->language;
				},
				'image'=> function ($widget, \Zelenin\Feed $feed) {
					$feed->addChannelImage(Url::to(["/img/layouts/petcloud-logo.png"], 'https'), Url::to(["/"], 'https'), 88, 31, 'PetCloud Logo');
				},
			],
			'items' => [
				'title' => function ($model, $widget, \Zelenin\Feed $feed) {
						return $model->title;
					},
				'description' => function ($model, $widget, \Zelenin\Feed $feed) {
						return $model->content;
					},
				'link' => function ($model, $widget, \Zelenin\Feed $feed) {
						return Url::to(["/blog/$model->url"], 'https');
					},
				'author' => function ($model, $widget, \Zelenin\Feed $feed) {
						return "support@petcloud.com.au";//$model->author;
					},
				'guid' => function ($model, $widget, \Zelenin\Feed $feed) {
						return Url::to(["/blog/$model->url"], 'https');
					},
				'pubDate' => function ($model, $widget, \Zelenin\Feed $feed) {
						$date = \DateTime::createFromFormat('Y-m-d H:i:s', $model->published);
						return $date->format('r');
					}
			]
		]);
	}
}
