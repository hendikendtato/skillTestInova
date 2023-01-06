<?php

namespace app\controllers;

use app\models\MPembayaran;
use app\models\MDetailObat;
use app\models\MPemeriksaan;
use app\models\MTindakan;
use app\models\PembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii;

/**
 * PembayaranController implements the CRUD actions for MPembayaran model.
 */
class PembayaranController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MPembayaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PembayaranSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MPembayaran model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MPembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MPembayaran();

        if ($this->request->isPost) {
                // die;
            if ($model->load($this->request->post()) && $model->save()) {
                $id_pemeriksaan = Yii::$app->request->post('MPembayaran', []);
                Yii::$app->db->createCommand()
                                ->update('pemeriksaan', ['status' => 'Selesai'], 'id = '.$id_pemeriksaan['nomor_pemeriksaan'].'')
                                ->execute();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MPembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MPembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MPembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MPembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MPembayaran::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail($id)
    {
        $detail = MDetailObat::find()->select(['m_obat.nama_obat', 'detail_obat.*'])->leftjoin('m_obat', 'm_obat.id = detail_obat.id_obat')->where(['detail_obat.id_pemeriksaan' => $id])->asArray()->all();

        echo Json::encode($detail);
    }

    public function actionTindakan($id)
    {
        $pemeriksaan = MPemeriksaan::findOne(['id' => $id]);
        $tindakan = MTindakan::findOne(['id' => $pemeriksaan->tindakan]);
        
        echo Json::encode($tindakan);
    }
    public function actionAmbilPasien($id)
    {
        $pemeriksaan = MPemeriksaan::findOne(['id' => $id]);
        
        echo Json::encode($pemeriksaan);
    }

    public function actionGrafik()
    {
        $model = new MPembayaran;
        return $this->render('grafik', [
            'model' => $model,
        ]);
    }
}
