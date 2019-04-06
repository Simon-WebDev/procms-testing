<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
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
            'group_id' => 'required',
            'title' => 'required|max:100',
            'body' => 'required',
            'image1' => 'nullable|image|max:4000',
            'image2' => 'nullable|image|max:4000',
        ];
    }

    public function attributes()
    {
        return [
            'group_id' => '게시판 선택',
            'title' => '제목',
            'body' => '내용',
            'image1' => '파일',
            'image2' => '파일',

        ];
    }
}
