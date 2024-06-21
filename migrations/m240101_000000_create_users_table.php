<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240101_000000_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(User::tableName(), [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string(AUTH_KEY_LENGTH)->notNull()->unique(),
            'created_at' => $this->date()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(User::tableName());
    }
}
