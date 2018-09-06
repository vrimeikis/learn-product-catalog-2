<?php

declare (strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Class UserUpdateRequest
 * @package App\Http\Requests
 */
class UserUpdateRequest extends UserStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'last_name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('users')->ignore($this->route()->parameter('user')),
            ],
            //'password_confirmation' => 'same:password',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
}
