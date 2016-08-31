<?php

namespace backend\models;

use Yii;
use yii\base\Model;


class EmailModel extends Model 
{
    public $fromEmail;
    public $subject;
    public $content;
    public $receiverEmail;
}

?>
