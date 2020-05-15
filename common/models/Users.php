<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string $password
 * @property string $mobileno
 * @property string $address
 * @property int $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'email', 'password', 'mobileno', 'address', 'status'], 'required'],
            [['id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 200],
            [['mobileno'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'mobileno' => 'Mobileno',
            'address' => 'Address',
            'status' => 'Status',
        ];
    }
}
