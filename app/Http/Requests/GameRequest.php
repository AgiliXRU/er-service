<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string|unique:games,title',
            'description' => '',
            'complexity' => 'required|min:1|max:10',
            'minPlayers' => 'required|min:1|max:10',
            'maxPlayers' => 'required|min:1|max:10',
            'isActive' => 'required|boolean'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'game_id' => 'required|integer|exists:games,id',
                        'title' => [
                            'required',
                            Rule::unique('games')->ignore($this->title, 'title')
                        ]
                    ] + $rules;
            case 'DELETE':
                return [
                    'game_id' => 'required|integer|exists:games,id'
                ];
        }
    }

    public function all($keys = null)
    {
        // return $this->all();
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            // case 'PUT':
            // case 'PATCH':
            case 'DELETE':
                $data['date'] = $this->route('day');
        }
        return $data;
    }
}
