<?php

namespace App\Modules\Management\BannerManagement\Banner\Validations;

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
            'short_title' => 'required | sometimes',
            'short_description' => 'required | sometimes',
            'permalink' => ' sometimes',
            'image' => 'required|sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:1536',
            'video_url' => 'required | sometimes',
            'video_file' => ' sometimes',
            'video_type' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
            // new rule for display status
            'display_status' => ['sometimes', Rule::in([0, 1])],
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
