<?php

use App\Requirement;
use App\StudentRequirement;

function studentRequirementStatus(Requirement $requirement, $user_id)
{
    $result = StudentRequirement::where('requirement_id', $requirement->id)
        ->where('user_id',$user_id)
        ->first();
    if(!$result){
        return [
            'code'=>400,
            'message'=>'No uploaded file yet',
            'class'=>'is-invalid',
            'feedback_class'=>'invalid-feedback'

        ];
    }

    if($result->status == StudentRequirement::PENDING){
        return [
            'code'=>422,
            'message'=>'Pending',
            'class'=>'is-invalid',
            'feedback_class'=>'invalid-feedback'

        ];
    }
    if($result->status == StudentRequirement::APPROVED){
        return [
            'code'=>200,
            'message'=>'Approved',
            'class'=>'is-valid',
            'feedback_class'=>'valid-feedback'


        ];
    }
}

