<?php

namespace app\controllers;

use app\models\Tarefa;
use app\models\TarefaForm;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * TarefaController implements the CRUD actions for Tarefa model.
 */
class TarefaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tarefa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tarefa::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarefa model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Tarefa::findById($id),
        ]);
    }

    /**
     * Creates a new Tarefa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new TarefaForm();
        if ($model->load(Yii::$app->request->post())) {
            $tarefa = $model->register();
            if ($tarefa) {
                return $this->redirect(['view', 'id' => $tarefa->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tarefa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate($id)
    {
        if ($this->request->isPost) {
            $form = new TarefaForm();
            if ($form->load($this->request->post(), 'Tarefa')) {
                if ($form->edit($id)) {
                    return $this->redirect(['view', 'id' => $id]);
                }
            }
        }

        return $this->render('update', [
            'model' => Tarefa::findById($id)
        ]);
    }

    /**
     * Deletes an existing Tarefa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     * @throws Throwable
     */
    public function actionDelete($id)
    {
        Tarefa::deleteTarefa($id);
        return $this->redirect(['index']);
    }
}
