<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class MinDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
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
        $first = Carbon::now()->subYear(3);
        $second = Carbon::now()->subYear(10);
        $date = Carbon::parse($value);
        if ($date->between($first, $second)) {
            return $value;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return  'pet must be between 3 and 10 years old';
    }
}