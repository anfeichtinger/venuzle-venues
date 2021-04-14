<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;

class BookingTimeInUse implements Rule
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

        $otherTimes = Booking::all()->where('venue_id', $this->data['venue_id']);

        foreach ($otherTimes as $otherTime){

            if (array_key_exists('id', $this->data) && $this->data['id'] == $otherTime->id) {
                break;
            }

            $otherBegin = strtotime($otherTime->booking_begin);
            $otherEnd = strtotime($otherTime->booking_end);

            if (
            ($begin == $otherBegin) || 
            ($end == $otherEnd) || 
            ($begin > $otherBegin && $end < $otherEnd) || 
            ($begin > $otherBegin && $end > $otherEnd) || 
            ($begin < $otherBegin && $end > $otherBegin) ||
            ($begin < $otherBegin && $end > $otherEnd)) {
                return false;
            }
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
        return 'This timeslot overlaps with another booking.';
    }
}
