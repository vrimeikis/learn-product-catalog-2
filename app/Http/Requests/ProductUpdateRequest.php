<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

class ProductUpdateRequest extends ProductStoreRequest
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
        return parent::rules();
    }


    /**
     * Validate slug in DB on update request
     *
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('put') && $this->slugExists()) {
                $validator->errors()->add('slug', 'Slug already exists.');

                return;
            }
        });

        return $validator;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function slugExists(): bool
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);

        $slug = $productRepository->getBySlugAndNotById(
            $this->getSlug(),
            $this->route()->parameter('product')
        );

        return !empty($slug);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->input('slug') ?: $this->getTitle());
    }

}
