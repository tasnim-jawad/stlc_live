<?php

namespace App\Modules\Management\OurServiceManagement\OurService\Validations;

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
            'url' => 'required | sometimes',
            'image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'primary_image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
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
            'primary_image.required' => 'The primary image is required.',
            'primary_image.image' => 'The primary image must be an image file.',
            'primary_image.mimes' => 'The primary image must be a file of type: jpeg, jpg, png, gif, webp.',
            'primary_image.max' => 'The primary image must not be greater than 2MB.',
            'primary_image.uploaded' => 'The primary image must not be greater than 2MB.',
        ];
    }
}
