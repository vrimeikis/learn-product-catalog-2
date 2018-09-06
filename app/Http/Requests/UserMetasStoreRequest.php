<?php

declare (strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserMetasStoreRequest
 * @package App\Http\Requests
 */
class UserMetasStoreRequest extends FormRequest
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
            'address' => 'required|string',
        ];
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->input('address');
    }
}
