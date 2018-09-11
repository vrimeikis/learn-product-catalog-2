<?php

declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: evis
 * Date: 18.9.5
 * Time: 20.29
 */

namespace App\Http\Requests\Admin;


use App\Repositories\Admin\CategoryRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CategoryStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:191',
            'active' => 'required|boolean',
            'cover' => 'nullable|image|max:2048|min:100|dimensions:min_width=600,min_height=300',
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
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->isMethod('post') && $this->slugExists()) {
                $validator
                    ->errors()
                    ->add('title', 'Category with this name allready exists!');
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
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app(CategoryRepository::class);

        $category = $categoryRepository->getBySlug($this->getSlug());

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

    public function getCover(): ? UploadedFile
    {
        return $this->file('cover');
    }
}