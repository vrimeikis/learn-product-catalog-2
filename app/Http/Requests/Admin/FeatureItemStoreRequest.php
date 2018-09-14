<?php

declare(strict_types = 1);

namespace App\Http\Requests\Admin;

use App\Repositories\FeatureItemRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Class FeatureItemStoreRequest
 * @package App\Http\Requests\Admin
 */
class FeatureItemStoreRequest extends FormRequest
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
        return [
            'title' => 'required|min:1|max:191',
            'active' => 'required|boolean',
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->input('title');
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('post') && $this->slugExists()) {
                $validator
                    ->errors()
                    ->add('title', 'Feature item with this name allready exists!');
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
        /** @var FeatureItemRepository $featureRepository */
        $featureRepository = app(FeatureItemRepository::class);

        $feature = $featureRepository->getBySlug($this->getSlug());

        if (!empty($feature)) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        $slug = Str::slug($this->getTitle());

        return $slug;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }
}