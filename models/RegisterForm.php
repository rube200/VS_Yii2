<?php

namespace app\models;

use Throwable;
use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    /** @noinspection PhpUnused */
    public $confirm_password;

    /**
     * @return array the validation rules.
     */
    public function rules()//todo finish
    {
        return [
            [['username', 'email', 'password', 'confirm_password'], 'required'],
            ['username', 'string', 'length' => [3, 255]],
            ['email', 'email'],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'length' => [3, 255]],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    /**
     * Registers the user and logs in the user.
     * @return bool whether the user is registered successfully
     * @throws Throwable
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        //input validation should already check this but just in case
        if ($this->isUsernameTaken()) {
            $this->addError($this->username, 'Username already taken.');
            return false;
        }

        //input validation should already check this but just in case
        if ($this->isEmailTaken()) {
            $this->addError($this->email, 'Email already taken.');
            return false;
        }

        $user = User::registerUser($this->username, $this->email, $this->password);
        if (!$user) {
            //todo change this
            $this->addError($this->username, 'Error creating the user');
            return false;
        }

        return Yii::$app->user->login($user,3600 * 24 * 30);
    }

    /**
     * Check if [[username]] already exists
     *
     * @return boolean
     */
    public function isUsernameTaken()
    {
        return User::findByUsername($this->username) != null;
    }

    /**
     * Check if [[email]]already exists
     *
     * @return boolean
     */
    public function isEmailTaken()
    {
        return User::findByEmail($this->email) != null;
    }
}
