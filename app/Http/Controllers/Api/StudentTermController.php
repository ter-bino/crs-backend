<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\College;
use App\Models\EnrollmentStatus;
use App\Models\Program;
use App\Models\Student;
use App\Models\StudentTerm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentTermController extends Controller
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
        $studentTerms = StudentTerm::where(function ($query) use ($search) {
            $fillableColumns = (new StudentTerm())->getFillable();

            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }

            $query->orWhereHas('student', function ($subQuery) use ($search) {
                $subQuery->orwhere('student_no', 'like', '%' . $search . '%');
                $subQuery->orwhere('first_name', 'like', '%' . $search . '%');
                $subQuery->orwhere('last_name', 'like', '%' . $search . '%');
                $subQuery->orwhere('middle_name', 'like', '%' . $search . '%');
                $subQuery->orwhere('name_extension', 'like', '%' . $search . '%');
            });

            $query->orWhereHas('program', function ($subQuery) use ($search) {
                $subQuery->where('program_code', 'like', '%' . $search . '%');
                $subQuery->where('program_name', 'like', '%' . $search . '%');
            });

            $query->orWhereHas('college', function ($subQuery) use ($search) {
                $subQuery->where('college_code', 'like', '%' . $search . '%');
                $subQuery->where('college_title', 'like', '%' . $search . '%');
            });

            $query->orWhereHas('enrollment_status', function ($subQuery) use ($search) {
                $subQuery->where('enrollment_status_name', 'like', '%' . $search . '%');
            });


        })
        ->with('student', 'program', 'college', 'block', 'enrollment_status')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($studentTerms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            /* student_id, program_id, academic_year, term are composite primary keys */
            'student_id' => 'required|integer|exists:student,student_id',
            'program_id' => 'required|integer|exists:program,program_id',
            'academic_year' => 'required|string',
            'term' => [
                'required',
                'integer',
                Rule::unique('student_term')->where(function ($query) use ($request) {
                    return $query->where('student_id', $request->input('student_id'))
                        ->where('program_id', $request->input('program_id'))
                        ->where('academic_year', $request->input('academic_year'))
                        ->where('term', $request->input('term'));
                }),
            ],

            /* fields of student_term */
            'year_level' => 'required|integer',
            'student_type' => 'required|string',
            'registration_code' => 'required|string',
            'scholastic_status' => 'required|string',
            'is_graduating' => 'required|boolean',

            /* foreign keys */
            'college_id' => 'required|integer|exists:college,college_id',
            'block_id' => 'required|integer|exists:block,block_id',
            'enrollment_status_id' => 'required|integer|exists:enrollment_status,enrollment_status_id',
        ]);

        $student = Student::find($request->input('student_id'));
        $program = Program::find($request->input('program_id'));
        $college = College::find($request->input('college_id'));
        $block = Block::find($request->input('block_id'));
        $enrollmentStatus = EnrollmentStatus::find($request->input('enrollment_status_id'));

        $studentTerm = new StudentTerm;
        $studentTerm->student()->associate($student);
        $studentTerm->program()->associate($program);
        $studentTerm->college()->associate($college);
        $studentTerm->block()->associate($block);
        $studentTerm->enrollment_status()->associate($enrollmentStatus);
        $studentTerm->academic_year = $request->input('academic_year');
        $studentTerm->term = $request->input('term');
        $studentTerm->year_level = $request->input('year_level');
        $studentTerm->student_type = $request->input('student_type');
        $studentTerm->registration_code = $request->input('registration_code');
        $studentTerm->scholastic_status = $request->input('scholastic_status');
        $studentTerm->is_graduating = $request->input('is_graduating');
        $studentTerm->save();

        return response()->json($studentTerm, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, Program $program, string $academic_year, int $term)
    {
        $studentTerm = StudentTerm::where('student_id', $student->student_id)
            ->where('program_id', $program->program_id)
            ->where('academic_year', $academic_year)
            ->where('term', $term)
            ->firstOrFail();

        return response()->json($studentTerm);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student, Program $program, string $academic_year, int $term)
    {
        $request->validate([
            /* student_id, program_id, academic_year, term are composite primary keys */
            'student_id' => 'required|integer|exists:student,student_id',
            'program_id' => 'required|integer|exists:program,program_id',
            'academic_year' => 'required|string',
            'term' => [
                'required',
                'integer',
                Rule::unique('student_term')->where(function ($query) use ($request) {
                    return $query->where('student_id', $request->input('student_id'))
                        ->where('program_id', $request->input('program_id'))
                        ->where('academic_year', $request->input('academic_year'))
                        ->where('term', $request->input('term'));
                }),
            ],

            /* fields of student_term */
            'year_level' => 'required|integer',
            'student_type' => 'required|string',
            'registration_code' => 'required|string',
            'scholastic_status' => 'required|string',
            'is_graduating' => 'required|boolean',

            /* foreign keys */
            'college_id' => 'required|integer|exists:college,college_id',
            'block_id' => 'required|integer|exists:block,block_id',
            'enrollment_status_id' => 'required|integer|exists:enrollment_status,enrollment_status_id',
        ]);

        $student = Student::find($request->input('student_id'));
        $program = Program::find($request->input('program_id'));
        $college = College::find($request->input('college_id'));
        $block = Block::find($request->input('block_id'));
        $enrollmentStatus = EnrollmentStatus::find($request->input('enrollment_status_id'));

        $studentTerm = StudentTerm::where('student_id', $student->student_id)
            ->where('program_id', $program->program_id)
            ->where('academic_year', $academic_year)
            ->where('term', $term)
            ->firstOrFail();

        $studentTerm->student()->associate($student);
        $studentTerm->program()->associate($program);
        $studentTerm->college()->associate($college);
        $studentTerm->block()->associate($block);
        $studentTerm->enrollment_status()->associate($enrollmentStatus);
        $studentTerm->academic_year = $request->input('academic_year');
        $studentTerm->term = $request->input('term');
        $studentTerm->year_level = $request->input('year_level');
        $studentTerm->student_type = $request->input('student_type');
        $studentTerm->registration_code = $request->input('registration_code');
        $studentTerm->scholastic_status = $request->input('scholastic_status');
        $studentTerm->is_graduating = $request->input('is_graduating');
        $studentTerm->save();

        return response()->json($studentTerm);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, Program $program, string $academic_year, int $term)
    {
        $studentTerm = StudentTerm::where('student_id', $student->student_id)
            ->where('program_id', $program->program_id)
            ->where('academic_year', $academic_year)
            ->where('term', $term)
            ->firstOrFail();

        $studentTerm->delete();

        return response()->json(['message' => 'Student term deleted']);
    }
}
