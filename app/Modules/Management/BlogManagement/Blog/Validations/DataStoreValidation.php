<?php

namespace App\Modules\Management\BlogManagement\Blog\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'blog_category_id' => 'required | sometimes',
            'title' => 'required | sometimes',
            'description' => 'required | sometimes',
            'tags' => ' sometimes',
            'publish_date' => 'sometimes',
            'writer' => ' sometimes',
            'meta_description' => ' sometimes',
            'meta_keywords' => ' sometimes',
            'thumbnail_image' => ' sometimes',
            'image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'blog_type' => ' sometimes',
            'url' => 'sometimes',
            'show_top' => 'sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.required' => 'The image is required.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif, webp.',
            'image.max' => 'The image must not be greater than 2MB.',
            'image.uploaded' => 'The image must not be greater than 2MB.',
        ];
    }
}
