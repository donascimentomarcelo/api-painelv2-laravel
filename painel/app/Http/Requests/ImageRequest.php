<?php

namespace Painel\Http\Requests;

use Painel\Http\Requests\Request;

class ImageRequest extends Request
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
        dd($this->images);
        return [
            'images' => 'required | mimes:image/png | max:1000',
        ];
    }
}
