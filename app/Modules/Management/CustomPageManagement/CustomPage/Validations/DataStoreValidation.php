<?php

namespace App\Modules\Management\CustomPageManagement\CustomPage\Validations;

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
            'page_permalink' => 'required | sometimes',
            'banner_image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
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
            'banner_image.required' => 'The banner image is required.',
            'banner_image.image' => 'The banner image must be an image file.',
            'banner_image.mimes' => 'The banner image must be a file of type: jpeg, jpg, png, gif, webp.',
            'banner_image.max' => 'The banner image must not be greater than 2MB.',
            'banner_image.uploaded' => 'The banner image must not be greater than 2MB.',
        ];
    }
}
