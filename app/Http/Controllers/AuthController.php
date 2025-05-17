<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * ✅ تسجيل مستخدم جديد - API
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15|unique:users,phone',
            'password' => ['required', 'string', 'min:6', 'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/',
            ],
            'birthday' => 'nullable|date',
            'role' => 'in:SuperAdmin,Admin,Client,Delivery',
            'profile_picture' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'] ?? null,
            'password' => Hash::make($fields['password']),
            'birthday' => $fields['birthday'] ?? null,
            'role' => $fields['role'] ?? 'Client',
            'profile_picture' => $fields['profile_picture'] ?? null,
        ]);

        $token = $user->createToken('foodtek_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * ✅ تسجيل الدخول - API
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $token = $user->createToken('foodtek_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * ✅ تسجيل الخروج - API
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح'
        ]);
    }

    /**
     * ✅ تسجيل مستخدم جديد - واجهة (Blade)
     */
    public function registerWeb(Request $request)
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:15|unique:users,phone',
                'password' => ['required', 'string', 'min:6', 'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/',
                ],
                'birthday' => 'nullable|date',
                'role' => 'in:SuperAdmin,Admin,Client,Delivery',
                'profile_picture' => 'nullable|string'
            ]);

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'phone' => $fields['phone'] ?? null,
                'password' => Hash::make($fields['password']),
                'birthday' => $fields['birthday'] ?? null,
                'role' => $fields['role'] ?? 'Client',
                'profile_picture' => $fields['profile_picture'] ?? null,
            ]);

            auth()->login($user);

            return redirect('/dashboard')->with('success', 'تم إنشاء الحساب بنجاح، مرحبًا بك!');
        } catch (\Exception $e) {
            \Log::error('Registration failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ غير متوقع أثناء التسجيل، يرجى المحاولة لاحقًا.');
        }
    }

    /**
     * ✅ تسجيل الدخول - واجهة (Blade)
     */
    public function loginWeb(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة');
    }

    /**
     * ✅ تسجيل الخروج - واجهة (Blade)
     */
    public function logoutWeb(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
