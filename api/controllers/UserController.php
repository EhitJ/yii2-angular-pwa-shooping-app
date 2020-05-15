<?php

namespace app\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';


    public function actionUser(){
    	return ['message'=>'OK'];
    }
}