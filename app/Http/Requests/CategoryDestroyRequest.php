<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  !($this->route('category') == config('cms.default_category_id'));
    }

    public function forbiddenResponse()
    {
        return redirect()->back()->with('error-message','기본카테고리는 삭제할 수 없습니다');
    }

   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
