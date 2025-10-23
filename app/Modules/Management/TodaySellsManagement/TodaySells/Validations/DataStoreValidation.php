<?php

namespace App\Modules\Management\TodaySellsManagement\TodaySells\Validations;

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
            'title' => 'required | sometimes',
            'description' => 'required | sometimes',
            'features' => 'required | sometimes',
            'key_features' => 'required | sometimes',
            'video_url' => 'required | sometimes',
            'image_gallery_left' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image_gallery_right' => 'sometimes|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
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
            'image_gallery_left.required' => 'The left gallery image is required.',
            'image_gallery_left.image' => 'The left gallery image must be an image file.',
            'image_gallery_left.mimes' => 'The left gallery image must be a file of type: jpeg, jpg, png, gif, webp.',
            'image_gallery_left.max' => 'The left gallery image must not be greater than 2MB.',
            'image_gallery_left.uploaded' => 'The left gallery image must not be greater than 2MB.',
            'image_gallery_right.required' => 'The right gallery image is required.',
            'image_gallery_right.image' => 'The right gallery image must be an image file.',
            'image_gallery_right.mimes' => 'The right gallery image must be a file of type: jpeg, jpg, png, gif, webp.',
            'image_gallery_right.max' => 'The right gallery image must not be greater than 2MB.',
            'image_gallery_right.uploaded' => 'The right gallery image must not be greater than 2MB.',
        ];
    }
}
