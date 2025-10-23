<?php

namespace App\Modules\Management\SectionHeadingManagement\SectionHeading\Validations;

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
            'section_type' => 'required | sometimes',
            'short_title' => 'required | sometimes',
            'title' => 'required | sometimes',
            'long_title' => 'required | sometimes',
            'short_description' => 'required | sometimes',
            'description' => 'required | sometimes',
            'video_url' => 'required | sometimes',
            'primary_image' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'background_image' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'side_image' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'special_note' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'primary_image.required' => 'The primary image is required.',
            'primary_image.image' => 'The primary image must be an image file.',
            'primary_image.mimes' => 'The primary image must be a file of type: jpeg, jpg, png, gif, webp.',
            'primary_image.max' => 'The primary image must not be greater than 2MB.',
            'primary_image.uploaded' => 'The primary image must not be greater than 2MB.',
            'background_image.required' => 'The background image is required.',
            'background_image.image' => 'The background image must be an image file.',
            'background_image.mimes' => 'The background image must be a file of type: jpeg, jpg, png, gif, webp.',
            'background_image.max' => 'The background image must not be greater than 2MB.',
            'background_image.uploaded' => 'The background image must not be greater than 2MB.',
            'side_image.required' => 'The side image is required.',
            'side_image.image' => 'The side image must be an image file.',
            'side_image.mimes' => 'The side image must be a file of type: jpeg, jpg, png, gif, webp.',
            'side_image.max' => 'The side image must not be greater than 2MB.',
            'side_image.uploaded' => 'The side image must not be greater than 2MB.',
            'image.required' => 'The image is required.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif, webp.',
            'image.max' => 'The image must not be greater than 2MB.',
            'image.uploaded' => 'The image must not be greater than 2MB.',
        ];
    }
}
