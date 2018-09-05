<?php

declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: evis
 * Date: 18.9.5
 * Time: 20.29
 */

namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

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
     * @return string
     */
    public function getSlug(): string
    {
        $slug = Str::slug($this->getTitle());


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