<?php

namespace app\models;

use Throwable;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * @property int $id
 * @property int $owner_id
 * @property string $titulo
 * @property string $descricao
 * @property string $data_criacao
 * @property string $data_conclusao
 * @property string $estado
 */
class Tarefa extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{tarefa}}';
    }

    /**
     * Finds tarefas by owner id
     *
     * @param int $id
     * @return Query
     */
    public static function queryByOwnerId(int $id): Query
    {
        return Tarefa::find()->where(['owner_id' => $id]);
    }

    public static function registerTarefa($titulo, $descricao, $estado)
    {
        $newTarefa = new Tarefa();
        $newTarefa->owner_id = Yii::$app->user->id;
        $newTarefa->titulo = $titulo;
        $newTarefa->descricao = $descricao;
        $newTarefa->estado = $estado;
        return $newTarefa->insert() ? $newTarefa : null;
    }

    /**
     * Deletes one tarefa entry based on id and owner
     * @throws Throwable
     */
    public static function deleteTarefa(int $id)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        return self::findById($id)->delete();
    }

    public static function findById(int $id)
    {
        return Tarefa::findOne(['id' => $id, 'owner_id' => Yii::$app->user->id]);
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->estado == 'Finalizado' && !$this->data_conclusao) {
            $this->data_conclusao = date("Y-m-d");
        }

        return true;
    }
}