<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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

        //check if it's update or create
        $isUpdate = $this->video ? true : false;

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

            'types' => 'required|array',
            'types.*' => 'exists:types,id',

            'collections' => 'nullable|array',
            'collections.*' => 'exists:collections,id',

            'video' => ($isUpdate ? 'nullable' : 'required').'|mimes:mp4,mov,avi,webm,mkv|max:2097152',

            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:102400',
            'title_poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:102400',
        ];
    }
}
