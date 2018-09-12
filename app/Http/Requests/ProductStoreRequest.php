<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Class ProductStoreRequest
 * @package App\Http\Requests
 */
class ProductStoreRequest extends FormRequest
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
            'title' => 'required',
            'cover' => 'nullable|image',
            'price' => 'required',
        ];
    }

    /**
     * @return null|string
     */
    public function getTitle(): ? string
    {
        return $this->input('title');
    }

    /**
     * @return array
     */
    public function getCategoriesIds(): array
    {
        return $this->input('category', []);
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return (int)$this->input('price');
    }

    /**
     * @return \UploadedFile|null
     */
    public function getCover(): ? UploadedFile
    {
        return $this->file('cover');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->getTitle());
    }

    /**
     * @return string
     */
    public function getContext(): string
    {
        return $this->input('context');
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {

        return (bool)$this->input('active');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function slugExists(): bool
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);
        $slug = $productRepository->getBySlug($this->getSlug());

        return !empty($slug);
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Exception
     */
    public function getBySlug(string $slug): string
    {
        return $this->getBySlugBuilder($slug)->first();
    }

    /**
     * @param string $slug
     * @return Builder
     * @throws \Exception
     */
    private function getBySlugBuilder(string $slug): string
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}
