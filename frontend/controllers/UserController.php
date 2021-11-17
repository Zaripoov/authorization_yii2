<?php

namespace frontend\controllers;

use common\models\User;
use common\models\UserProfile;
use Yii;

class UserController extends \yii\web\Controller
{

    public function behaviors(){
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionProfile()
    {

        $model = User::findOne(Yii::$app->user->identity->getId());

        return $this->render('profile', [
            'model' => $model,
        ]);


    }

    public function actionEdit(){
        $user = User::findOne(Yii::$app->user->identity->getId());
        $profile = UserProfile::findOne($user->id);

        if($profile->load(Yii::$app->request->post()) && $profile->update()){
            Yii::$app->session->setFlash('success', 'Ваши данные сохранено');
            return $this->redirect(['profile']);
        }
        return $this->render('edit',[
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function actionDelete(){
        $id = Yii::$app->user->identity->getId();
        Yii::$app->user->logout();
        $model = User::findOne($id)->delete();
        if($model){
            Yii::$app->session->setFlash('success', 'Ваш профиль удален');
            return $this->redirect(['authorization/login']);
        }
    }

}
