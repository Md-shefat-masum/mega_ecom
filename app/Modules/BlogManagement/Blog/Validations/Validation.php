<?php

namespace App\Modules\BlogManagement\Blog\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class Validation extends FormRequest
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
            'tags' => 'required | sometimes',
            'public_date' => 'required | sometimes',
            'writer' => 'required | sometimes',
            'meta_title' => 'required | sometimes',
            'meta_description-100' => 'required | sometimes',
            'meta_keywords' => 'required | sometimes',
            'thumbnail_image' => 'required | sometimes',
            'image' => 'required | sometimes',
            'blog_type' => 'required | sometimes',
            'video_url' => 'required | sometimes',
            'privecy_status' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}