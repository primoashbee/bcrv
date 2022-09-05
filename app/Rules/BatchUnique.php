<?php

namespace App\Rules;

use App\Batch;
use Illuminate\Contracts\Validation\Rule;

class BatchUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $course_id;
    private $year;
    private $message;
    public function __construct($course_id, $year)
    {
        $this->course_id = $course_id;
        $this->year = $year;
        $this->message = "This batch already exists";
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
        if(is_null($this->course_id) || is_null($this->year)){
            $this->message = "Missing Parameters";
            return false;
        }
        
        $bool = Batch::where('course_id', $this->course_id)
                        ->where('year', $this->year)
                        ->where('batch',$value)
                        ->count() > 0;
        if($bool){
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
        return $this->message;
    }
}
