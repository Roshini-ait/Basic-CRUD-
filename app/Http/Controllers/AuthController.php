<?php

  

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Mail\CustomEmail;
use App\Event\UserCreated;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller

{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withErrors('You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
           
        $data = $request->all();
        $this->create($data);
        $user = User::find(1);
        // event(new UserCreated('roshiniait@gmail.com'));
        SendWelcomeEmailJob::dispatch($user);

        $details = [
            'name' => $request->input('name'),
            'message' => $request->input('message'),
            // 'file_data' => file_get_contents(public_path('files/dynamic-file.pdf')),
        ];

        Mail::to($request->input('email'))->send(new CustomEmail($details));

        return redirect("registration")->withSuccess('Great! You have Successfully registered');
    }

    public function dashboard()
    {
        if(Auth::check()){
            if (!Gate::allows('view-students')) {
                abort(403, 'Unauthorized');
            }
            $students = Student::paginate(10);
            return view('dashboard', compact('students'));
        }
  
        return redirect("login")->withSuccess('You do not have access');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role']
      ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User successfully registered'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }
}