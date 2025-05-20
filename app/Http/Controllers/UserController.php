<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'SuperAdmin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function toggleRole(User $user)
    {
        // لا يسمح إلا لـ SuperAdmin بالتعديل
        if (auth()->user()->role !== 'SuperAdmin') {
            return back()->with('error', 'ليس لديك صلاحية لتعديل دور المستخدم');
        }

        $user->role = $user->role === 'Client' ? 'Delivery' : 'Client';
        $user->save();

        return back()->with('success', 'تم تعديل دور المستخدم إلى: ' . $user->role);
    }
}
