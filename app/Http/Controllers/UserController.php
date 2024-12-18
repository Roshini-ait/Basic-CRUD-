<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Event\UserCreated;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function eventtest()
    {
        event(new UserCreated('roshiniait@gmail.com'));
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zipcode' => 'required|numeric',
            'role' => 'required|integer',
            'gender' => 'required|string',
            'dob' => 'required|date',
        ]);

        $user = User::create($validated);
        event(new UserCreated('roshiniait@gmail.com'));

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);  
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zipcode' => 'required|numeric',
            'role' => 'required|integer',
            'gender' => 'required|string',
            'dob' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully']);
    }
}
