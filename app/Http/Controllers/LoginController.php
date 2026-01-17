<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();

                if ($remember) {
                    // Only store email in cookie (never store passwords in cookies for security)
                    Cookie::queue('email', $request->email, 120);
                } else {
                    Cookie::queue(Cookie::forget('email'));
                }

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login successful',
                        'user' => $user,
                        'redirect_url' => route('dashboard')
                    ]);
                }

                return redirect()->route('dashboard');
            } else {
                if ($request->ajax()) {
                    throw new \Exception('Your email/password is incorrect');
                }

                return back()->withErrors([
                    'email' => 'Your email/password is incorrect'
                ])->withInput();
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 401);
            }

            return back()->withErrors([
                'email' => $e->getMessage()
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            
            Cache::forget('user-is-online-' . $userId);
            Cache::forget('user-online-expiration-' . $userId);

            Auth::logout();
        }

        return redirect()->route('index');
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->first(),
                        'errors' => $validator->errors(),
                    ], 422);
                }

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $memberRole = Role::where('name', 'Writer')->first();
            if ($memberRole) {
                $user->assignRole($memberRole);
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Role Member not found'
                    ], 404);
                }

                return redirect()->back()
                    ->withErrors(['role' => 'Role Member not found'])
                    ->withInput();
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Register successful',
                    'user' => $user,
                    'redirect_url' => route('login')
                ]);
            }

            return redirect()->route('login')
                ->with('success', 'Register successful');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }

            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
}
