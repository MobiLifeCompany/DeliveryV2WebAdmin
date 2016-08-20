<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthAssignment;
use backend\models\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UserPermissions;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends Controller
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
        ];
    }

    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
         throw new ForbiddenHttpException;

       /* $searchModel = new AuthAssignmentSearch();
        $userPermissionmodel = new UserPermissions();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userPermissionmodel' =>$userPermissionmodel
        ]);*/
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionView($item_name, $user_id)
    {
       /* return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);*/
         throw new ForbiddenHttpException;
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       /*
        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
        throw new ForbiddenHttpException;
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
     public function actionPermissions($user_id)
        {
        $model = new AuthAssignment();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $selectedUserPermissions = $data['AuthAssignment']['userPermissions_ids'];

            if(isset($selectedUserPermissions))
            {
                if(!empty($selectedUserPermissions)){
                    AuthAssignment::deleteAll(['user_id' => $user_id]);
                    foreach($selectedUserPermissions as $item_name){
                        $userPermission = new AuthAssignment();
                        $userPermission->user_id = $user_id;
                        $userPermission->item_name = $item_name;
                        $userPermission->created_at = date('Y-m-d H:i:s');
                        $userPermission->save();
                    }
                }
            }

            $selectedGroupsUserPermissions = $data['AuthAssignment']['userPermissionGroups_ids'];
            if(isset($selectedGroupsUserPermissions))
            {
                if(!empty($selectedGroupsUserPermissions)){
                    foreach($selectedGroupsUserPermissions as $item_name){
                        $userPermission = new AuthAssignment();
                        $userPermission->user_id = $user_id;
                        $userPermission->item_name = $item_name;
                        $userPermission->created_at = date('Y-m-d H:i:s');
                        $userPermission->save();
                    }
                }
            }

            return $this->redirect(['user/index']);

        } else {
            $userPermission = ArrayHelper::map($this->findUserPermission($user_id),'item_name','item_name');
            $userGroupsPermission = ArrayHelper::map($this->findUserGroupsPermission($user_id),'item_name','item_name');
            $model->userPermissions_ids = $userPermission;
            $model->userPermissionGroups_ids = $userGroupsPermission;
            return $this->renderAjax('permissions', [
                'model' => $model,
            ]);

        }
       
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


    public function actionUpdate($user_id)
    {

        $userPermissionmodel = new UserPermissions();
        $userPermissionmodel->user_id = $user_id;

        $userPermissionGroupsmodel = new UserPermissions();
        $userPermissionGroupsmodel->user_id = $user_id;

        $userPermissionmodel->loadUserPermissions();
        $userPermissionAuthItemModel = $userPermissionmodel->getAvailableUserPermissions();

        $userPermissionGroupsmodel->loadUserPermissionGroups();
        $userPermissionAuthItemGroupModel = $userPermissionGroupsmodel->getAvailableUserPermissionsGroups();

        if ($userPermissionmodel->load(Yii::$app->request->post())) {
              $userPermissionmodel->saveUserPermissions();
            return $this->redirect(['user/index']);
        } else {
            return $this->render('update', [
                'userPermissionmodel'=>$userPermissionmodel,
                'userPermissionGroupsmodel'=>$userPermissionGroupsmodel,
                'userPermissionAuthItemModel'=> $userPermissionAuthItemModel,
                'userPermissionAuthItemGroupModel'=>$userPermissionAuthItemGroupModel,
            ]);
        }
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($item_name, $user_id)
    {
        throw new ForbiddenHttpException;
        
       /* $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);*/
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
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
}
