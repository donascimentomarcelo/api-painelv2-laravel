<?php

namespace Painel\Http\Requests;

use Painel\Http\Requests\Request;

class ProjectRequest extends Request
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

    public function wantsJson()
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
            'name'       =>'required|max:50',
            'category'   =>'required|max:50',
            'link'       =>'required|max:50',
            'description'=>'required|max:255',
        ];
    }
}
