<?php

namespace app\controllers;


use app\models\Category;
use app\models\Comment;
use app\models\News;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\NewsSearch;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function actionIndex($category = null)
    {
        $searchModel = new NewsSearch();

        if ($category)
            $searchModel->category_id = $category;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->setPageSize(3);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => Category::find()
                ->orderBy(['tree' => SORT_ASC, 'lft' => SORT_ASC])
                ->all(),
        ]);
    }


    public function actionView($url)
    {
        $model = News::find()
            ->with('category')
            ->where(['url' => $url, 'status' => News::STATUS_ACTIVE])
            ->one();

        if (!$model)
            throw new NotFoundHttpException('Страница не найдена.');

        $comment = new Comment(['news_id' => $model->id]);
        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            $comment = new Comment(['news_id' => $model->id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getComments()
                ->andWhere(['status' => Comment::STATUS_ACTIVE])
                ->orderBy(['created_at' => SORT_DESC])
        ]);

        return $this->render('view', [
            'model' => $model,
            'comment' => $comment,
            'dataProvider' => $dataProvider,
        ]);
    }
}