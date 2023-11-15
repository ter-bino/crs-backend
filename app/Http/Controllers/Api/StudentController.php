<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Specify the number of items per page
        $page = $request->input('page', 1); // Specify which page to get
        $search = $request->input('search', ''); // Specify the search query

        /* Search through the fillable columns for the 'search' parameter */
        $students = Student::where(function ($query) use ($search) {
            $fillableColumns = (new Student)->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_account_id' => 'required|exists:user_account,user_account_id|integer',
            'address_id' => 'required|exists:address,address_id|integer',
            'student_no' => 'required|unique:student|string',
            'entry_academic_year' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'name_extension' => 'required|string',
            'pedigree' => 'required|string',
            'sex' => 'required|string',
            'civil_status' => 'required|string',
            'citizenship' => 'required|string',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'contact_no' => 'required|unique:student|string',
            'personal_email' => 'required|unique:student|string',
        ]);

        $student = new Student;
        $student->user_account_id = $request->input('user_account_id');
        $student->address_id = $request->input('address_id');
        $student->student_no = $request->input('student_no');
        $student->entry_academic_year = $request->input('entry_academic_year');
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->middle_name = $request->input('middle_name');
        $student->name_extension = $request->input('name_extension');
        $student->pedigree = $request->input('pedigree');
        $student->sex = $request->input('sex');
        $student->civil_status = $request->input('civil_status');
        $student->citizenship = $request->input('citizenship');
        $student->birth_date = $request->input('birth_date');
        $student->birth_place = $request->input('birth_place');
        $student->contact_no = $request->input('contact_no');
        $student->personal_email = $request->input('personal_email');
        $student->save();

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        if ($student) {
            $request->validate([
                'user_account_id' => 'required|exists:user_account,user_account_id|integer',
                'address_id' => 'required|exists:address,address_id|integer',
                'student_no' => 'required|unique:student,' . $student->student_id .',student_id',
                'entry_academic_year' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'middle_name' => 'required|string',
                'name_extension' => 'required|string',
                'pedigree' => 'required|string',
                'sex' => 'required|string',
                'civil_status' => 'required|string',
                'citizenship' => 'required|string',
                'birth_date' => 'required|date',
                'birth_place' => 'required|string',
                'contact_no' => 'required|unique:student,' . $student->student_id .',student_id',
                'personal_email' => 'required|unique:student,' . $student->student_id .',student_id',
            ]);
    
            $student->update([
                'user_account_id' => $request->input('user_account_id'),
                'address_id' => $request->input('address_id'),
                'student_no' => $request->input('student_no'),
                'entry_academic_year' => $request->input('entry_academic_year'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'name_extension' => $request->input('name_extension'),
                'pedigree' => $request->input('pedigree'),
                'sex' => $request->input('sex'),
                'civil_status' => $request->input('civil_status'),
                'citizenship' => $request->input('citizenship'),
                'birth_date' => $request->input('birth_date'),
                'birth_place' => $request->input('birth_place'),
                'contact_no' => $request->input('contact_no'),
                'personal_email' => $request->input('personal_email'),
            ]);
    
            return response()->json($student);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted']);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
