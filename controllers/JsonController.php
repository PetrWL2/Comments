<?php

namespace app\controllers;

use Yii;
use app\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class JsonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
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

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         
        $model = new Comment();
                
        $model->article_id = Yii::$app->request->post('article_id');
        $model->name = Yii::$app->request->post('name');
        $model->email = Yii::$app->request->post('email');
        $model->text = Yii::$app->request->post('text');
        $model->created_at = date('Y-m-d H:i:s');
        $model->path = Yii::$app->request->post('path'); 
       
        if ( ! $model->validate()) {
            $result = ['errors' => 1, 'message' => 'Ошибка валидации комментария', 'data' => $model->errors];
            return $result;
        }
        
        if ( $model->save()) {
            
            $model->path = $model->path . $model->id . '.';
            $model->save(); 
            
            $result = ['success' => 1, 'model' => $model];
            return $result;
            
        } else {

            $result = ['errors' => 1, 'message' => 'Ошибка добавления комментария', 'data' => $model->errors];
            return $result;
            
        }
              
    }
}
