<?php

namespace App\Rules;

use App\Models\Genre;
use Illuminate\Contracts\Validation\Rule;

class FilmGenre implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $arrayValues = str($value)->explode(',');
        if (Genre::whereIn('value', $arrayValues)->count() != count($arrayValues)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute parameters does not meet.';
    }
}
