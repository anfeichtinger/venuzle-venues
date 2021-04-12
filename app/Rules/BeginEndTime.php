<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;

class BeginEndTime implements Rule
{
    private $begin;
    private $end;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $begin, string $end)
    {
        $this->begin = $begin;
        $this->end = $end;
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
        $beginTime = strtotime($this->begin);
        $endTime = strtotime($this->end);

        if ($beginTime == $endTime || $beginTime > $endTime) {
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
        return 'First time must be before second time.';
    }
}
