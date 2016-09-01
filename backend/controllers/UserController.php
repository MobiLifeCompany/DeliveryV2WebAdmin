<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\Shops;
use backend\models\UserSearch;
use backend\models\UserShops;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use backend\models\AuthAssignment;
use backend\models\OrderMapTrace;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'only' => ['index','update','create','delete','view'],
                'rules' =>[
                    [
                        'allow' =>true,
                        'roles' =>['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('show_users') || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            throw new ForbiddenHttpException;
        }else
        {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $userShops = array();
        if(!empty($user->userShops)){
            foreach ($user->userShops as $userShop) {
                array_push($userShops, Shops::find()->where(['id' => $userShop->shop_id])->one());
            }
          }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'userShops' => $userShops,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at= date('Y-m-d H:i:s');
            $model->updated_at= date('Y-m-d H:i:s');
            
            $secretKey = Yii::$app->params['secretKey'];
            $encryptedPassword = utf8_encode(Yii::$app->getSecurity()->encryptByKey($model->password_hash, $secretKey));
            $model->password_hash =  $encryptedPassword;

            $model->auth_key = Yii::$app->security->generateRandomString();
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
            //return $this->redirect('index');
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at= date('Y-m-d H:i:s');

            $secretKey = Yii::$app->params['secretKey'];
            $encryptedPassword = utf8_encode(Yii::$app->getSecurity()->encryptByKey($model->password_hash, $secretKey));
            $model->password_hash =  $encryptedPassword;

            if($model->save())
            {
                Yii::$app->session->remove('realUser');
                $user = new \common\models\User();
                $realUser = $user->findByUsername($model->username);
                Yii::$app->session->set('realUser',$realUser);
                echo 1;
            }else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $user = $this->findModel($id);
       $user->updated_at = date('Y-m-d H:i:s');
       $user->deleted = 1;
       $user->update(['updated_at','deleted']);

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Check only when the user is logged in
        if ( !Yii::$app->user->isGuest)  {
            if (Yii::$app->session['userSessionTimeout'] < time()) {
                Yii::$app->user->logout();
                $this->redirect(['site/login']);
            } else {
                Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
                return true; 
            }
        } else {
            return true;
        }
    }

    // Ajax Validation 
    public function actionValidation($id = null){
        $model = $id===null ? new User : User::findOne($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format='json';
            return ActiveForm::validate($model);
        }
    }

    public function actionShops($id)
    {
        $model = new UserShops();
        
        if ($model->load(Yii::$app->request->post())) {
            $selectedShops = $model->shop_id;
            if(isset($selectedShops))
            {
                UserShops::deleteAll(['user_id' => $id]);
                if(!empty($selectedShops)){
                    foreach($selectedShops as $shop){
                        $model = new UserShops();
                        $model->shop_id = $shop;
                        $model->user_id = $id;
                        $model->deleted = 0;
                        $model->created_at = date('Y-m-d H:i:s');
                        $model->updated_at = date('Y-m-d H:i:s');
                        $model->save();
                    }
                    //reset <session></session>
                    Yii::$app->session->remove('userShops');
                    $user = new \common\models\User();
                    Yii::$app->session->set('userShops',$user->getUserShopsIds());
                }
            }

            return $this->redirect(['index']);

        } else {
            $userShops = ArrayHelper::map($this->findUserShops($id),'shop_id','shop_id');
            $model->shop_id = $userShops;
            return $this->renderAjax('shops', [
                'model' => $model,
            ]);
        }
    }

    protected function findUserShops($id)
    {
        $model = UserShops::find()->where(['user_id' => $id])->orderBy('id')->all();
        return $model;
    }

    public function actionProfile($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            
            $secretKey = Yii::$app->params['secretKey'];
            $encryptedPassword = utf8_encode(Yii::$app->getSecurity()->encryptByKey($model->password_hash, $secretKey));
            $model->password_hash =  $encryptedPassword;

            $model->updated_at= date('Y-m-d H:i:s');
            $model->save(false);

            Yii::$app->session->remove('realUser');
            $user = new \common\models\User();
            $realUser = $user->findByUsername($model->username);
            Yii::$app->session->set('realUser',$realUser);
        } 

        $userShops = array();
        if(!empty($model->userShops)){
            foreach ($model->userShops as $userShop) {
                array_push($userShops, Shops::find()->where(['id' => $userShop->shop_id])->one());
            }
        }

        $userPermission = ArrayHelper::map($this->findUserPermission($id),'item_name','item_name');
        $userGroupsPermission = ArrayHelper::map($this->findUserGroupsPermission($id),'item_name','item_name');

        return $this->render('profile', [
            'model' =>  $model,
            'userShops' => $userShops,
            'userPermission' => $userPermission,
            'userGroupsPermission' =>$userGroupsPermission,
        ]);
        
    }

    protected function findUserPermission($id)
    {
        $query = AuthAssignment::find();
        $query->joinWith('itemName');
        $query->andFilterWhere([
           'user_id' => $id,
           'type' => 2
        ]);

        $command = $query->createCommand();
        $data= $command->queryAll();
        return $data;
    }

     protected function findUserGroupsPermission($id)
    {
        $query = AuthAssignment::find();
        $query->joinWith('itemName');
        $query->andFilterWhere([
           'user_id' => $id,
           'type' => 1
        ]);

        $command = $query->createCommand();
        $data= $command->queryAll();
        return $data;
    }

    public function actionSavelocation(){
        
        $data = Yii::$app->request->post();
        if(!empty($data))
        {
            $userId = Yii::$app->session['realUser']['id'];

            $orderMapTrace = new OrderMapTrace();
            $orderMapTrace->user_id = $userId;
            $orderMapTrace->Longitude = $data['long'];
            $orderMapTrace->Latitude = $data['lat'];
            $orderMapTrace->created_at = date('Y-m-d H:i:s');
            $orderMapTrace->updated_at = date('Y-m-d H:i:s');
            $orderMapTrace->save();

            $user = $this->findModel($userId);
            $user->updated_at = date('Y-m-d H:i:s');
            $user->latitude=$data['lat'];
            $user->longitude=$data['long'];
            $user->update(['updated_at','latitude','longitude']);
            return 'OK';
        }

    }

    public function actionUpdatestatus(){
        
        $data = Yii::$app->request->post();
        if(!empty($data))
        {
            $userId = Yii::$app->session['realUser']['id'];
            $type=$data['type'];
            $status=$data['status'];
            $user = $this->findModel($userId);
            $user->updated_at = date('Y-m-d H:i:s');
            if($type==='live_status'){
                $user->live_status=$status;
            }else if($type === 'work_status'){
                $user->work_status=$status;
            }
            $user->update(['updated_at','live_status','work_status']);

            $user = $this->findModel($userId);
            Yii::$app->session->remove('realUser');
            Yii::$app->session->set('realUser',$user);

            return 'OK';
        }

    }

}
