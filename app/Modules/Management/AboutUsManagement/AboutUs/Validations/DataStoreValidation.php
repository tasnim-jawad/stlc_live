<?php

namespace App\Modules\Management\AboutUsManagement\AboutUs\Validations;

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
            'title' => 'required | sometimes',
            'description' => 'required | sometimes',
            'features' => 'required | sometimes',
            'quotation' => 'required | sometimes',
            'video_url' => 'required | sometimes',
            'primary_image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'secondary_image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'page_type' => 'required | sometimes',
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
            'primary_image.required' => 'The primary image is required.',
            'primary_image.image' => 'The primary image must be an image file.',
            'primary_image.mimes' => 'The primary image must be a file of type: jpeg, jpg, png, gif, webp.',
            'primary_image.max' => 'The primary image must not be greater than 2MB.',
            'primary_image.uploaded' => 'The primary image must not be greater than 2MB.',
            'secondary_image.required' => 'The secondary image is required.',
            'secondary_image.image' => 'The secondary image must be an image file.',
            'secondary_image.mimes' => 'The secondary image must be a file of type: jpeg, jpg, png, gif, webp.',
            'secondary_image.max' => 'The secondary image must not be greater than 2MB.',
            'secondary_image.uploaded' => 'The secondary image must not be greater than 2MB.',
        ];
    }
}
