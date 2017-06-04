<?php

namespace app\controllers;

use Yii;
use app\models\Document;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex($relation = null, $relation_id = null)
    {
        if ($relation === null || $relation_id === null) {
            $dataProvider = new ActiveDataProvider([
                'query' => Document::find(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        } else {
            $this->setBreadcrumbs($relation, $relation_id);

            $dataProvider = new ActiveDataProvider([
                'query' => Document::find()->where([$relation . '_id' => $relation_id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
        }

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'relation' => $relation,
                    'relation_id' => $relation_id
        ]);
    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $relation, $relation_id)
    {
        $this->setBreadcrumbs($relation, $relation_id);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'relation' => $relation,
                    'relation_id' => $relation_id
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($relation, $relation_id)
    {
        $this->setBreadcrumbs($relation, $relation_id);

        $model = new Document();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload() && $model->save()) {
                return $this->redirect(['index', 'relation' => $relation, 'relation_id' => $relation_id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'relation' => $relation,
                    'relation_id' => $relation_id
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $relation, $relation_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->document_id, 'relation' => $relation, 'relation_id' => $relation_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'relation' => $relation,
                        'relation_id' => $relation_id
            ]);
        }
    }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function setBreadcrumbs($relation, $relation_id)
    {
        $class = 'app\\models\\' . ucfirst($relation);
        if (!class_exists($class)) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        $model = $class::findOne($relation_id);
        if (!$model) {
            throw new NotFoundHttpException('Страница не найдена');
        }
        $this->view->params['breadcrumbs'][] = ['label' => Yii::t('app', $relation), 'url' => ['/' . $relation]];
        $this->view->params['breadcrumbs'][] = ['label' => $model->getLabelBreadcrumbs(), 'url' => [$relation . '/view', 'id' => $relation_id]];
    }

}
