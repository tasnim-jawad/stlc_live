<?php

namespace App\Modules\Management\PropertyManagement\Property\Validations;

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
            'price' => 'required | sometimes',
            'banner_image' => 'required | sometimes|array',
            'property_video_thmbnail' => 'required | sometimes',
            'property_group_id' => 'required | sometimes',
            'property_category_id' => 'required | sometimes',
            'property_status' => 'required | sometimes',
            'date' => 'required | sometimes',
            'property_name' => 'required | sometimes',
            'property_address' => 'required | sometimes',
            'property_description' => 'required | sometimes',
            'property_detail' => 'required | sometimes',
            'facts_and_features' => 'required | sometimes',
            'gallery' => 'required | sometimes|array',
            'amenities' => 'required | sometimes',
            'floor_plan' => 'required | sometimes',
            'floor_plan_details' => 'required | sometimes',
            'property_video_url' => 'required | sometimes',
            'map_location_url' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}