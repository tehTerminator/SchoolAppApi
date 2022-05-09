<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Helper\RulesGenerator;
use App\Http\Helper\StudentValidation;

class StudentController extends Controller
{
    private $rules;
    public function __construct(){
        $this->rules = new RulesGenerator(StudentValidation::get());
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->rules->getRules(true));
        $data = $this->rules->extractData($request);
        $student = Student::create($data);
        return response()->json($student);
    }

    public function update(Request $request)
    {
        $student = Student::findOrFail($request->input('id', 0));
        $this->validate($request, $this->rules->getRules());
        $data = $this->rules->extractData($request);
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
}
