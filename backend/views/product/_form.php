<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>



      <div class="form-group field-mrisespotlight-button_link required">
        <div class="form-group">
            <?= $form->field($model, 'image_path')->fileInput(['class' => 'custom-file-input1','value'=>$model->image_path]) ?>
            <?php
                if (! $model->isNewRecord) {
                    
                    $pwd = Yii::getAlias('@uploadurl') ;
                    $spotlightPath = $pwd ."product/" ;
            ?>
            <img id="profile"
                 src="<?php echo Yii::getAlias('@uploadurl').'/product/'.$model->image_path; ?>"
                 height="100px" width='100px' />
            <?php } ?>     
        </div>
    </div>

    <?= $form->field($model, 'status')->dropDownList([ '0'=>'unpublished', '1'=>'published' ], ['prompt' => 'Please select status']) ?>

   
    <?php $priceTypes = ArrayHelper::map(\common\models\Category::find()->where(['status'=>'1'])->orderBy('name')->all(), 'id', 'name') ?>
    <?= $form->field($model, 'cat_id')->dropDownList($priceTypes, ['prompt' => '---- Select category type ----'])->label('Category type') ?>
  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
