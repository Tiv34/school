<?php

namespace common\models;

use webvimark\modules\UserManagement\models\User as UserWebvimark;
use webvimark\modules\UserManagement\UserManagementModule;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $email_confirmed
 * @property string $auth_key
 * @property string $password_hash
 * @property string $confirmation_token
 * @property string $bind_to_ip
 * @property string $registration_ip
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $timezone
 * @property string $city
 * @property integer $status
 * @property integer $superadmin
 * @property integer $admin
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends UserWebvimark
{

}
