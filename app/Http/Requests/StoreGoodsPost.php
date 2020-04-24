<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 
class StoreGoodsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	$name = \Route::currentRouteName();
    	if($name=='goodsstore'){
           //添加
           return [
	            
	            'goods_hao'=>'required',
	            'goods_num'=>'required',
	            'goods_num'=>'required|integer|max:99999999',
	            'goods_price'=>'required',
           ];
    	}
       
 		if($name=='goodsupdate'){
 			//编辑
            return [
	            'goods_name'=>[
	            	 Rule::unique('goods')->ignore(request()->id,'goods_id'),
	            	'regex:/^[\x{4e00}-\x{9fa5}][0-9a-zA-Z_]{2,50}$/u'
	            ],
	            'goods_hao'=>'required',
	            'goods_num'=>'required',
	            'goods_num'=>'required|integer|max:99999999',
	            'goods_price'=>'required',
          ];
 		}
    }

    public function messages(){
    	return [
    		'goods_name.required'=>'商品名称不能为空',
    		'goods_name.unique'=>'商品名称已存在',
    		'goods_name.regex'=>'商品名称长度范围在2-50位，可以包含中文，数字，字母，下划线',
    		'goods_hao.required'=>'商品分类不能为空',
    		'goods_num.required'=>'商品库存不能为空',
    		'goods_num.integer'=>'商品库存必须是数字',
    		'goods_num.integer'=>'商品库存不能超过8位数字',
    		'goods_price.required'=>'商品价格不能为空',
    	];
    }
}
