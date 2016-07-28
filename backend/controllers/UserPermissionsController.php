<?php

namespace backend\controllers;

use Yii;
use backend\models\UserPermissions;
use backend\models\CountriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserPermissionsController implements the CRUD actions for  model.
 */
class UserPermissionsController extends Controller
{
    public function actionIndex($user_id)
    {
        $model = new UserPermissions();
        $model->user_id = $user_id;

        if ($model->load(Yii::$app->request->post())) {
                $model->saveUserPermissions();
                return $this->redirect(['index']);
        }
        $model->loadUserPermissions();
        $model->loadUserPermissionGroups();
        $userPermissionAuthItemModel = getAvailableUserPermissions();
        $userPermissionAuthItemGroupModel = getAvailableUserPermissionsGroups();
       
        return $this->render('index', [
            'model' => $model,
            'userPermissionAuthItemModel'=> $userPermissionAuthItemModel,
            'userPermissionAuthItemGroupModel'=>$userPermissionAuthItemGroupModel,
        ]);
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
