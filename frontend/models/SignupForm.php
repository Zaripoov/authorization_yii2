<?php

namespace frontend\models;

use common\models\UserProfile;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $surname;
    public $name;
    public $email;
    public $password;
    public $cpassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['surname', 'required'],

            ['name', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['cpassword', 'required'],
            ['cpassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if($user->save()){
            $user_profile = new UserProfile();
            $user_profile->user_id = $user->id;
            $user_profile->surname = $this->surname;
            $user_profile->name = $this->name;

            //&& $this->sendEmail($user)
            return  $user_profile->save();
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
