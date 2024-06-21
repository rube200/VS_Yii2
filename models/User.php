<?php

namespace app\models;

use Throwable;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

define("AUTH_KEY_LENGTH", 128);

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return '{{user}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //not implemented
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email]);
    }

    /**
     * Registers a user
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return User|null
     * @throws Throwable
     */
    public static function registerUser($username, $email, $password)
    {
        $newUser = new User();
        $newUser->username = $username;
        $newUser->email = $email;
        $newUser->password = $password;
        return $newUser->insert() ? $newUser : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     * @throws Exception
     */
    public function validatePassword($password)
    {
        if (!$password) {
            return false;
        }

        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        return Yii::$app->getSecurity()->validatePassword($this->password, $hash);
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->setAttribute('authKey', Yii::$app->getSecurity()->generateRandomString(AUTH_KEY_LENGTH));
        }

        return true;
    }
}