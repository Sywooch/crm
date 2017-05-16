<?php

namespace app\controllers;

use Yii;
use app\models\Relationship;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelationshipController implements the CRUD actions for Relationship model.
 */
class RelationshipController extends Controller
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
        ];
    }
    
    /**
     * Lists all Relationship models.
     * @return mixed
     */
    public function actionIndex($relation, $relation_id)
    {
        $this->setBreadcrumbs($relation, $relation_id);

        $dataProvider = new ActiveDataProvider([
            'query' => Relationship::find()->where(['id_' . $relation => $relation_id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'relation' => $relation,
                    'relation_id' => $relation_id
        ]);
    }

    /**
     * Creates a new Relationship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($relation, $relation_id)
    {
        $this->setBreadcrumbs($relation, $relation_id);

        $model = new Relationship();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id, 'relation' => $relation, 'relation_id' => $relation_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'relation' => $relation,
                        'relation_id' => $relation_id
            ]);
        }
    }    

    /**
     * Finds the Relationship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relationship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relationship::findOne($id)) !== null) {
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
