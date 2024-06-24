<?php

namespace app\models;

use Throwable;
use yii\base\Model;

/**
 * TarefaForm is the model behind the tarefa form.
 */
class TarefaForm extends Model
{
    public $titulo;
    public $descricao;
    public $estado;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['titulo', 'descricao'], 'required'],
            ['estado', 'in', 'range' => ['Pendente', 'Em Curso', 'Finalizado']],
        ];
    }

    /**
     * Registers a Tarefa to a user
     * @return bool|Tarefa whether the tarefa is registered successfully
     * @throws Throwable
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $tarefa = Tarefa::registerTarefa($this->titulo, $this->descricao, $this->estado);
        if (!$tarefa) {
            $this->addError($this->titulo, 'Falha ao criar tarefa');
            return false;
        }

        return $tarefa;
    }

    /**
     * Edits a Tarefa
     * @return bool whether the tarefa is edited successfully
     */
    public function edit(int $id)
    {
        if (!$this->validate()) {
            return false;
        }

        $tarefa = Tarefa::findById($id);
        if (!$tarefa) {
            $this->addError($this->titulo, 'Falha ao editar tarefa');
            return false;
        }

        $tarefa->titulo = $this->titulo;
        $tarefa->descricao = $this->descricao;

        if ($tarefa->estado != 'Finalizado') {
            $tarefa->estado = $this->estado;
        }

        return $tarefa->update();
    }
}
