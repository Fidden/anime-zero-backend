<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StringInArray implements Rule
{
    private array $availableData;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $availableData)
    {
        $this->availableData = $availableData;
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
        for ($i = 0; $i < count($arrayValues); $i++) {
            if (!in_array($arrayValues[$i], $this->availableData))
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
        return 'The :attribute is not available';
    }
}
