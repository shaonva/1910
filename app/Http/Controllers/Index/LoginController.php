<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Admins;
class LoginController extends Controller
{
    public function login(){
    	return view('index.login');
    }

    public function reg(){
    	return view('index.reg');
    }

     public function sendSms(Request $request){
    	$mobile = $request->mobile;
    	//验证手机号
    	$reg = '/^1[3|5|6|7|8|9]\d{9}$/';
    	//dd(preg_match($reg,$mobile));
    	if(!preg_match($reg,$mobile)){
    		 echo json_encode(['code'=>'00001','msg'=>'手机号格式不正确']);
    		 exit;
    	}
    	$code = rand(100000,999999);
        //发送
        $ret = $this->sendByMobile($mobile,$code);
        //dd($ret);exit;
        if($ret['Message']=='OK'){
        	session(['code'=>$code]);
        	echo json_encode(['code'=>'00000','msg'=>'发送成功']);
        	exit;
        }
    }

    public function sendByMobile($mobile,$code){
		// Download：https://github.com/aliyun/openapi-sdk-php
		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

		AlibabaCloud::accessKeyClient('LTAI4G3VfhCACk1v5fDFxDrr', 'bNlxMF7SaBnKlODWpHAs1qHrC41dVE')
		                        ->regionId('cn-hangzhou')
		                        ->asDefaultClient();

		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $mobile,
		                                          'SignName' => "时光很甜",
		                                          'TemplateCode' => "SMS_185241746",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}

    }

    //邮箱
    public function sendEmail(Request $request){
    	$email = $request->email;
    	$reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
    	//dd(preg_match($reg,$email));
    	if(!preg_match($reg,$email)){
    		echo json_encode(['code'=>'00001','msg'=>'邮箱格式不正确']);
    		exit;
    	}
    	$code = rand(100000,999999);
    	$this->sendByEmail($email,$code);

    	session(['code'=>$code]);
        echo json_encode(['code'=>'00000','msg'=>'发送成功']);
        	exit;
    }

    public function sendByEmail($email,$code){
    	 Mail::to($email)->send(new SendCode($code));
    	 
    }

    //登录
    public function doLogin()
    {
        $post = request()->except('_token');
        //dd($post);exit;
     	$user = Admins::where('admin_name',$post['admin_name'])->first();

    	 if(decrypt($user->pwd)!=$post['pwd']){
    	 	 return redirect('/login')->with('msg','用户名或密码出现错误！！'); 
    	 }

         
    	 session(['admins'=>$user]);
    	 if($post['refer']){
    	   return redirect($post['refer']);
    	 }
    	  return redirect('/');
    }

}