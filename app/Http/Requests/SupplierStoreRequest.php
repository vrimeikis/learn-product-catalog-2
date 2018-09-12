<?php

namespace App\Http\Requests;

use App\Repositories\SupplierRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class SupplierStoreRequest extends FormRequest
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
        return [
            'title' => 'required',
            'description' => 'nullable|required',
            'address' => 'nullable|required',
            'phone' => 'nullable|required',
            'email' => 'nullable|required',
            'logo' => 'nullable|image',
            'active' => 'required'
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->input('description');
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->input('address');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->input('phone');
    }

    /**
     * @return UploadedFile|null
     */
    public function getLogo(): ? UploadedFile
    {
        return $this->file('logo');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->getTitle());
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
        /** @var SupplierRepository $supplierRepository */
        $supplierRepository = app(SupplierRepository::class);
        $slug = $supplierRepository->getBySlug($this->getSlug());

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
