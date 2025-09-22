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
            'section_type' => 'required | sometimes',
            'short_title' => 'required | sometimes',
            'title' => 'required | sometimes',
            'long_title' => 'required | sometimes',
            'short_description' => 'required | sometimes',
            'description' => 'required | sometimes',
            'video_url' => 'required | sometimes',
            'primary_image' => 'required | sometimes',
            'background_image' => 'required | sometimes',
            'side_image' => 'required | sometimes',
            'image' => 'required | sometimes',
            'special_note' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}