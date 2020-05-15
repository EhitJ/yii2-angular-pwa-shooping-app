<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property string|null $image_path
 * @property string $status
 * @property int $cat_id
 * @property string $created_at
 *
 * @property Category $cat
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'cat_id'], 'required'],
            [['price'], 'number'],
            [['status'], 'string'],
            [['cat_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['image_path'], 'string', 'max' => 100],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'image_path' => 'Image Path',
            'status' => 'Status',
            'cat_id' => 'Category ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

     public function upload() {
        // if ($this->validate()) {
          if(isset($this->image_path->baseName)) {

            //getCurrentInstance
           
            $pwd = Yii::getAlias('@base_url') ;
            $spotlightPath = $pwd ."/product/" ;
          //  print_r($pwd);exit;
            if (!file_exists( $pwd )) {
                mkdir($pwd, 0777, true);
            }
            if (!file_exists( $spotlightPath )) {
                mkdir($spotlightPath, 0777, true);
            }

            $name = $this->image_path->baseName .'_'.date('his') . '.' .$this->image_path->extension ;
                $this->image_path->saveAs( $spotlightPath . $name );
                return $name;
          }
      }
}
