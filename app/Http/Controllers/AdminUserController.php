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
     * Fitur: Search, Filter Role, Sorting
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi Query Dasar (Ambil Admin & Dokter, kecuali diri sendiri)
        $query = User::with('poli')
                     ->whereIn('role', ['admin', 'dokter'])
                     ->where('id', '!=', auth()->id());

        // 2. LOGIKA PENCARIAN (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 3. LOGIKA FILTER (Berdasarkan Role: Admin/Dokter)
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 4. LOGIKA SORTING (Urutan)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            // Default urutan terbaru
            $query->latest();
        }

        // Eksekusi Query dengan Pagination & Query String (agar filter tidak hilang saat pindah hal)
        $users = $query->paginate(10)->withQueryString();
        
        // DATA STATISTIK UNTUK UI (Tetap Hitung Semua Data Tanpa Filter)
        $total_dokter = User::where('role', 'dokter')->count();
        $total_admin = User::where('role', 'admin')->count();
                    
        return view('admin.users.index', compact('users', 'total_dokter', 'total_admin'));
    }

    /**
     * DAFTAR PASIEN
     * Fitur: Search, Sorting
     */
    public function patients(Request $request)
    {
        // 1. Inisialisasi Query Dasar (Hanya Pasien)
        $query = User::where('role', 'pasien');

        // 2. LOGIKA PENCARIAN (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 3. LOGIKA SORTING (Urutan)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // Eksekusi Query
        $patients = $query->paginate(10)->withQueryString();
        
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