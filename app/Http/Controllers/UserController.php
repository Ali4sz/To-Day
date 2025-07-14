<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valdiatedata = $request->validate(
            [
                'firstName' => 'min:2|required',
                'lastName' => 'min:2|required',
                'email' => 'email|required',
                'password' => 'min:8|required',
            ],
            [
                'firstName.min' => 'Invalid name',
                'lastName.min' => 'Invalid last name',
                'email.email' => 'Invalid email',
                'password.min' => 'Password must be at least 8 characters long',
            ]
        );

        $attr = [
            'first_name' => $valdiatedata['firstName'],
            'last_name' => $valdiatedata['lastName'],
            'email' => $valdiatedata['email'],
            'password' => $valdiatedata['password'],
        ];

        User::create($attr);
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $validatedata = $request->validate(
            [
                'email' => 'email|required',
                'password' => 'required',
            ],
            [
                'email.email' => 'Invalid email',
                'password.required' => 'Password is required',
            ]
        );

        $attr = [
            'email' => $validatedata['email'],
            'password' => $validatedata['password'],
        ];

        Auth::attempt($attr);
        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); // Redirect to the homepage after logout
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        try {
            // IMPORTANT: Delete associated data first!
            // This assumes your Task model has a 'user_id' column.
            Task::where('user_id', $user->id)->delete();

            // Now, delete the user.
            $user->delete();

            return response()->json(['success' => true, 'message' => 'Account deleted successfully.']);
        } catch (\Exception $e) {
            // Log::error('Error deleting account for user ' . $user->id . ': ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting your account.'], 500);
        }
    }
}
