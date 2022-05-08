<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function __construct(){}

    public function create(Request $request)
    {
        $this->validate($request, $this->getRules(true));
        $data = $this->retrieveData($request);
        $student = Student::create($data);
        return response()->json($student);
    }

    public function update(Request $request)
    {
        $student = Student::findOrFail($request->input('id', 0));
        $this->validate($request, $this->getRules());
        $data = $this->retrieveData($request);
        foreach ($data as $key => $value) {
            $student[$key] = $value;
        }
        $student->save();
        return response()->json($student);
    }

    public function delete(int $id) {
        Student::findOrFail($id)->delete();
        return response();
    }

    public function find(string $column, string $value) {
        $student = Student::where($column, $value)->get();
        return response()->json($student);
    }

    private function getRules($validateUniqueFields = false) {
        $rules = [
            'title' => ['required', 'string', 'max:100'],
            'father' => ['required', 'string', 'max:100'],
            'mother' => ['required', 'string', 'max:100'],
            'dob' => ['required', 'date'],
            'class' => ['required', 'min:-2', 'max:12'],
            'address' => ['required', 'string'],
            'mobile' => ['required']
        ];

        if($validateUniqueFields) {
            $rules['member_id'] = ['required', 'unique:students,member_id', 'numeric'];
            $rules['aadhaar'] = ['required', 'unique:students,aadhaar', 'numeric'];
        }

        return $rules;
    }

    private function retrieveData(Request $request) {
        return $request->only([
            'title', 'father', 'mother', 'dob', 'class', 'address', 'mobile', 'aadhaar', 'member_id'
        ]);
    }
}
