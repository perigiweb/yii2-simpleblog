<?php

namespace app\controllers;

use app\models\Post;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller {

  public function actionIndex($y = null, $m = null, $d = null){
    $post = Post::find();
    if ($y){
      $post = $post->where(New Expression("YEAR(created_at) = :year", [':year' => $y]));
    }
    if ($m){
      $post = $post->where(New Expression("MONTH(created_at) = :month", [':month' => $m]));
    }
    if ($d){
      $post = $post->where(New Expression("DAY(created_at) = :day", [':day' => $d]));
    }

    $postCount = $post->count();

    $pagination = new Pagination([
      'totalCount' => $postCount
    ]);

    $displayPagination = false;
    $pageTitle = 'All Posts';
    if ($y || $m || $d){
      $x = $y;
      if ($m){
        $x .= '-' . $m;
      }
      if ($d){
        $x .= '-' . $d;
      }
      $pageTitle = 'Post Archives (' . $x . ')';
    }

    $posts = $post->orderBy('id DESC')
      ->offset($pagination->getOffset())
      ->limit($pagination->getLimit())
      ->all();

    return $this->render('list', compact('pageTitle', 'postCount', 'posts', 'pagination', 'y', 'm', 'd'));
  }

  public function actionAuthor($authorSlug){
    $author = User::findOne(['slug' => $authorSlug]);
    if ( !$author){
      throw new NotFoundHttpException("Author not found!");
    }
    $postCount = $author->getPosts()->count();

    $pagination = new Pagination([
      'totalCount' => $postCount
    ]);

    $pageTitle = $author->name . ' Posts';

    $posts = $author->getPosts()
      ->orderBy('id DESC')
      ->offset($pagination->getOffset())
      ->limit($pagination->getLimit())
      ->all();

    return $this->render('list', compact('pageTitle', 'author', 'postCount', 'posts', 'pagination'));
  }

  public function actionView($slug){
    $post = Post::findOne(['slug' => $slug]);
    if ( !$post){
      throw new NotFoundHttpException("We can't find post with slug: $slug");
    }

    if ($post->user_id != Yii::$app->user->getId()){
      $post->updateCounters(['views' => 1]);
    }

    return $this->render('view', compact('post'));
  }
}