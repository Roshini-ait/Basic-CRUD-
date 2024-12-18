<?php

namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        return response()->json($this->studentRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->studentRepository->find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
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
            // 'dob' => 'required|date',
        ]);

        return response()->json($this->studentRepository->create($data), 201);
    }

    public function update($id, array $data)
    {
        $student = $this->model->find($id);

        if (!$student) {
            throw new \Exception("Student not found", 404);
        }

        $student->update($data);
        
        return $student;
    }

    public function destroy($id)
    {
        $this->studentRepository->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
