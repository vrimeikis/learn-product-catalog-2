<?php

declare(strict_types = 1);

namespace App\Http\Requests\Admin;

use App\Repositories\FeatureItemRepository;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class FeatureUpdateRequest
 * @package App\Http\Requests\Admin
 */
class FeatureItemUpdateRequest extends FeatureItemStoreRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return parent::rules();
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('put') && $this->slugExists()) {
                $validator->errors()
                    ->add('slug', 'This slug already exists');
            }
            return;
        });
        return $validator;
    }

    /**
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function slugExists(): bool
    {
        /** @var FeatureItemRepository $featureItemRepository */
        $featureItemRepository = app(FeatureItemRepository::class);

        $item = $featureItemRepository->getBySlugAndNotId(
            $this->getSlug(),
            (int)$this->route()->parameter('item')
        );

        if (!empty($item)) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return ($this->input('slug')) ?? parent::getSlug();
    }
}