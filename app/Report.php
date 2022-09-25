<?php

namespace App;

use App\Models\PrimaryModels\CourseModel as Course;
use stdClass;

class Report
{
    const bgColor = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)',
        'rgba(99, 14, 95, 0.2)',
        'rgba(102, 255, 75, 0.2)',
        'rgba(205, 86, 26, 0.2)',
    ];

    const borderColor = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)',
        'rgb(99, 14, 95)',
        'rgb(102, 255, 75)',
        'rgb(205, 86, 26)',
    ];


    public static function getColors($index,$type){
        $list = [];

        //get index remove previos then append
        if($type=="bg"){
            foreach(self::bgColor as $color){
                $list[] = $color;
            }
            return $list;

        }
        if($type=="border"){
            foreach(self::borderColor as $color){
                $list[] = $color;
            }
            return $list;
        }
   

    }
    public static function studentPerBatch($year = null)
    {


        $courses = Course::all();

        $std = new stdClass;
        foreach(range(1,10) as $batch){
            $std->labels[] = "Batch $batch";
        }
        foreach($courses as $course_key=>$course){
            $values = [];
            foreach(range(1,10) as $key=>$item){
                $values[] = $course->userCountByBatchAndYear($item, $year);

            }
            $obj = new stdClass;
            $obj->values = $values;
            $obj->label =  $course->course_name;
            $obj->bg_color = self::bgColor[$course_key];
            $obj->border_color = self::borderColor[$course_key];
            $obj->course = $course;
            $std->datasets[] = $obj;
    
        }
        return $std;


    }

    public static function studentPerYear($year =null){

        $courses = Course::all();

        $std = new stdClass;
        foreach(range(2019,now()->year) as $year_item){
            $std->labels[] = "Year $year_item";
        }
        foreach($courses as $course_key=>$course){
            $values = [];
            foreach(range(2019,now()->year) as $key=>$year_item){
                $values[] = $course->userCountByYear( $year_item);

            }
            $obj = new stdClass;
            $obj->values = $values;
            $obj->label =  $course->course_name;
            $obj->bg_color = self::bgColor[$course_key];
            $obj->border_color = self::borderColor[$course_key];
            $obj->course = $course;

            $std->datasets[] = $obj;
    
        }
        return $std;
    }
}
