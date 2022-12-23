<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'advertiser_id' => 'required|exists:users,id',
            'is_paid' => 'required|boolean',
            'tags' => 'required|array',
            'tags.*' => 'required|exists:tags,id',
            'start_at' => 'required|date' . ($this->ad?->start_at?->gt(today()) || !$this->ad ? '|after:today' : null),
        ];
    }
}
