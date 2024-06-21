<?php

namespace app\models;

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
}