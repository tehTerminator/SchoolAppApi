<?php

namespace App\Http\Helper;

/**
 * Class Containing Rules For Student Controller Validation
 */
class StudentValidation {

    /**
     * @return array Containing Rules For Validation Request
     */
    public static function get() {
        return [
            'title' => ['required', 'string', 'max:100'],
            'father' => ['required', 'string', 'max:100'],
            'mother' => ['required', 'string', 'max:100'],
            'dob' => ['required', 'date'],
            'class' => ['required', 'min:-2', 'max:12'],
            'address' => ['required', 'string'],
            'mobile' => ['required'],
            'member_id' => ['required', 'unique:students,member_id', 'numeric'],
            'aadhaar' => ['required', 'unique:students,aadhaar', 'numeric']
        ];
    }
}