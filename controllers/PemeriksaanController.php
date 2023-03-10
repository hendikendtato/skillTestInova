<?php

namespace app\controllers;

use app\models\MPemeriksaan;
use app\models\PendaftaranPasien;
use app\models\MPasien;
use app\models\MObat;
use app\models\MTindakan;
use app\models\PemeriksaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\Json;
/**
 * PemeriksaanController implements the CRUD actions for MPemeriksaan model.
 */
class PemeriksaanController extends Controller
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
     * Lists all MPemeriksaan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MPemeriksaan model.
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
     * Creates a new MPemeriksaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MPemeriksaan();
        
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailObats = Yii::$app->request->post('MDetailObat', []);
                if ($model->save()) {
                    $transaction->commit();
                    $detail_obat = Yii::$app->request->post('MDetailObat', []);

                    foreach ($detail_obat as $value) {
                        $stok_lama = MObat::findOne(['id' => $value['id_obat']]);
                        $stok_baru = $stok_lama['stok'] - $value['jumlah'];
                        Yii::$app->db->createCommand()
                                 ->update('m_obat', ['stok' => $stok_baru], 'id = '.$value['id_obat'].'')
                                 ->execute();
                    }

                    $id_pendaftaran = Yii::$app->request->post('MPemeriksaan', []);
                    Yii::$app->db->createCommand()
                                 ->update('pendaftaran_pasien', ['status' => 'Selesai'], 'id = '.$id_pendaftaran['pendaftaran'].'')
                                 ->execute();

                    return $this->redirect(['view', 'id' => $model->id]);
                }
                $transaction->rollBack();
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MPemeriksaan model.
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
     * Deletes an existing MPemeriksaan model.
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
     * Finds the MPemeriksaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MPemeriksaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MPemeriksaan::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAmbilPasien($id){
        $pendaftaran = PendaftaranPasien::findOne(['id' => $id]);

        $pasien = MPasien::findOne(['id' => $pendaftaran->pasien]);

        // print_r($pasien->nama_pasien); die;
        echo Json::encode($pasien);
    }

    public function actionSetBiaya($id){
        $tindakan = MTindakan::findOne(['id' => $id]);

        // print_r($pasien->nama_pasien); die;
        echo Json::encode($tindakan);
    }

    public function actionHarga($id){
        $obat = MObat::findOne(['id' => $id]);

        // print_r($pasien->nama_pasien); die;
        echo Json::encode($obat);
    }
}
