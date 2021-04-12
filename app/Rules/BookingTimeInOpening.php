<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Venue;

class BookingTimeInOpening implements Rule
{
    private $data;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $begin = strtotime($this->data['booking_begin']);
        $end = strtotime($this->data['booking_end']);

        $venue = Venue::where('id', $this->data['venue_id'])->first();

        $open_at = strtotime($venue->open_at);
        $close_at = strtotime($venue->close_at);

        if  (($begin < $open_at || $begin > $close_at) || 
            ($end < $open_at || $end > $close_at)) {
                return false;
            }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Timeslot must be inside of opening times.';
    }
}
