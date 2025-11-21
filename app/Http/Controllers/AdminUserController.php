<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    /**
     * DAFTAR AKUN INTERNAL (Admin & Dokter)
     */
    public function index()
    {
        $users = User::with('poli')
                    ->whereIn('role', ['admin', 'dokter'])
                    ->where('id', '!=', auth()->id())
                    ->latest()
                    ->paginate(10);
        
        // DATA STATISTIK UNTUK UI
        $total_dokter = User::where('role', 'dokter')->count();
        $total_admin = User::where('role', 'admin')->count();
                    
        return view('admin.users.index', compact('users', 'total_dokter', 'total_admin'));
    }

    /**
     * DAFTAR PASIEN
     */
    public function patients()
    {
        $patients = User::where('role', 'pasien')
                        ->latest()
                        ->paginate(10);
        
        // DATA STATISTIK
        $total_pasien = User::where('role', 'pasien')->count();
        $today_pasien = User::where('role', 'pasien')->whereDate('created_at', today())->count();
                        
        return view('admin.patients.index', compact('patients', 'total_pasien', 'today_pasien'));
    }
    
    public function create()
    {
        $polis = Poli::all(); 
        return view('admin.users.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:admin,dokter,pasien'],
            'poli_id' => ['nullable', 'exists:polis,id'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $poliId = $request->role === 'dokter' ? $request->poli_id : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'poli_id' => $poliId,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role === 'pasien') {
            return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil ditambahkan!');
        }

        return redirect()->route('admin.users.index')->with('success', 'Staf Internal berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $polis = Poli::all();
        return view('admin.users.edit', compact('user', 'polis'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,dokter,pasien'],
            'poli_id' => ['nullable', 'exists:polis,id'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'poli_id' => ($request->role === 'dokter') ? $request->poli_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($user->role === 'pasien') {
            return redirect()->route('admin.patients.index')->with('success', 'Data Pasien diperbarui!');
        }

        return redirect()->route('admin.users.index')->with('success', 'Data Staf diperbarui!');
    }

    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();

        if ($role === 'pasien') {
            return redirect()->route('admin.patients.index')->with('success', 'Pasien berhasil dihapus!');
        }
        return redirect()->route('admin.users.index')->with('success', 'Staf berhasil dihapus!');
    }
}