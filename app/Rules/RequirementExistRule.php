<?php

namespace App\Rules;

use App\Requirement;
use Illuminate\Contracts\Validation\Rule;

class RequirementExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $education_level;
    public function __construct($education_level)
    {
        $this->education_level = $education_level;
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
        return Requirement::where('name', $value)->where('education_level', $this->education_level)->count() > 0 ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This requirement already exist on (' . $this->education_level . ')';
    }
}
