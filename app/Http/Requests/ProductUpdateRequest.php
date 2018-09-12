<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class ProductUpdateRequest
 * @package App\Http\Requests
 */
class ProductUpdateRequest extends ProductStoreRequest
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
        return array_merge(
            parent::rules(),
            [
                'slug' =>[
                    'nullable',
                    Rule::unique('products')->ignore($this->route()->parameter('product'))
                ]
            ]
        );
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->input('slug') ?: $this->getTitle());
    }

}
