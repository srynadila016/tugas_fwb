<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('owner.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('owner.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('owner.admins.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(404); // Or redirect with error
        }
        return view('owner.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('owner.admins.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy(User $admin)
    {
        if ($admin->role !== 'admin') {
            abort(403);
        }
        $admin->delete();
        return redirect()->route('owner.admins.index')->with('success', 'Admin berhasil dihapus!');
    }
}