<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 이 값은 현재 유저가 저장이 가능한 지 검사하는 역할입니다만 지금은 유저의 권한 개념이 없으므로 true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // 조건식이 늘어날 때 마다 | 을 추가해줍니다.
        return [
            'name' => 'required|max:63',
            'content' => 'required|max:255',
            'call' => 'required|regex:/\d{2,3}-\d{3,4}-\d{4}/'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '제목이 비어있습니다.',
            'name.max' => '제목은 63자 이하입니다.',
            'content.required' => '내용이 비어있습니다.',
            'content.max' => '내용은 255자 이하입니다.',
            'call.required' => '전화번호가 비어있습니다.',
            'call.regex' => '올바른 전화번호 형태가 아닙니다.',
        ];
    }
}
