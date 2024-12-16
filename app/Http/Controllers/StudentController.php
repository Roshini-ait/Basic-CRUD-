<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        // dd(1);
        return redirect()->back()->with('success', 'Student created successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('manage-students')) {
            abort(403, 'Unauthorized');
        }
        Log::info('Updating student with ID ' . $id, ['request_data' => $request->all()]);
        Log::info('Name: ' . $request->input('name'));
        Log::info('Email: ' . $request->input('email'));

        $student = Student::findOrFail($id);
        $student->update($request->all()); 

        Log::info('Student updated successfully', ['student' => $student]);

        return response()->json([
            'message' => 'Student updated successfully.',
        ], 200);
    }

    public function destroy($id)
    {
        if (!Gate::allows('manage-students')) {
            abort(403, 'Unauthorized');
        }
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
