<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', 'min:5', 'max:55', 'string', Rule::unique('projects')->ignore($this->project)],
            'description' => 'min:5|string',
            'cover_img' => 'nullable|image|max:2048',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve contenere minimo 5 caratteri',
            'title.max' => 'Il titolo deve contenere massimo 55 caratteri',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.unique' => 'Questo titolo esiste già',
            'description.min' => 'La descrizione deve contenere minimo 5 caratteri',
            'description.string' => 'La descrizione deve essere una stringa',
            'cover_img.image' => 'Il file deve essere un\'immagine',
            'cover_img.max' => 'Il file può essere al massimo di 2MB',
            'type_id.exists' => 'L\'id del tipo selezionato non è valido',
            'technologies.exists' => 'Le tecnologie selezionate non sono valide'
        ];
    }
}
