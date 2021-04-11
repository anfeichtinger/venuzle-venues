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
        $timeArr = explode('-', $value);

        $startTime = strtotime($timeArr[0]);
        $stopTime = strtotime($timeArr[1]);

        $otherTimes = Booking::all()->where('venue_id', $this->data['venue_id']);

        foreach ($otherTimes as $otherTime){
            $otherTimeArr = explode('-', $otherTime);

            $otherStart = strtotime($otherTimeArr[0]);
            $otherStop = strtotime($otherTimeArr[1]);

            if (
            ($startTime == $otherStart) || 
            ($stopTime == $otherStop) || 
            ($startTime > $otherStart && $stopTime < $otherStop) || 
            ($startTime < $otherStart && $stopTime > $otherStart) ||
            ($startTime < $otherStart && $stopTime > $otherStop)) {
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
        return 'This timeslot is already used in another booking.';
    }
}
