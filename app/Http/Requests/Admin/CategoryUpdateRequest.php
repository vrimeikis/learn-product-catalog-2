<?php
/**
 * Created by PhpStorm.
 * User: evis
 * Date: 18.9.6
 * Time: 23.30
 */

declare(strict_types = 1);

namespace App\Http\Requests\Admin;


use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Validation\Validator;

class CategoryUpdateRequest extends CategoryStoreRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return parent::rules();
    }

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

    private function slugExists(): bool
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app(CategoryRepository::class);

        $category = $categoryRepository->getBySlugAndNotId(
            $this->getSlug(),
            (int)$this->route()->parameter('category')
        );

        if (!empty($category)) {
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