<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phonenumber' => 'required|digits_between:10,15',
            'address' => 'required|string',
            // 'city' => 'required|string',
            // 'state' => 'required|string',
            // 'country' => 'required|string',
            'zipcode' => 'required|digits:6',
            // 'role' => 'required|integer',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
        ]);

        Student::create($validated);

        return redirect()->back()->with('success', 'Student created successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:students,email,{$student->id}",
            'phonenumber' => 'required|digits_between:10,15',
            'address' => 'required|string',
            // 'city' => 'required|string',
            // 'state' => 'required|string',
            // 'country' => 'required|string',
            'zipcode' => 'required|digits:6',
            // 'role' => 'required|integer',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
        ]);

        $student->update($validated);

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);

            $student->delete();

            return response()->json([
                'message' => 'Student deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the student. Please try again.',
            ], 500);
        }
    }

}
