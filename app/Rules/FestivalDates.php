<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FestivalDates implements Rule
{
    protected $day_qty;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($day_qty)
    {
        $this->day_qty = $day_qty;
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
        $selected_days_count = count($value);
        return $selected_days_count == $this->day_qty;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->day_qty == 1) {
            return 'You have to select '.$this->day_qty.' day.';
        } else {
            return 'You have to select '.$this->day_qty.' days.';
        }
    }
}
