<?php

use app\models\Tarefa;
use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%tarefas}}`.
 */
class m240102_000000_create_tarefas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Tarefa::tableName(), [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'titulo' => $this->string()->notNull(),
            'descricao' => $this->text()->notNull(),
            'data_criacao' => $this->date()->notNull()->defaultExpression('GETDATE()'),
            'data_conclusao' => $this->date()->null(),
            'estado' => $this->string()->notNull()->check('estado IN(\'Pendente\', \'Em Curso\', \'Finalizado\')')->defaultValue('Pendente'),
        ]);

        $this->addForeignKey(
            'fk-tarefa-owner_id',
            Tarefa::tableName(),
            'owner_id',
            User::tableName(),
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-tarefa-owner_id',
            Tarefa::tableName()
        );
        $this->dropTable(Tarefa::tableName());
    }
}
