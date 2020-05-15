<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $payment_type
 * @property string $status
 * @property int $user_id
 * @property string $created_at
 *
 * @property OrdersDetails[] $ordersDetails
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_type', 'user_id'], 'required'],
            [['payment_type', 'user_id'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_type' => 'Payment Type',
            'status' => 'Status',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[OrdersDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersDetails()
    {
        return $this->hasMany(OrdersDetails::className(), ['order_id' => 'id']);
    }
}
