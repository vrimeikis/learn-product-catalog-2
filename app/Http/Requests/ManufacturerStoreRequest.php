<?php

declare (strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class ManufacturerStoreRequest
 * @package App\Http\Requests
 */
class ManufacturerStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'slug' => [
                'nullable',
                'string',
                Rule::unique('manufacturers')->ignore($this->route()->parameter('manufacturer')),
            ],
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => [
                'nullable',
                'string',
                'regex:/(^\+370)[0-9]{8}$/'
                ],
            'logo' => 'nullable',
            'active' => 'nullable',
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->input('title');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->input('slug'));
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->input('address');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->input('email');
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->input('phone');
    }

    /**
     * @return UploadedFile|null
     */
    public function getLogo(): ?UploadedFile
    {
        return $this->file('logo');
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }
}
