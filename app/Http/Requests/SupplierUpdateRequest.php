<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends SupplierStoreRequest
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
    public function rules(): array
    {

        return array_merge(
            parent::rules(),
            [
                'slug' =>[
                    'nullable',
                    Rule::unique('suppliers')->ignore($this->route()->parameter('supplier'))
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
