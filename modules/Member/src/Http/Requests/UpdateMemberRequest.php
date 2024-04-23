<?php

namespace Modules\Member\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Member\Models\Member;

class UpdateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email' => 'required|email|max:200|unique:'.Member::class.',email',
            'birthdate' => 'required|date|date_format:Y-m-d',
        ];
    }
}
