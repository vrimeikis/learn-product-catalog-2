<?php

declare (strict_types=1);

namespace App\Http\Requests;

use App\Repositories\ManufacturerRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Class ManufacturerRequest
 * @package App\Http\Requests
 */
class ManufacturerRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'slug' => 'nullable',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|regex:/(^\+370)[0-9]{8}$/',
            'logo' => 'nullable',
            'active' => 'nullable',
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->after(function (Validator $validator) {
            if ($this->slugExists($this->getSlug(), (int)$this->manufacturer)) {
                if ($this->getSlugInput()) {
                    $validator->errors()->add('slug', 'Slug already exists.') ;
                } else {
                    $validator->errors()->add('title', 'Title already exists.');
                }
                return;
            }
        });
        return $validator;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->input('title');
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return Str::slug($this->getSlugInput() ?? $this->getTitle());
    }

    /**
     * @return null|string
     */
    public function getSlugInput(): ?string
    {
        return $this->input('slug');
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->input('address');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->input('email');
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->input('phone');
    }

    /**
     * @return UploadedFile|null
     */
    public function getLogo(): ?UploadedFile
    {
        return $this->file('logo');
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return (bool)$this->input('active');
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'address' => $this->getAddress(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'active' => $this->getActive(),
        ];
    }

    /**
     * @param $slug
     * @param $id
     * @return bool
     * @throws BindingResolutionException
     */
    private function slugExists(string $slug, int $id): bool
    {
        /** @var ManufacturerRepository $manufacturerRepository */
        $manufacturerRepository = app(ManufacturerRepository::class);

        return (bool)$manufacturerRepository->getBySlugAndNotId($slug, $id);
    }
}
