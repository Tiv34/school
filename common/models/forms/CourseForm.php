<?php

namespace common\models\forms;

use DateTimeZone;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\base\Model;
use yii\web\UploadedFile;

class CourseForm extends Model
{
    public ?string $name = null;
    public ?int $class_id = null;
    public UploadedFile $imageFile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class_id'], 'required'],
            [['name'], 'trim'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['class_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'class_id' => 'Добавить в папку',
            'imageFile' => 'Аватарка'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}