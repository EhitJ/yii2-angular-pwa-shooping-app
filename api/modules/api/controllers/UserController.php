<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\api\components\ApiAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;

use yii\web\ForbiddenHttpException;

use common\models\Users;
use common\models\Products;
use common\models\Orders;
use common\models\OrdersDetails;
use app\modules\api\components\FileUploader;

class UserController extends Controller
{


    public function beforeAction($action)
    {

        parent::beforeAction($action);
        header("Access-Control-Allow-Origin: *");
        $this->enableCsrfValidation = false;
        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {

            Yii::$app->getResponse()->getHeaders()->set('Allow', 'POST GET PUT');

            Yii::$app->end();

        }


        return true;

    }



	public function behaviors()
	{ 
		return [
			
			'verbs' => [
				'class' => VerbFilter::className(),
		        'actions' => [
		            'me' => ['get'],
					'all' => ['get'],
                    'client' => ['post','options'],
		            'register' => ['post','options'],
					'update' => ['put'],
                    'buyproducts' => ['post','options'],
                    
		        ]
			],

            'corsFilter'=>[
                'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
            ],
			// 'access' => [
   //              'class' => AccessControl::className(),
   //              'only' => ['me','all','client','create'],
   //              'rules' => [
   //                  [
   //                      'allow' => true,
   //                      'roles' => ['*'],
   //                  ],
   //              ],
   //          ],
			'contentNegotiator' => [
	            'class' => ContentNegotiator::className(),
	            'formats' => [
	                'application/json' => Response::FORMAT_JSON,
	            ],
	        ]
		];
	}

    public function actionMe()
    {
		$user = User::findIdentity(Yii::$app->user->id);

		if (!$user) {
            return [
                'success' => 0,
                'payload' => 'Some error occurred'
            ];
        }

        return [
            'success' => 1,
            'payload' => $user
        ];
    }

	public function actionAll()
    {


        // return [
        //     'success' => 1,
        //     'payload' => []
        // ];
        if (Yii::$app->user->identity->role != USER::ADMIN) {
            throw new ForbiddenHttpException("You are not allowed", 1);
        }

        $users = User::findAll([
            'status' => User::ACTIVE,
            'role' => User::CLIENT
        ]);

        return [
            'success' => 1,
            'payload' => $users
        ];
    }

    public function actionClient()
    {
   //      if (Yii::$app->user->identity->role != USER::ADMIN
			// && Yii::$app->user->id != Yii::$app->request->getQueryParam('id')) {
   //          throw new ForbiddenHttpException("You are not allowed", 1);
   //      }
        //print_r(Yii::$app->request->post());exit;
        $projection = ['id', 'name', 'email', 'mobileno', 'address', 'password'];

        $user = Users::find()->where(
            'email = :id and status = :status', [
                ':id' => Yii::$app->request->post('email'),
                ':status' => '1'
            ])->select($projection)->asArray()->one();
       // print_r($user['id']);exit;
         $user['id']=base64_encode($user['id']);
        //print_r($user);exit;
        if(!empty( $user) && Yii::$app->security->validatePassword(Yii::$app->request->post('password'), $user['password'])){
             return [
            'success' => 1,
            'payload' => $user
        ];
        }else{
             return [
            'success' => 0,
            'payload' => $user
        ];
        }
       
    }

	private function _addOrUpdate($params)
	{
		if ($params['id']) {
            $user = Users::findOne([
                'id' => $params['id']
            ]);

			if (!$user) {
				return [
	                'success' => 0,
	                'message' => 'No such user exist'
	            ];
	        }
        } else {
            $user = new Users();
        }

    	$user->name = $params['name'];
    	$user->email = $params['email'];
    	$user->mobileno = $params['mobileno'];
        $user->address = $params['address'];
    	$user->password = Yii::$app->security->generatePasswordHash($params['password']);
        $user->status = '1';
        //$user->created_at = date('Y:m:d H:i:s');
    	if (!$user->validate()) {
    		return [
    			'success' => 0,
    			'message' => $user->getErrors()
    		];
    	}

        // if (count($_FILES)) {
        //     $uploader = new FileUploader($_FILES['profile_picture']);
        //     $fileName = md5($user->email . Yii::$app->security->generateRandomString());
        //     $path = Yii::$app->basePath . '/web/images/profile/' . $fileName . '.' . $uploader->extension();

        //     $uploadStatus = $uploader->save($path);

        //     if (!$uploadStatus['success']) {
        //         return [
        //             'success' => 0,
        //             'message' => $uploadStatus['error']
        //         ];
        //     }

        //     $user->profile_picture = $file_name . '.' . $uploader->extension();
        // }

        if (!$user->save()) {
            return [
                'success' => 0,
                'message' => 'Some error occurred'
            ];
        }

    	return [
    		'success' => 1,
    		'payload' => $user
    	];
	}

