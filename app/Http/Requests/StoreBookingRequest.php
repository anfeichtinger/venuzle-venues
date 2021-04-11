<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\BookingTimeInUse;
use App\Rules\BeginEndTime;

class StoreBookingRequest extends FormRequest
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
            'customer' => ['required', 'regex:/[A-Z ]+/i', 'max:255', Rule::unique('bookings')->ignore($this->id)],
            'booking_begin' => ['required', 'max:5', 
                'regex:/([0-1][0-9]|[2][0-3]):([0-5][0-9])/', 
                 new BeginEndTime($this->booking_begin, $this->booking_end),
                 new BookingTimeInUse($this->all())],
            'booking_end' => ['required', 'max:5', 
                'regex:/([0-1][0-9]|[2][0-3]):([0-5][0-9])/'],
            'venue_id' => ['required', 'regex:/[0-9]+$/']
        ];
    }
}
