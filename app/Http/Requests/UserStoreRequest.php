<?php

declare (strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests
 */
class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->input('last_name');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->input('password');
    }
}
