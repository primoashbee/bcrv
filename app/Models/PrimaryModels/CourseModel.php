<?php

namespace App\Models\PrimaryModels;

use App\Batch;
use App\BatchUser;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = "courses";
    protected $fillable = ['course_name', 'course_description'];

    public function batches()
    {
        return $this->hasMany(Batch::class,'course_id','id');
    }

    public function getUsersCountAttribute()
    {
        $count = 0;
        foreach($this->batches as $batch)
        {
            $count = $count + $batch->users_count;
        }

        return $count;
    }

    public function userCountByBatchAndYear($batch, $year)
    {
        $batch =    $this
                    ->batches()
                    ->where('batch',$batch)
                    ->where('year', $year)
                    ->first();

        $count = 0;
        if(!is_null($batch)){
            $count = $batch->users()
                    ->whereIn('batch_users.status', [BatchUser::COMPLETED, BatchUser::NOT_COMPLETED])
                    ->count();
            // $count = $batch->users()->count();
        }

        return $count;
    }

    public function userCountByYear($year){

        $batches =   $this
                    ->batches()
                    ->with(['users' => function($q){
                        $q->whereIn('batch_users.status', [BatchUser::COMPLETED, BatchUser::NOT_COMPLETED]);    
                    }])
                    ->where('year', $year)
                    ->get();
        $count = 0;
        if($batches->count() > 0){
            foreach($batches as $batch){
                
                $count = $count + $batch->users()->count();
            }
            // $count = $batch->users()
            //         ->whereIn('batch_users.status', [BatchUser::COMPLETED, BatchUser::NOT_COMPLETED])
            //         ->count();
            // dd($count);
        }

        return $count;
    }
}
