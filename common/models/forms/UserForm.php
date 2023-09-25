<?php

namespace common\models\forms;

use DateTimeZone;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\base\Model;

class UserForm extends Model
{
    public ?string $name = null;
    public ?string $surname = null;
    public ?string $city = null;
    public ?string $phone = null;
    public ?string $email = null;
    public ?string $timezone = null;
    public ?array $timeZoneArray = [];

    public function __construct($config = [])
    {
        foreach (DateTimeZone::listIdentifiers() as $value) {
            $this->timeZoneArray[$value] = $value;
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'city'], 'trim'],
            ['phone', 'filter', 'filter' => function ($value) {
                return preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $value);
            }],
            [['name', 'surname'], 'string', 'max' => 100],
            [['city'], 'string', 'max' => 55],
            ['email', 'email'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'                 => 'ID',
            'username'           => UserManagementModule::t('back', 'Login'),
            'superadmin'         => UserManagementModule::t('back', 'Superadmin'),
            'confirmation_token' => UserManagementModule::t('back', 'Confirmation Token'),
            'registration_ip'    => UserManagementModule::t('back', 'Registration IP'),
            'bind_to_ip'         => UserManagementModule::t('back', 'Bind to IP'),
            'status'             => UserManagementModule::t('back', 'Status'),
            'gridRoleSearch'     => UserManagementModule::t('back', 'Roles'),
            'created_at'         => UserManagementModule::t('back', 'Created'),
            'updated_at'         => UserManagementModule::t('back', 'Updated'),
            'password'           => UserManagementModule::t('back', 'Password'),
            'repeat_password'    => UserManagementModule::t('back', 'Repeat password'),
            'email_confirmed'    => UserManagementModule::t('back', 'E-mail confirmed'),
            'email'              => UserManagementModule::t('back', 'E-mail'),
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'city' => 'Город',
            'phone' => 'Телефон',
        ];
    }
}