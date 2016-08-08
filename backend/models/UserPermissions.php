<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class UserPermissions extends Model
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var array IDs of the favorite foods
     */
    public $userPermissions_ids = [];

    public $userPermissionGroups_ids = [];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
                ['user_id', 'required'],
                ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
                    // each food_id must exist in food table
                    ['userPermissions_ids', 'each', 'rule' => 
                        [
                                'exist', 'targetClass' => AuthItem::className(), 'targetAttribute' => 'item_name'
                        ]
                    ],
                    ['userPermissionGroups_ids', 'each', 'rule' => 
                        [
                                 'exist', 'targetClass' => AuthItem::className(), 'targetAttribute' => 'item_name'
                        ]
                    ],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User',
            'userPermissions_ids' => 'User Permissions',
            'userPermissionGroups_ids' => 'User Permission Groups',
        ];
    }

    /**
     * load the user's favorite foods
     */
    public function loadUserPermissions()
    {
        $query = AuthAssignment::find();
        $query->joinWith('itemName');
        $query->andFilterWhere([
           'user_id' => $this->user_id,
           'type' => 2
        ]);

        $this->userPermissions_ids = [];

        $command = $query->createCommand();
        $data= $command->queryAll();
        foreach($data as $userPermission) {
                $this->userPermissions_ids[] = $userPermission['item_name'];
        }
       
    }

    public function loadUserPermissionGroups()
    {
        $query = AuthAssignment::find();
        $query->joinWith('itemName');
        $query->andFilterWhere([
           'user_id' => $this->user_id,
           'type' => 1
        ]);

        $this->userPermissionGroups_ids = [];

        $command = $query->createCommand();
        $data= $command->queryAll();
        foreach($data as $userPermissionGroup) {
                $this->userPermissionGroups_ids[] = $userPermissionGroup['item_name'];
            }

    }

    /**
     * save the user's favorite foods
     */
    public function saveUserPermissions()
    {
        AuthAssignment::deleteAll(['user_id' => $this->user_id]);
        if (is_array($this->userPermissions_ids)) {
            foreach($this->userPermissions_ids as $item_name) {
                $userPermission = new AuthAssignment();
                $userPermission->user_id = $this->user_id;
                $userPermission->item_name = $item_name;
                $userPermission->created_at = date('Y-m-d H:i:s');
                $userPermission->save();
            }
        }
        if (is_array($this->userPermissionGroups_ids)) {
            foreach($this->userPermissionGroups_ids as $item_name) {
                $userPermissionGroup = new AuthAssignment();
                $userPermissionGroup->user_id = $this->user_id;
                $userPermissionGroup->item_name = $item_name;
                $userPermissionGroup->created_at = date('Y-m-d H:i:s');
                $userPermissionGroup->save();
            }
        }
        /* Be careful, $this->userPermissions_ids can be empty */
    }

    /**
     * @return array available foods
     */
    public static function getAvailableUserPermissions()
    {
        $authItems = AuthItem::find()->where(['type'=>2])->all();
        $userPermissionAuthItems = ArrayHelper::map($authItems, 'name', 'name');
        return $userPermissionAuthItems;
    }

    public static function getAvailableUserPermissionsGroups()
    {
        $authItems = AuthItem::find()->where(['type'=>1])->all();
        $userPermissionGroupsAuthItems = ArrayHelper::map($authItems, 'name', 'name');
        return $userPermissionGroupsAuthItems;
    }
}

?>