<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Traits\Common\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
