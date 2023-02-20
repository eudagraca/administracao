<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdvertenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'user_id' => 'required|exists:users,id',
            'motivo' => 'required|min:15',
        ];
    }

     public function attributes(){
        return [
            'user_id' => 'Advertido',
            'motivo' => 'Motivo da advertência',
            'para' => 'Para quem está é destinada',
        ];
    }
}
