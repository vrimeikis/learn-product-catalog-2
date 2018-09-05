<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required',
            'cover' => 'nullable|image',
            'price' => 'required',
            'active'=> 'required',
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->input('price');
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
        return $this->input('active');
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
    public function getBySlug(string $slug)
    {
        return $this->getBySlugBuilder($slug)->first();
    }

    /**
     * @param string $slug
     * @return Builder
     * @throws \Exception
     */
    private function getBySlugBuilder(string $slug): Builder
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}
