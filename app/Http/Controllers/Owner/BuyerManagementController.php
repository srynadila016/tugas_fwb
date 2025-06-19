<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class BuyerManagementController extends Controller
{
    public function index()
    {
        $buyers = User::where('role', 'pembeli')->paginate(10);
        return view('owner.buyers.index', compact('buyers'));
    }

    public function edit(User $buyer)
    {
        if ($buyer->role !== 'pembeli') {
            abort(404);
        }
        return view('owner.buyers.edit', compact('buyer'));
    }

    public function update(Request $request, User $buyer)
    {
        if ($buyer->role !== 'pembeli') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $buyer->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $buyer->name = $request->name;
        $buyer->email = $request->email;
        if ($request->filled('password')) {
            $buyer->password = Hash::make($request->password);
        }
        $buyer->save();

        return redirect()->route('owner.buyers.index')->with('success', 'Data pembeli berhasil diperbarui!');
    }

    public function destroy(User $buyer)
    {
        if ($buyer->role !== 'pembeli') {
            abort(403);
        }
        $buyer->delete();
        return redirect()->route('owner.buyers.index')->with('success', 'Pembeli berhasil dihapus!');
    }
}