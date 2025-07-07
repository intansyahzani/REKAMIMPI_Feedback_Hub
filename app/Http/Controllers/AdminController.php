<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check admin with plain text password match
        $admin = Admin::where('email', $request->email)
                      ->where('password', $request->password)
                      ->first();

        if ($admin) {
            // Store admin id in session for authentication
            session(['admin_id' => $admin->id]);
            
            // Add a specific success message only for login
            return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in. Welcome, Admin!')->with('show_popup', true);
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function logout(Request $request)
    {
        // Clear admin session or do logout logic here
        $request->session()->flush();

        // Redirect to welcome page after logout
        return redirect()->route('welcome');
    }
}
