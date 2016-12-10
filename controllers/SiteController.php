<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Compressor;


class SiteController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Сжатие ссылки
     * @return string
     */
    public function actionCompress() {
        return Compressor::pack(Yii::$app->request->get('url', null));
    }

    /**
     * @param string $short_url
     */
    public function actionGo($short_url) {
        $redirect = 'site/error';
        if(preg_match('/^[0-9a-zA-Z]{6}$/', $short_url)) {
            if($result = Compressor::search($short_url)) {
                $redirect = $result;
            }
        }
        $this->redirect($redirect);
    }
}
