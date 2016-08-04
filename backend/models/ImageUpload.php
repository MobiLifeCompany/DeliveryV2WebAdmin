<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    /**
     * @var imageFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
        ];
    }
    
    public function upload($id)
    {
        if ($this->validate()) {
            
            $this->imageFile->saveAs('images/shops/'. $id . '/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}