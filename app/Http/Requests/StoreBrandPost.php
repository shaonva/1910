<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
        return [
           'brand_name' => 'required|unique:brand|max:20',
    	   'brand_zhi' => 'required',
        ];
    }

    public function messages(){ 
      return [
    	'brand_name.required' => '品牌名称不能为空',
    	'brand_name.unique' => '品牌名称已存在',
    	'brand_name.max' => '品牌名称最大长度是20位',
    	'brand_zhi.required' => '品牌网址不能为空',
     ];
    }
}
