<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products|max:191|min:10',
            'sku' => 'required',
            'original_price' => 'required',
            'discounted_price' => 'required',
            'description' => 'required',
            'sizes' => 'required',
            'colors' => 'required',
//            'category_id' => 'required',
            'content' => ''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên sản phẩm quá dài',
            'name.min' => 'Tên sản phẩm phải có ít nhất 10 ký tự',
            'sku.required' => 'Mã sản phẩm không được để trống',
            'original_price.required' => 'Giá gốc không được để trống',
            'discounted_price.required' => 'Giá khuyến mãi không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'sizes.required' => 'Size không được để trống',
            'colors.required' => 'Màu không được để trống',
//            'category_id.required' => 'Danh mục không được để trống',
            'content.required' => ''
        ];
    }
}