    public function actionRegister()
    {
    	return $this->_addOrUpdate(Yii::$app->request->getBodyParams());
    }

	public function actionUpdate()
    {
    	return _addOrUpdate(Yii::$app->request->getBodyParams());
    }

    public function actionProducts()
    {   
         $products = Products::find()->select('id,title,description,price,image_path')->where(
            'status = :status', [
                ':status' => '1'
            ])->asArray()->all();
         foreach($products as $key => $val){
            $products[$key]['srno']=$key+1;
            $products[$key]['image_path']=str_replace('4004','4003',Yii::getAlias('@uploadurl'))."/product/".$val['image_path'];
         }
         return $products;
    }
    public function actionProductscart()
    {   $products=[];
        if(!empty(Yii::$app->request->post())){
             $userdata=json_decode(Yii::$app->request->post('user'),true);
             $user_id=base64_decode($userdata['email']);
             // $products = Products::find()->select('id,title,description,price,image_path')->where(
             //    'status = :status', [
             //        ':status' => '1'
             //    ])->asArray()->all();

             $products= Yii::$app->db->createCommand('select o.id,p.title,p.description,p.price,p.image_path from products p inner join orders_details od on p.id=od.product_id inner join orders o on o.id=od.order_id where o.user_id=:user and o.status=1')->bindValue('user',$user_id)->queryAll();
             //print_r($list);exit;
             foreach($products as $key => $val){
                $products[$key]['srno']=$key+1;
                $products[$key]['image_path']=str_replace('4004','4003',Yii::getAlias('@uploadurl'))."/product/".$val['image_path'];
             }
        }
         return $products;
    }

     public function actionBuyproducts()
    {   
        if(!empty(Yii::$app->request->post())){
            $product=Yii::$app->request->post('product');
            $userdata=json_decode(Yii::$app->request->post('user'),true);
            $user_id=base64_decode($userdata['email']);
            $products = Products::find()->select('id,title,description,price,image_path')->where(
            'id = :id', [
                ':id' =>  $product
            ])->asArray()->one();
            $successflag=false;
            $msg='Request failed , please after some time';
            $order = new Orders();
            $orderdtl = new OrdersDetails();

            $order->created_at = date('Y:m:d H:i:s');
            $order->payment_type = '1';
            $order->status = '1';//1 := in cart
            $order->user_id = $user_id;
            if($order->save()){
                    
                $orderdtl->product_id = $product;
                $orderdtl->price =  $products['price'];
                $orderdtl->order_id = $order->id;
                $orderdtl->created_at = date('Y:m:d H:i:s');
                if($orderdtl->save()){
                    $successflag=true;
                    $msg='Product added to cart';
                }
            }
         
            return [
            'success' => $successflag,
            'payload' => $msg
            ];
        }
        
    }


    public function actionCheckout()
    {   
        if(!empty(Yii::$app->request->post())){
            
            $userdata=json_decode(Yii::$app->request->post('user'),true);
            $user_id=base64_decode($userdata['email']);
          
            $successflag=false;
            $msg='Checkout Successful ...';


            $status=Yii::$app->db->createCommand()
             ->update('orders', ['status' => '2'], ['user_id' =>$user_id ])
             ->execute();
            
            if($status == 0){
                $msg='No items Available for checkout';
                 return [
                    'success' => $successflag,
                    'payload' => $msg
                ];
            }else{
               return [
                'success' => $successflag,
                'payload' => $msg
                ];  
            }
           
        }
        
    }

    public function actionRemoveorder()
    {   
        if(!empty(Yii::$app->request->post())){
            $product=Yii::$app->request->post('product');
            $userdata=json_decode(Yii::$app->request->post('user'),true);
            $user_id=base64_decode($userdata['email']);
          
            $successflag=false;
            $msg='Item Removed Successfully ...';


            $status=Yii::$app->db->createCommand()
             ->update('orders', ['status' => '0'], ['id' =>$product ])
             ->execute();
            
            if($status == 0){
                $msg='No items Available for removal';
                 return [
                    'success' => $successflag,
                    'payload' => $msg
                ];
            }else{
               return [
                'success' => $successflag,
                'payload' => $msg
                ];  
            }
           
        }
        
    }


}
