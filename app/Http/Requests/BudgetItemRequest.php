<?php

namespace Budgeit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'amount' => 'numeric|required',
            'note' => 'string',
            'date' => 'date',
            'type' => 'string',
            'interest' => 'numeric'
        ];
    }

}
