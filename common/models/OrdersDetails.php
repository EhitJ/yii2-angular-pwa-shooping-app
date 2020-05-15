<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_details".
 *
 * @property int $id
 * @property int $product_id
 * @property float $price
 * @property int $order_id
 * @property string $created_at
 *
 * @property Orders $order
 */
class OrdersDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'order_id'], 'required'],
            [['product_id', 'order_id'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
