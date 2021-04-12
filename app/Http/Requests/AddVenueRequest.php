<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\BookingTimeInUse;
use App\Rules\BeginEndTime;

class AddVenueRequest extends FormRequest
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
            'name' => ['required', 'regex:/[A-Z ]+/i', 'max:255', Rule::unique('venues')->ignore($this->id)],
            'open_at' => ['required', 'max:5', 
            'regex:/([0-1][0-9]|[2][0-3]):([0-5][0-9])/', 
                 new BeginEndTime($this->open_at, $this->close_at)],
            'close_at' => ['required', 'max:5', 
                  'regex:/([0-1][0-9]|[2][0-3]):([0-5][0-9])/']
        ];
    }
}
